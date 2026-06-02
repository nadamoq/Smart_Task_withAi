<?php

namespace App\Http\Controllers;

use App\actions\FileUpload;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter');

        $tasks = Task::query();
        if ($filter) {
            $tasks = $tasks->where('categories_id', $filter);
        }
        $count = $tasks->count();
        $tasks = $tasks->latest()->get();

        $categories = Category::all();
        return view('tasks.index', compact('tasks', 'filter', 'count', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('tasks.create', ['task' => new Task(), 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request, FileUpload $fileUpload)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $data['attachment'] = $fileUpload->upload('attachment', 'tasks/attachments', 'public');
        Task::create($data);
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
       
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
      
        $categories = Category::all();
        return view('tasks.edit', compact('task', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task, FileUpload $fileUpload)
    {
        $data = $request->validated();

        if($request->hasFile('attachment')){

            $data['attachment'] = $fileUpload->upload('attachment', 'tasks/attachments', 'public');

        }
        $updated = $task->update($data);
        
        if ($updated && $task->wasChanged('attachment') ) {

            Storage::disk('public')->delete($task->getOriginal('attachment'));
        }


        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
    public function complete(Task $task)
    {

        
        if ($task->status === 'completed') {
            return back()->with('info', 'Task is already completed.');
        }
        $task->update([
            'status' => 'completed'
        ]);

        return back();
    }
}
