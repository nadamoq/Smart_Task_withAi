<x-layouts.front title="Create Task">

    @include('tasks.form',['task' => $task, 'method' => 'POST', 'action' => route('tasks.store')])

</x-layouts.front>