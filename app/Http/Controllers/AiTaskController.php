<?php

namespace App\Http\Controllers;

use App\Ai\Agents\TaskAgent;
use App\Models\Category;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Ai\Ai;
use Laravel\Ai\Enums\Lab;

class AiTaskController extends Controller
{
    //
    public function index()
    {
        // جلب التصنيفات لتمريرها لخيارات الحفظ في الفرونت إند
        $categories = Category::all();
        return view('ai.studio', compact('categories'));
    }

    /**
     * Mode: Task Breakdown (API Response for Frontend)
     */
    public function breakdown(Request $request)
    {
        $request->validate(['idea' => 'required|string|min:10']);
        $idea = $request->input('idea');

        try {
            // نعود للأسلوب الأصلي للحزمة الذي يشتغل بالتأكيد
            // إذاستخدمين كلاس TaskAgent الموحد:
            $response = TaskAgent::make()->prompt($idea);

            $data = $response->toArray();
            $tasks = $data['tasks'] ?? [];

            if (empty($tasks)) {
                return response()->json(['error' => 'AI returned an empty task list.'], 422);
            }

            // إرجاع الـ JSON السليم المنتظر في الفرونت إند
            return response()->json(['tasks' => $tasks]);
        } catch (\Exception $e) {
            Log::error('AI breakdown error', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Could not connect to AI service: ' . $e->getMessage()], 500);
        }
    }

    

    /**
     * Mode: Agile Backlog (API Response for Frontend)
     */
    public function backlog(Request $request)
    {
        $request->validate(['idea' => 'required|string|min:10']);
        $idea = $request->input('idea');

        // يمكنكِ جعل عدد السبرنتات ديناميكي أو ثابت 3
        $sprintCount = $request->input('sprint_count', 3);

        try {
            // نعود لأسلوب الحزمة الأصلي المعتمد لديكِ
            $response = \App\Ai\Agents\AgileBacklogAgent::make()->prompt("Create exactly {$sprintCount} sprints for: " . $idea);

            $backlog = $response->toArray();

            if (empty($backlog) || !isset($backlog['sprints'])) {
                return response()->json(['error' => 'AI returned an unexpected format.'], 422);
            }

            // إرجاع كائن الباكلوج كاملاً للفرونت إند
            return response()->json(['backlog' => $backlog]);
        } catch (\Exception $e) {
            Log::error('AI backlog error', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Could not connect to AI service: ' . $e->getMessage()], 500);
        }
    }
}
