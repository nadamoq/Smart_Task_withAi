<?php

namespace App\Http\Controllers;

use App\Ai\Agents\BacklogAgent;
use App\Ai\Agents\TaskBreakAgent;
use App\Models\Category;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Ai\Enums\Lab;

class TaskAiController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();
        return view('ai.index', compact('categories'));
    }
    public function breakdown(Request $request)
    {

        $request->validate([
            'idea' => 'required|string|min:10|max:2000',
        ]);
        $agent = new TaskBreakAgent;
        $prompt = " 1. Define a clear, descriptive, and professional 'project_title'.
                    2. Provide a strategic 'summary' explaining the technical approach, architectural considerations, and execution plan for this breakdown.
                    3. Breakdown the project into an array of atomic, actionable, and logical 'tasks' required to fully complete the project. the idea is {$request->idea}";

        $response = $agent->prompt(prompt: $prompt, provider: Lab::Groq);

        return response()->json($response);
    }
  public function backlog(Request $request)
{
    $request->validate(['idea' => 'required|string|min:10']);

    $agent = new BacklogAgent(idea: $request->idea, sprintCount: 3);$prompt = "Create a JSON backlog for: {$request->idea}. 
    Ensure you provide exactly 3 sprints. 
    Each sprint MUST contain a 'stories' array. 
    Return ONLY valid JSON."; // أضفنا هذه الجملة لتنبيه الـ AI

    $response = $agent->prompt($prompt);
    
    // الحل هنا: تحويل النص القادم من الـ AI إلى Array
    // سنحاول تنظيف النص إذا كان الـ AI يرسل علامات ```json
    $cleanJson = preg_replace('/^```json\s*|\s*```$/', '', $response);
    $data = json_decode($cleanJson, true);

    // إذا فشل الـ Decode، سنرسل خطأ
    if (json_last_error() !== JSON_ERROR_NONE) {
        return response()->json(['error' => 'Invalid JSON format', 'raw' => $response], 500);
    }

    return response()->json($data);
}
    /**
     * Bulk import selected AI-generated tasks (Refactored for Frontend JS payload).
     */
    public function importTasks(Request $request)
    {
        $request->validate([
            'project_title'       => 'required|string|max:255',
            'summary'             => 'required|string',
            'tasks'               => 'required|array',
            'tasks.*.title'       => 'required|string',
            'tasks.*.description' => 'nullable|string',
            'tasks.*.priority'    => 'required|string',
            'categories_id'       => 'nullable|exists:categories,id',
            'due_date'            => 'nullable|date',
            'category'            => 'nullable|string'
        ]);

        $userId = Auth::id();
        $dueDate = $request->input('due_date') ?? now()->addDays(3)->toDateString();
        $count = 0;


        $categoryId = $request->input('categories_id');

        if (!$categoryId && $request->has('category')) {

            $categoryId = Category::firstOrCreate(['name' => $request['category']])->id;
        }
        return DB::transaction(function () use ($request, $userId, $categoryId, $dueDate, &$count) {


            $project = Project::create([
                'title'   => $request->input('project_title'),
                'summary' => $request->input('summary'),
                'user_id' => $userId
            ]);

            foreach ($request->input('tasks') as $taskData) {
                Task::create([
                    'user_id'      => $userId,
                    'project_id'   => $project->id,
                    'categories_id' => $categoryId,
                    'title'        => $taskData['title'],
                    'description'  => $taskData['description'] ?? null,
                    'priority'     => strtolower($taskData['priority'] ?? 'low'),
                    'due_date'     => $dueDate,

                ]);
                $count++;
            }

            return response()->json([
                'success'       => true,
                'project_title' => $project->title,
                'summary'       => $project->summary,
                'message'       => "{$count} task(s) imported successfully into your tasks repository!"
            ]);
        });
    }
    public function importBacklog(Request $request)
    {
        $validated = $request->validate([
            'project_title'   => 'required|string|max:255',
            'project_summary' => 'nullable|string',
            'sprints'         => 'required|array|min:1',
        ]);

        return DB::transaction(function () use ($validated) {
            $project = Project::create([
                'title'   => $validated['project_title'],
                'summary' => $validated['project_summary'] ?? '',
                'user_id' => auth()->id(),
            ]);

            foreach ($validated['sprints'] as $index => $sprintData) {
                $sprintNumber = $sprintData['sprint_number'] ?? $sprintData['id'] ?? ($index + 1);

                $sprint = $project->sprints()->create([
                    'title'         => $sprintData['name'] ?? $sprintData['title'] ?? "Sprint {$sprintNumber}",
                    'goal'          => $sprintData['goal'] ?? $this->formatSprintDates($sprintData),
                    'sprint_number' => (int) $sprintNumber,
                    'summary'       => $sprintData['summary'] ?? 'AI Generated Sprint',
                ]);

                foreach ($sprintData['stories'] ?? [] as $story) {
                    $task = Task::create([
                        'user_id'     => auth()->id(),
                        'project_id'  => $project->id,
                        'sprint_id'   => $sprint->id,
                        'title'       => $story['title'],
                        'description' => $this->formatStoryDescription($story),
                        'priority'    => $this->normalizePriority($story['priority'] ?? 'low'),
                    ]);

                    $criteria = $story['acceptanceCriteria'] ?? $story['acceptance_criteria'] ?? [];
                    foreach ($criteria as $criterion) {
                        $task->acceptanceCriteria()->create(['criteria' => $criterion]);
                    }
                }
            }

            return response()->json([
                'message'    => 'Backlog saved successfully!',
                'project_id' => $project->id,
                'redirect'   => route('projects.sprints', $project),
            ]);
        });
    }

    private function normalizePriority(string $priority): string
    {
        return match (strtolower($priority)) {
            'high'           => 'high',
            'medium', 'med'  => 'med',
            default          => 'low',
        };
    }

    private function formatSprintDates(array $sprintData): string
    {
        $start = $sprintData['startDate'] ?? $sprintData['start_date'] ?? null;
        $end   = $sprintData['endDate'] ?? $sprintData['end_date'] ?? null;

        if ($start && $end) {
            return "{$start} → {$end}";
        }

        return 'AI Generated Sprint';
    }

    private function formatStoryDescription(array $story): ?string
    {
        if (! empty($story['description'])) {
            return $story['description'];
        }

        if (! empty($story['as_a'])) {
            return "As a {$story['as_a']}, I want {$story['i_want']}, so that {$story['so_that']}";
        }

        return null;
    }
}
