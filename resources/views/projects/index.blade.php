<x-layouts.front title="Projects">
    <section class="flex flex-col gap-6">
        <div class="flex justify-between items-center">
            <h2 class="font-display text-headline-lg text-on-surface">All Projects</h2>
            <a href="{{ route('projects.create') }}" class="px-4 py-2 bg-primary text-on-primary rounded-md hover:bg-primary/80 transition">Create Project</a>
        </div>
        @if($projects->isEmpty())
            <p class="text-on-surface-variant">No projects found.</p>
        @else
            <table class="min-w-full bg-surface-container-lowest rounded-lg overflow-hidden">
                <thead class="bg-surface-container-highest">
                    <tr>
                        <th class="px-4 py-2 text-left text-label-md text-on-surface-variant">Title</th>
                        <th class="px-4 py-2 text-left text-label-md text-on-surface-variant">Description</th>
                        <th class="px-4 py-2 text-left text-label-md text-on-surface-variant">Tasks</th>
                        <th class="px-4 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                        <tr class="border-b border-outline/10">
                            <td class="px-4 py-2 text-on-surface">{{ $project->title }}</td>
                            <td class="px-4 py-2 text-on-surface-variant">{{ $project->summary }}</td>
                            <td class="px-4 py-2 text-on-surface-variant">
                                <a href="{{ route('projects.show', $project) }}" class="text-primary hover:underline">View Tasks ({{ $project->tasks->count() }})</a>
                            </td>
                            <td class="px-4 py-2 text-right">
                                <a href="{{ route('projects.edit', $project) }}" class="text-primary mr-2">Edit</a>
                                <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline" onsubmit="return confirm('Delete this project?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">{{ $projects->links() }}</div>
        @endif
    </section>
</x-layouts.front>