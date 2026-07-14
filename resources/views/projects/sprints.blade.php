<x-layouts.front title="{{ $project->title }} — Sprints">
    <section class="flex flex-col gap-8">

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-1 text-label-md text-on-surface-variant hover:text-primary transition-colors mb-3">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    All Projects
                </a>
                <h2 class="font-display text-headline-lg text-on-surface">{{ $project->title }}</h2>
                @if($project->summary)
                    <p class="font-body-md text-on-surface-variant mt-2 max-w-3xl">{{ $project->summary }}</p>
                @endif
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <span class="px-4 py-2 rounded-xl bg-primary-container text-on-primary-container font-label-md">
                    {{ $project->sprints->count() }} sprint(s)
                </span>
                <a href="{{ route('projects.show', $project) }}" class="px-4 py-2 rounded-xl border border-outline/20 text-on-surface-variant font-label-md hover:bg-surface-container-high transition-all">
                    View All Tasks
                </a>
            </div>
        </div>

        @if($project->sprints->isEmpty())
            <div class="bg-surface-container-lowest border border-outline/8 rounded-2xl p-10 text-center">
                <span class="material-symbols-outlined text-[48px] text-on-surface-variant/40">sprint</span>
                <p class="font-body-md text-on-surface-variant mt-4">No sprints for this project yet.</p>
                <a href="{{ route('ai.index') }}" class="inline-flex items-center gap-2 mt-4 text-primary font-label-md hover:underline">
                    <span class="material-symbols-outlined text-[18px]">auto_awesome</span>
                    Generate a backlog with AI
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($project->sprints->sortBy('sprint_number') as $sprint)
                    <div class="bg-surface-container-lowest border border-outline/8 rounded-2xl overflow-hidden border-l-4 border-primary">
                        <div class="p-6 border-b border-outline/8">
                            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                                <div>
                                    <p class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant mb-1">
                                        Sprint {{ $sprint->sprint_number }}
                                    </p>
                                    <h3 class="font-display text-headline-md text-on-surface font-bold">{{ $sprint->title }}</h3>
                                    @if($sprint->goal)
                                        <p class="font-body-md text-on-surface-variant mt-2">{{ $sprint->goal }}</p>
                                    @endif
                                </div>
                                <div class="text-right shrink-0">
                                    <p class="font-label-sm text-on-surface-variant">{{ $sprint->tasks->count() }} stories</p>
                                </div>
                            </div>
                        </div>

                        @if($sprint->tasks->isEmpty())
                            <div class="p-6 text-on-surface-variant font-body-md">No user stories in this sprint.</div>
                        @else
                            <div class="p-6 space-y-4">
                                @foreach($sprint->tasks as $task)
                                    <div class="bg-surface rounded-xl p-5 border border-outline/6 space-y-3">
                                        <div class="flex items-start justify-between gap-3">
                                            <div>
                                                <h4 class="font-headline-md text-label-md font-semibold text-on-surface">{{ $task->title }}</h4>
                                                @if($task->description)
                                                    <p class="font-body-md text-on-surface-variant mt-2 leading-relaxed">{{ $task->description }}</p>
                                                @endif
                                            </div>
                                            <span class="px-2 py-1 rounded-full text-[11px] font-bold shrink-0
                                                @if($task->priority?->value === 'high') bg-[#ffe4e4] text-[#a43c12]
                                                @elseif($task->priority?->value === 'med') bg-[#fff3e0] text-[#795200]
                                                @else bg-[#e8f5e9] text-[#1b5e20] @endif">
                                                {{ strtoupper($task->priority?->value ?? 'low') }}
                                            </span>
                                        </div>

                                        @if($task->acceptanceCriteria->isNotEmpty())
                                            <div>
                                                <p class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant mb-2">Acceptance Criteria</p>
                                                <ul class="space-y-1">
                                                    @foreach($task->acceptanceCriteria as $criterion)
                                                        <li class="flex items-start gap-2 text-label-md text-on-surface-variant">
                                                            <span class="material-symbols-outlined text-primary text-[16px] mt-0.5 shrink-0">check_circle</span>
                                                            {{ $criterion->criteria }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

    </section>
</x-layouts.front>
