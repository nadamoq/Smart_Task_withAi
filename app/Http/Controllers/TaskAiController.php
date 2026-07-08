<?php

namespace App\Http\Controllers;

use App\Ai\Agents\TaskBreakAgent;
use App\Models\Category;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        $response = $agent->prompt(prompt: $prompt, provider: Lab::Gemini);
        

        // $project = Project::create([
        //     'title'   => $response['project_title'],
        //     'summary' => $response['summary'],
        // ]);

        // foreach ($response['tasks'] as $taskData) {
        //     $category = Category::firstOrCreate(['name' => $taskData['category']]);
        //     Task::create([
        //         'project_id' => $project->id,
        //         'title' => $taskData['title'],
        //         'description' => $taskData['description'],
        //         'priority' => $taskData['priority'],
        //         'due_date' => $taskData['due_date'],
        //         'category_id' => $category->id,
        //     ]);
        // }

        // return response()->json([
        //     'project_title' => $project->title,
        //     'summary' => $project->summary,
        //     'tasks' => $response['tasks'],
        // ]);
        return response()->json($response);
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
            'category'            => 'nullable|string' // تأكدي من حقل name في الـ DB
        ]);

        $userId = Auth::id();
        $dueDate = $request->input('due_date') ?? now()->addDays(3)->toDateString();
        $count = 0;

        
        $categoryId = $request->input('categories_id');

        if (!$categoryId && $request->has('category')) {

            $categoryId = Category::firstOrCreate(['name' => $request['category']])->id;
        }
        return DB::transaction(function () use ($request, $userId, $categoryId, $dueDate, &$count) {

            // إنشاء المشروع باستخدام البيانات القادمة من الـ Request
            $project = Project::create([
                'title'   => $request->input('project_title'),
                'summary' => $request->input('summary'),
                'user_id'=>$userId
            ]);

            foreach ($request->input('tasks') as $taskData) {
                Task::create([
                    'user_id'      => $userId,
                    'project_id'   => $project->id, // link task to newly created project
                    'categories_id'=> $categoryId,   // use existing DB column name
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
}
