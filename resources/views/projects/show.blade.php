<x-layouts.front title="Project Details">
    <section class="flex flex-col gap-6">
        <div class="flex justify-between items-center">
            <h2 class="font-display text-headline-lg text-on-surface">{{ $project->title }}</h2>
            <a href="{{ route('projects.edit', $project) }}" class="px-4 py-2 bg-primary text-on-primary rounded-md hover:bg-primary/80 transition">Edit Project</a>
        </div>
        <p class="text-on-surface-variant">{{ $project->description }}</p>
        <h3 class="font-label-md text-primary mt-4">Tasks ({{ $project->tasks->count() }})</h3>
        @if($project->tasks->isEmpty())
            <p class="text-on-surface-variant">No tasks for this project.</p>
        @else
            <ul class="space-y-2">
                @foreach($project->tasks as $task)
                    <li class="flex items-center justify-between bg-surface-container-lowest p-4 rounded-md">
                        <a href="{{ route('tasks.show', $task) }}" class="text-primary hover:underline">{{ $task->title }}</a>
                        <span class="text-sm text-on-surface-variant">{{ $task->priority }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
        <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" class="px-4 py-2 bg-primary text-on-primary rounded-md hover:bg-primary/80 transition mt-4">Add Task to Project</a>
    </section>
</x-layouts.front>
