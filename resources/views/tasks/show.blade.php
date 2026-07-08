<x-layouts.front title="Task Details">

    <!-- Breadcrumbs -->
    <div class="flex items-center space-x-2 mb-8 font-label-md text-label-md text-on-surface-variant">
        <a href="{{ route('tasks.index') }}"> <span class="hover:text-primary cursor-pointer">Tasks</span></a>
        <span class="material-symbols-outlined text-[16px]" data-icon="chevron_right">chevron_right</span>
        <span class="text-on-surface font-bold">{{ $task->title }}</span>
    </div>
    <!-- Header Section -->
    <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="max-w-3xl">
            <div class="flex flex-wrap items-center gap-4 mb-4">
                <span
                    class="px-4 py-1 rounded-full {{ $task->status->color() }} font-label-sm text-label-sm flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]" data-icon="{{$task->status->icons()}}">{{$task->status->icons()}}</span>
                    {{ ucfirst($task->status->value) }}
                </span>
                <span
                    class="px-4 py-1 rounded-full {{ $task->priority->color() }} font-label-sm text-label-sm flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]" data-icon="{{$task->priority->icons()}}">{{$task->priority->icons()}}</span>
                    {{ ucfirst($task->priority->value) }}Priority
                </span>
            </div>
            <h2 class="font-display text-display text-on-surface leading-tight">{{ $task->title }}</h2>
        </div>

        <div class="flex gap-4">
            <a href="{{ route('tasks.edit', $task) }}"
                class="bg-surface-container-high text-primary px-6 py-3 rounded-xl font-bold font-label-md border-2 border-primary hover:bg-primary hover:text-on-primary transition-all flex items-center gap-2 shadow-sm">
                <span class="material-symbols-outlined" data-icon="edit">edit</span>
                Edit Task
            </a>

            @if ($task->status->value !== 'completed')
                <form id="EditForm" action="{{ route('tasks.complete', $task) }}" method="POST" class="hidden">
                    @csrf
                    @method('PUT')
                </form>

                <button onclick="document.getElementById('EditForm').submit()"
                    class="bg-primary text-on-primary px-6 py-3 rounded-xl font-bold font-label-md hover:bg-surface-tint transition-all flex items-center gap-2 shadow-sm">
                    <span class="material-symbols-outlined" data-icon="done_all">done_all</span>
                    Complete
                </button>
            @endif

        </div>

    </div>
    <div class="space-y-3">
        @if (session('info'))
            <div class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-md font-label-sm text-sm">
                {{ session('info') }}
            </div>
        @endif
    </div>
    <!-- Layout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
        <!-- Left Column: Primary Content -->
        <div class="lg:col-span-8 space-y-10">
            <!-- Creative Brief -->
            <section
                class="bg-surface-container-lowest p-8 rounded-xl border border-on-background/5 artistic-accent-teal shadow-sm">
                <h3 class="font-headline-md text-headline-md mb-6 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary"
                        data-icon="description"></span>
                    Creative Brief
                </h3>
                <div class="font-body-lg text-body-lg text-on-surface-variant space-y-4 leading-relaxed">
                    <p>{{ $task->description }}</p>
                    <p>Focus on the iconography weight—specifically, ensure all Material Symbols use the 400
                        weight with no fill unless specified. The typographic scale must remain tight and
                        bold for headers.</p>
                </div>
            </section>
            <!-- Assets Grid -->
            <section>

                <div class="space-y-3">
                    @if (session('files'))
                        <div class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-md font-label-sm text-sm">
                            {{ session('files') }}
                        </div>
                    @endif
                </div>

                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-headline-md text-headline-md flex items-center gap-3">
                        <span class="material-symbols-outlined text-tertiary" data-icon="attachment">attachment</span>
                        Creative Assets
                    </h3>
                    <button onclick="document.getElementById('EditForm').submit()"
                        class="text-primary font-label-md flex items-center gap-1 hover:underline">
                        <span class="material-symbols-outlined" data-icon="upload">upload</span>
                        Save Assets
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Asset Card 1 -->
                    <div class="group cursor-pointer">
                        <div
                            class="relative aspect-video rounded-xl overflow-hidden mb-3 border border-on-background/10 bg-surface-container-high transition-transform group-hover:scale-[1.02]">
                            <img class="w-full h-full object-cover"
                                data-alt="A professional high-contrast moodboard for a creative design agency featuring a sophisticated color palette of deep navy blue, vibrant teal, and energetic coral. The composition is artistic and minimalist, showing swatches of digital textures and geometric typography samples arranged in a clean grid. The lighting is soft and modern, evoking a high-end studio atmosphere."
                                src="{{ Storage::url($task->attachment) }}" />
                            <div
                                class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-4xl"
                                    data-icon="zoom_in">zoom_in</span>
                            </div>
                        </div>
                        <p class="font-label-md text-label-md text-on-surface mb-1">{{ $task->attachment_name }}</p>
                        <p class="text-[12px] text-on-surface-variant">2.4 MB • Oct 12, 2023</p>
                    </div>
                   
                    <!-- Asset Card 3 -->
                    <form id="EditForm" action="{{ route('tasks.update', $task) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <label for="attachment">
                            <div class="group cursor-pointer">

                                <div
                                    class="flex items-center justify-center aspect-video rounded-xl border-2 border-dashed border-outline-variant bg-surface-container-low hover:bg-surface-container-high transition-colors">
                                    <span class="material-symbols-outlined text-outline text-4xl"
                                        data-icon="add_circle">add_circle</span>
                                </div>

                                <p class="font-label-md text-label-md text-on-surface-variant mt-3 text-center">Add
                                    more assets</p>

                            </div>
                        </label>
                        <input id="attachment" name="attachment" type="file"
                            accept="image/*,.pdf,.doc,.docx,.xls,.xlsx,.txt,.zip" class="hidden" />

                    </form>
                </div>

            </section>
            <!-- Subtasks -->
            <section
                class="bg-surface-container-low/50 p-8 rounded-xl border border-on-background/5 artistic-accent-amber">
                <h3 class="font-headline-md text-headline-md mb-6">Execution Steps</h3>
                <div class="space-y-4">
                    <label
                        class="flex items-center p-4 bg-white rounded-lg border border-on-background/5 cursor-pointer hover:border-primary transition-all group">
                        <input checked=""
                            class="w-6 h-6 border-2 border-primary text-primary focus:ring-primary rounded transition-all mr-4"
                            type="checkbox" />
                        <span
                            class="font-body-md text-body-md text-on-surface-variant line-through decoration-primary">Audit
                            existing color accessibility contrast ratios</span>
                    </label>
                    <label
                        class="flex items-center p-4 bg-white rounded-lg border border-on-background/5 cursor-pointer hover:border-primary transition-all group">
                        <input
                            class="w-6 h-6 border-2 border-primary text-primary focus:ring-primary rounded transition-all mr-4"
                            type="checkbox" />
                        <span class="font-body-md text-body-md text-on-surface">Finalize the 'Artistic
                            Precision' iconography set (120 icons)</span>
                    </label>
                    <label
                        class="flex items-center p-4 bg-white rounded-lg border border-on-background/5 cursor-pointer hover:border-primary transition-all group">
                        <input
                            class="w-6 h-6 border-2 border-primary text-primary focus:ring-primary rounded transition-all mr-4"
                            type="checkbox" />
                        <span class="font-body-md text-body-md text-on-surface">Apply 4px vertical artistic
                            accents to all container templates</span>
                    </label>
                </div>
            </section>
        </div>
        <!-- Right Column: Sidebar Details -->
        <div class="lg:col-span-4 space-y-8">
            <!-- Task Properties -->
            <section class="bg-surface p-6 rounded-xl border border-on-background/10 shadow-sm">
                <h4 class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant mb-6">
                    Task Properties</h4>
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <span class="flex items-center gap-2 text-on-surface-variant font-label-md">
                            <span class="material-symbols-outlined text-[18px]"
                                data-icon="calendar_today">calendar_today</span>
                            Due Date
                        </span>
                        <span class="font-bold text-on-surface">{{ date('M j, Y', strtotime($task->due_date)) }}</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="flex items-center gap-2 text-on-surface-variant font-label-md">
                            <span class="material-symbols-outlined text-[18px]"
                                data-icon="folder_open">folder_open</span>
                            Project
                        </span>
                        <span class="font-bold text-primary">{{$task->project?->title??'public project'}}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="flex items-center gap-2 text-on-surface-variant font-label-md">
                            <span class="material-symbols-outlined text-[18px]" data-icon="label">label</span>
                            Tags
                        </span>
                        <div class="flex gap-2">
                            <span
                                class="bg-secondary-fixed text-on-secondary-fixed-variant px-3 py-1 rounded-full text-[10px] font-bold">DESIGN</span>
                            <span
                                class="bg-primary-fixed text-on-primary-fixed-variant px-3 py-1 rounded-full text-[10px] font-bold">SYSTEM</span>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Collaborators -->
            <section class="bg-surface p-6 rounded-xl border border-on-background/10 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h4 class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">
                        Collaborators</h4>
                    <span class="material-symbols-outlined text-primary cursor-pointer"
                        data-icon="person_add">person_add</span>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <img alt="Avatar" class="w-10 h-10 rounded-full border border-primary-container"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAWAebyaPahlCacxblkKCxdK8p4yC1L1nKtcSkJIiKYnfjC7SQkPeWRYJNRVSwuP3lON88lDLYFmVIdqx50PH0ohc9swDkePtF8BR07ho8JpPXOb8I2Kv7CfEQx2vvaNPagZRYVwVn1a-cUC_V6beMEepBrJFn_3imTPAk2I-bXHAdzjuX7VysblfJZ8OD19hwNH2pbcRADXTHZlOqtcwgw-aFzYOh_eN1_hs23J62bdSGia_NCBb8sfTd2IRds1moUR4j3FBHA1mOx" />
                                <div
                                    class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white">
                                </div>
                            </div>
                            <div>
                                <p class="font-label-md text-label-md font-bold">{{$task->user->name}}</p>
                                <p class="text-[12px] text-on-surface-variant">Art Director</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-on-surface-variant text-[20px]"
                            data-icon="chat">chat</span>
                    </div>
                    <div class="flex items-center justify-between opacity-70">
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <img alt="Avatar"
                                    class="w-10 h-10 rounded-full border border-surface-container-high"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDqFViXzA2YVqCQ7NGzs_Cadvjljd16x2vPuFru8uY4vczP2Yjoq7151VwGER-MUKFxBQlHslLxHV3Bi0mgp7HpERpNxi8cEjGERJQXQhPx8Xs27YB1HlIMyAmvB6i44IgMVa9fXEJhHKiWXQpMkpBOR-6fOpJiifF34348o4MevdPoM4TZyDpM2iWWs519PAUk2jBAHrvZGLu-HVy0_2kSBPhF_shSyD0nVQln9fv1j2vYw1PDrPwudcoRiRVDPnrvfA_VDXWMHYtt" />
                            </div>
                            <div>
                                <p class="font-label-md text-label-md font-bold">Sarah Reed</p>
                                <p class="text-[12px] text-on-surface-variant">UX Designer</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-on-surface-variant text-[20px]"
                            data-icon="chat">chat</span>
                    </div>
                </div>
            </section>
            <!-- Activity Feed -->
            <section class="bg-surface p-6 rounded-xl border border-on-background/10 shadow-sm">
                <h4 class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant mb-6">
                    Activity</h4>
                <div
                    class="space-y-6 relative before:content-[''] before:absolute before:left-[19px] before:top-2 before:bottom-0 before:w-px before:bg-surface-container-highest">
                    <div class="relative pl-10">
                        <div
                            class="absolute left-0 top-0 w-10 h-10 flex items-center justify-center bg-white border border-surface-container rounded-full z-10">
                            <span class="material-symbols-outlined text-tertiary text-[18px]"
                                data-icon="history_edu">history_edu</span>
                        </div>
                        <p class="text-label-md font-bold text-on-surface">Alex Miller updated the brief
                        </p>
                        <p class="text-[12px] text-on-surface-variant">2 hours ago</p>
                    </div>
                    <div class="relative pl-10">
                        <div
                            class="absolute left-0 top-0 w-10 h-10 flex items-center justify-center bg-white border border-surface-container rounded-full z-10">
                            <span class="material-symbols-outlined text-primary text-[18px]"
                                data-icon="forum">forum</span>
                        </div>
                        <div class="bg-surface-container-low p-4 rounded-lg mt-2">
                            <p class="font-body-md text-body-md text-on-surface-variant italic leading-snug">
                                "I've attached the latest moodboard for review. Let's aim for these teal
                                saturations."</p>
                        </div>
                        <p class="text-[12px] text-on-surface-variant mt-1">4 hours ago</p>
                    </div>
                </div>
                <!-- Comment Input -->
                <div class="mt-8">
                    <div class="writing-line px-4 py-3 flex items-center gap-3">
                        <input class="bg-transparent border-none focus:ring-0 flex-grow text-body-md"
                            placeholder="Add a comment..." type="text" />
                        <button class="text-primary hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined" data-icon="send">send</span>
                        </button>
                    </div>
                </div>
            </section>
        </div>
    </div>
    </div>
    </main>

    <!-- Background Atmospheric Shapes -->
    <div class="fixed -top-24 -right-24 w-96 h-96 bg-primary/5 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div
        class="fixed top-1/2 -left-48 w-[500px] h-[500px] bg-secondary/3 rounded-full blur-[100px] pointer-events-none -z-10">
    </div>
    @push('script')
        <script>
            // Micro-interaction for checkboxes
            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const label = this.closest('label').querySelector('span');
                    if (this.checked) {
                        label.classList.add('line-through', 'decoration-primary', 'text-on-surface-variant');
                    } else {
                        label.classList.remove('line-through', 'decoration-primary', 'text-on-surface-variant');
                    }
                });
            });

            // Hover effect for interactive elements
            document.querySelectorAll('.group').forEach(el => {
                el.addEventListener('mouseenter', () => {
                    el.style.transform = 'translateY(-2px)';
                });
                el.addEventListener('mouseleave', () => {
                    el.style.transform = 'translateY(0)';
                });
            });
        </script>
    @endpush
</x-layouts.front>
