<x-layouts.front title="Edit Task">
  
    @include('tasks.form', ['task' => $task, 'method' => 'PUT', 'action' => route('tasks.update', $task)])

</x-layouts.front>