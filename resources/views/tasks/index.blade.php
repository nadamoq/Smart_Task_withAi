<x-layouts.front title="My Tasks">
    <!-- Header & Filters -->
    <section class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
        <div>
            <h2 class="font-display text-headline-lg text-on-surface mb-2">Workspace Tasks</h2>
            <p class="font-body-md text-on-surface-variant">Managing {{ $count??0 }} active
                task{{ $count != 1 ? 's' : '' }}</p>
        </div>
        <div class="flex flex-wrap gap-2">

            @foreach ($categories as $category)
                <a href="{{ route('tasks.index', ['filter' => $category['id']]) }}"
                    class="px-6 py-2 rounded-full @if ($filter && $filter == $category['id']) bg-primary text-on-primary @else
                                         bg-surface-container-highest text-on-surface-variant @endif font-label-md hover:bg-surface-variant transition-all">
                    {{ ucfirst($category['name']) }}
                </a>
            @endforeach

        </div>
    </section>
    <!-- Task List (Main Content) -->
    <div class="space-y-3">
        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded-md font-label-sm text-sm">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="col-span-12 lg:col-span-8 space-y-4">
        <!-- Task Item -->
        @foreach ($tasks as $task)
            <div
                class="group relative bg-surface-container-lowest border border-outline/8 p-6 rounded-xl hover:shadow-xl hover:shadow-primary/5 transition-all duration-300 flex items-center gap-6">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-primary rounded-l-xl"></div>
                <input  @checked($task->priority == App\Enums\Priority::HIGH)
                    class="spring-checkbox w-6 h-6 rounded border-2 border-outline-variant text-primary focus:ring-primary cursor-pointer transition-all"
                    type="checkbox" />
                <div class="flex-1">
                    <a href="{{ route('tasks.show', $task->id) }}">
                        <h3
                            class="@if($task->status->value=='completed') font-headline-md text-body-lg text-on-surface line-through @else font-headline-md text-body-lg text-on-surface group-hover:text-primary transition-colors @endif">
                            {{ $task->title }}</h3>
                    </a>
                    <div class="flex items-center gap-4 mt-2">
                        <span class="flex items-center gap-1 text-label-sm text-on-surface-variant">
                            <span class="material-symbols-outlined text-[18px]"
                                data-icon="calendar_today">calendar_today</span>
                            {{ date('M j, Y', strtotime($task->due_date)) }}
                        </span>
                        <span
                            class="px-3 py-1 rounded-full {{ $task->priority->color() }} text-label-sm">
                            {{ ucfirst($task->priority->value) }} Priority</span>
                        <span class="px-3 py-1 rounded-full {{ $task->status->color() }} text-label-sm">
                            {{ ucfirst($task->status->value) }}</span>
                    </div>
                </div>
                <div class="flex flex-col items-end gap-2">
                    <a href="{{ route('tasks.edit', $task) }}"
                        class="px-4 py-2 rounded-full bg-surface-container-highest text-on-surface text-label-sm font-medium hover:bg-surface-variant transition-all">
                        Edit
                    </a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                        onsubmit="return confirm('Delete this task?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 rounded-full bg-secondary-fixed text-on-secondary-fixed text-label-sm font-medium hover:bg-secondary-fixed/90 transition-all">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
        <!-- Task Item -->
        <div
            class="group relative bg-surface-container-lowest border border-outline/8 p-6 rounded-xl hover:shadow-xl hover:shadow-primary/5 transition-all duration-300 flex items-center gap-6">
            <div class="absolute left-0 top-0 bottom-0 w-1 bg-tertiary rounded-l-xl"></div>
            <input
                class="spring-checkbox w-6 h-6 rounded border-2 border-outline-variant text-primary focus:ring-primary cursor-pointer transition-all"
                type="checkbox" />
            <div class="flex-1">
                <h3 class="font-headline-md text-body-lg text-on-surface group-hover:text-primary transition-colors">
                    Homepage Illustration Series</h3>
                <div class="flex items-center gap-4 mt-2">
                    <span class="flex items-center gap-1 text-label-sm text-on-surface-variant">
                        <span class="material-symbols-outlined text-[18px]"
                            data-icon="calendar_today">calendar_today</span>
                        Oct 28, 2023
                    </span>
                    <span
                        class="px-3 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed-variant text-label-sm">Medium
                        Priority</span>
                    <span
                        class="px-3 py-1 rounded-full bg-outline-variant/20 text-outline text-label-sm">Planning</span>
                </div>
            </div>
            <div class="flex -space-x-2">
                <img class="w-8 h-8 rounded-full border-2 border-surface"
                    data-alt="A young male designer with a focused and artistic look, wearing modern glasses in a bright, light-filled creative studio. The aesthetic is professional, clean, and optimistic, using high-key lighting consistent with a porcelain and teal brand theme."
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDdNR2DUHgUqo5o0iLYT06DoCXbDQIBTTxn2ZFitDnXR1wnTE2O-MfedHy87YlO9HRceS8-Od37fDt1HgnqXWaDfo_Lr51V0HxQmZTj-ValxS2wApxlf-aGCQFuIfpCX0qKRPuzhjuSPjJGryZwIjgWFAnHlBzlQ7amqdK1_wK6H8ZDpiT9REvZpT0bIgfwxKGdSLkiTrcTDClBb0SKaVuy3NHqPG8fe--Sl398A_tNrzjlVTW5y-AWHtUbOkT7Nhvb8Z3PWVIP4hPR" />
            </div>
        </div>
        <!-- Task Item -->
        <div
            class="group relative bg-surface-container-lowest border border-outline/8 p-6 rounded-xl hover:shadow-xl hover:shadow-primary/5 transition-all duration-300 flex items-center gap-6 opacity-60">
            <div class="absolute left-0 top-0 bottom-0 w-1 bg-secondary rounded-l-xl"></div>
            <input checked=""
                class="spring-checkbox w-6 h-6 rounded border-2 border-outline-variant text-primary focus:ring-primary cursor-pointer transition-all"
                type="checkbox" />
            <div class="flex-1">
                <h3 class="font-headline-md text-body-lg text-on-surface line-through">Draft Q4 Content
                    Strategy</h3>
                <div class="flex items-center gap-4 mt-2">
                    <span class="flex items-center gap-1 text-label-sm text-on-surface-variant">
                        <span class="material-symbols-outlined text-[18px]"
                            data-icon="calendar_today">calendar_today</span>
                        Completed
                    </span>
                    <span class="px-3 py-1 rounded-full bg-surface-variant text-on-surface-variant text-label-sm">Low
                        Priority</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Sidebar Panel (Asymmetric) -->
    <div class="col-span-12 lg:col-span-4 space-y-gutter">
        <!-- Sprint Velocity -->
        <div class="bg-surface-container-lowest border border-outline/8 p-gutter rounded-xl">
            <div class="flex justify-between items-center mb-6">
                <h4 class="font-headline-md text-label-md text-on-surface">Sprint Velocity</h4>
                <span class="material-symbols-outlined text-primary" data-icon="trending_up">trending_up</span>
            </div>
            <div class="flex items-end gap-2 h-32 mb-4">
                <div
                    class="flex-1 bg-primary-fixed-dim/30 rounded-t-lg h-[40%] transition-all hover:h-[45%] cursor-pointer">
                </div>
                <div
                    class="flex-1 bg-primary-fixed-dim/30 rounded-t-lg h-[65%] transition-all hover:h-[70%] cursor-pointer">
                </div>
                <div class="flex-1 bg-primary rounded-t-lg h-[85%] transition-all hover:h-[90%] cursor-pointer">
                </div>
                <div
                    class="flex-1 bg-primary-fixed-dim/30 rounded-t-lg h-[55%] transition-all hover:h-[60%] cursor-pointer">
                </div>
                <div
                    class="flex-1 bg-primary-fixed-dim/30 rounded-t-lg h-[75%] transition-all hover:h-[80%] cursor-pointer">
                </div>
            </div>
            <div class="flex justify-between items-center text-label-sm text-on-surface-variant">
                <span>Cycle 12</span>
                <span class="text-primary font-bold">84% Efficiency</span>
            </div>
        </div>
        <!-- Collaborators -->
        <div class="bg-surface-container-lowest border border-outline/8 p-gutter rounded-xl relative overflow-hidden">
            <div class="absolute right-0 top-0 w-16 h-16 bg-secondary-container/10 rounded-bl-full">
            </div>
            <h4 class="font-headline-md text-label-md text-on-surface mb-6">Active Collaborators</h4>
            <div class="space-y-4">
                <div class="flex items-center gap-4">
                    <img class="w-10 h-10 rounded-full"
                        data-alt="Close up of a creative professional woman with a minimalist and sophisticated style, working in a warm, brightly lit environment. The lighting creates soft shadows that emphasize the premium, high-contrast look of a modern artistic digital interface."
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDudJ4j3vuBGZNQ55ACudC2qoBTo5R5Itm2qXBYyUSTjQ3WSpT3HZn2ORm6c5fA5dcUOwkhITrImtwtJEvrcPeH5QuGXQl7fyL88ihug3E2-gDeyHhVnigWKJgonUEsLr7bFTEn7ZFu9c3S67OIwi3Ekkixy9jm2bkGSQuwFzuh_tHaOfVp70T_RQ2rfqP2q28tKMPYSEnu4ZRSqDXeXJpEETnW9o2muHn5u4oWSoukU2_bwoR_zF6sxH4t5T-gXcIEjHiImh_8h7JQ" />
                    <div class="flex-1">
                        <p class="font-label-md text-label-md text-on-surface">Elena Rodriguez</p>
                        <p class="text-label-sm text-on-surface-variant">Lead Designer</p>
                    </div>
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                </div>
                <div class="flex items-center gap-4">
                    <img class="w-10 h-10 rounded-full"
                        data-alt="A focused male developer working in a sleek, modern workspace with artistic geometric accents in the background. High-key lighting and a palette of navy and teal create a professional and intentional mood, fitting for a creative productivity platform."
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBJIGEOlZrJhD-WnTkzx4kBGozB-vsTF_tQng_MrcAY2j1NlGEWfTRK84tr-qQgSw7sZ6KHVTyQqengGk94_BAN7AYLpHa0L63T-2mEAt0y3K5edn437v4TozAXV2OrrQ4Hl3COgzJ1GjTqhiRGBW0mPll3nPE09abhRigUMqpt78Y-ZgTrTKsXNlsSqT5D_RtOhEQuI6BqLK9xPe9xcBqF07L3DsAYL9A2iKi6VoJ57-0XZbTAnXdoVEQjwF4kbXfMUC52jOvnEX1J" />
                    <div class="flex-1">
                        <p class="font-label-md text-label-md text-on-surface">Marcus Chen</p>
                        <p class="text-label-sm text-on-surface-variant">Full Stack Dev</p>
                    </div>
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                </div>
                <div class="flex items-center gap-4">
                    <img class="w-10 h-10 rounded-full"
                        data-alt="Portrait of a creative project manager with an approachable and empowered expression. The image is bright, airy, and features sophisticated tonal layering, perfectly aligning with a premium digital gallery-style user interface."
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAFHikYwDi6PJmtN6xiXY7crXpqrwd6NmuwxSVQWlDut-ldz9PLgXo4lwREjbH03sie34wP3tb9Gi3ukTBHzcBtlvMEDRhOGeSfS0iAvnhqqHFQCkHb8dUAUTjC8isEmYWz9W1WhQAv-GIfIX07LJFV9iamiDFH22V7iou1iyiEBdoKrCv3M3aFmIZaiHMrnM-LHkl5cxRNdO39jyfSfTAxsx2xgNFG5O8q3j3b6vt6YIahmN5cOssCEYMsydvOVLxZzIYz2Qa0qQ15" />
                    <div class="flex-1">
                        <p class="font-label-md text-label-md text-on-surface">Sarah Jenkins</p>
                        <p class="text-label-sm text-on-surface-variant">Content Strategist</p>
                    </div>
                    <span class="w-2 h-2 rounded-full bg-outline-variant"></span>
                </div>
            </div>
            <button
                class="w-full mt-6 py-2 border-2 border-outline/10 text-primary font-label-md rounded-lg hover:bg-primary/5 transition-all">View
                Team Directory</button>
        </div>
        <!-- Creative Accent Card -->
        <div class="bg-primary-container p-gutter rounded-xl text-on-primary-container relative overflow-hidden group">
            <div
                class="absolute -right-4 -bottom-4 w-32 h-32 bg-on-primary-container/10 rounded-full transition-transform group-hover:scale-125 duration-700">
            </div>
            <span class="material-symbols-outlined text-4xl mb-4 block" data-icon="auto_awesome">auto_awesome</span>
            <h5 class="font-headline-md text-label-md mb-2">Artistic Insight</h5>
            <p class="text-label-sm opacity-90 leading-relaxed mb-4">Your creative output is 15% higher
                in the morning sessions. Try scheduling complex design tasks before 11 AM.</p>
            <a class="font-label-md text-label-md border-b-2 border-on-primary-container inline-block"
                href="#">Review Analysis</a>
        </div>
    </div>

</x-layouts.front>
