<x-layouts.front title="AI Studio">

    {{-- Page Header --}}
    <section class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-2">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div
                    class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center shadow-lg shadow-primary/30">
                    <span class="material-symbols-outlined text-on-primary text-[22px]">auto_awesome</span>
                </div>
                <h2 class="font-display text-headline-lg text-on-surface">AI Studio</h2>
            </div>
            <p class="font-body-md text-on-surface-variant">Turn any idea into structured tasks or a full Agile backlog —
                powered by Gemini AI.</p>
        </div>
        {{-- Mode Toggle --}}
        <div class="flex items-center bg-surface-container-high rounded-2xl p-1 gap-1 shadow-sm">
            <button id="btn-breakdown" onclick="switchMode('breakdown')"
                class="mode-btn flex items-center gap-2 px-5 py-2.5 rounded-xl font-label-md text-label-md transition-all duration-300 bg-primary text-on-primary shadow-md">
                <span class="material-symbols-outlined text-[18px]">checklist</span>
                Task Breakdown
            </button>
            <button id="btn-backlog" onclick="switchMode('backlog')"
                class="mode-btn flex items-center gap-2 px-5 py-2.5 rounded-xl font-label-md text-label-md transition-all duration-300 text-on-surface-variant hover:bg-surface-variant/30">
                <span class="material-symbols-outlined text-[18px]">sprint</span>
                Agile Backlog
            </button>
        </div>
    </section>

    {{-- Input Panel --}}
    <div
        class="bg-surface-container-lowest border border-outline/8 rounded-[28px] p-8 shadow-sm relative overflow-hidden">
        <div
            class="absolute top-0 right-0 w-48 h-48 bg-primary/5 rounded-full blur-2xl -translate-y-12 translate-x-12 pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 left-0 w-32 h-32 bg-tertiary/5 rounded-full blur-xl translate-y-8 -translate-x-8 pointer-events-none">
        </div>

        <div class="relative z-10 space-y-6">
            <div>
                <label id="input-label" class="font-label-md text-primary uppercase tracking-[0.1em] mb-3 block">
                    Describe your feature or idea
                </label>
                <div class="relative">
                    <textarea id="idea-input" rows="4" maxlength="2000"
                        placeholder="e.g. Build a user authentication system with email verification and OAuth support..."
                        class="w-full bg-on-background/[0.03] border-0 border-b-2 border-on-surface-variant/20 py-4 px-1 font-body-md text-on-surface placeholder:text-on-surface-variant/40 focus:border-primary focus:ring-0 transition-all duration-300 resize-none rounded-t-lg"></textarea>
                    <span id="char-count"
                        class="absolute bottom-3 right-3 text-[11px] text-on-surface-variant/50 font-label-sm">0 /
                        2000</span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center">
                <button id="generate-btn" onclick="generate()"
                    class="flex items-center gap-3 bg-primary text-on-primary px-8 py-4 rounded-2xl font-display font-bold text-body-md shadow-lg shadow-primary/25 hover:scale-[1.02] active:scale-95 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:scale-100">
                    <span id="btn-icon" class="material-symbols-outlined">auto_awesome</span>
                    <span id="btn-text">Generate with AI</span>
                </button>
                <p id="mode-hint" class="text-label-sm text-on-surface-variant font-label-sm">
                    Will break your idea into actionable dev tasks with priorities .
                </p>
            </div>

            {{-- Error Banner --}}
            <div id="error-banner"
                class="hidden bg-error/10 border border-error/30 text-error rounded-xl px-5 py-3 font-label-md flex items-center gap-3">
                <span class="material-symbols-outlined text-[20px]">error</span>
                <span id="error-msg"></span>
            </div>
        </div>
    </div>

    {{-- Results Area --}}
    <div id="results-area" class="hidden space-y-6">

        {{-- Results Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 id="results-title" class="font-display text-headline-md text-on-surface"></h3>
                <p id="results-subtitle" class="font-body-md text-on-surface-variant mt-1"></p>
            </div>
            <div>
                <h3 id="results-summary" class="font-display text-headline-md text-on-surface"></h3>
                <p id="results-subtitle" class="font-body-md text-on-surface-variant mt-1"></p>
            </div>
            <button onclick="clearResults()"
                class="flex items-center gap-2 px-4 py-2 rounded-xl border border-outline/20 text-on-surface-variant font-label-md hover:bg-surface-container-high transition-all text-label-md">
                <span class="material-symbols-outlined text-[18px]">refresh</span>
                Start Over
            </button>
        </div>

        {{-- ── TASK BREAKDOWN RESULTS ── --}}
        <div id="breakdown-results" class="hidden space-y-4">

            {{-- Save Tasks Bar --}}
            <div id="save-bar"
                class="hidden bg-primary-fixed/40 border border-primary/20 rounded-2xl px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="space-y-3 flex-1">
                    <p class="font-label-md text-on-surface"><span id="selected-count">0</span> task(s) selected</p>
                    <div class="flex flex-wrap gap-3 items-center">
                        <select id="save-category"
                            class="bg-surface border border-outline/20 rounded-lg font-label-md text-on-surface py-2 px-3 text-label-md focus:ring-primary focus:border-primary">
                            <option value="">— No Category —</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <input id="save-due-project-title" type="text"
                            class="bg-surface border border-outline/20 rounded-lg font-label-md text-on-surface py-2 px-3 text-label-md focus:ring-primary focus:border-primary">

                        <input id="save-due-date" type="date"
                            class="bg-surface border border-outline/20 rounded-lg font-label-md text-on-surface py-2 px-3 text-label-md focus:ring-primary focus:border-primary">
                    </div>
                </div>
                <button id="save-btn" onclick="saveSelectedTasks()"
                    class="flex items-center gap-2 bg-primary text-on-primary px-6 py-3 rounded-xl font-bold font-label-md shadow-md shadow-primary/20 hover:scale-105 active:scale-95 transition-all">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    Save to Tasks
                </button>
            </div>

            {{-- Task Cards Grid --}}
            <div id="task-cards" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4"></div>

        </div>

        {{-- ── AGILE BACKLOG RESULTS ── --}}
        <div id="backlog-results" class="hidden space-y-6">
            <div id="project-summary"
                class="bg-primary-container rounded-2xl p-6 text-on-primary-container relative overflow-hidden">
                <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-on-primary-container/10 rounded-full"></div>
                <p class="font-label-md uppercase tracking-widest mb-2 opacity-70">Project</p>
                <input id="backlog-project-title" type="text"
                    class="w-full bg-transparent border-0 border-b border-on-primary-container/30 font-display text-headline-md mb-3 text-on-primary-container placeholder:text-on-primary-container/50 focus:ring-0 focus:border-on-primary-container"
                    placeholder="Project title">
                <textarea id="backlog-project-summary" rows="2"
                    class="w-full bg-transparent border-0 font-body-md opacity-90 text-on-primary-container placeholder:text-on-primary-container/50 resize-none focus:ring-0"
                    placeholder="Project summary (optional)"></textarea>
            </div>
            <div id="backlog-save-area" class="mt-4 flex justify-end">
                <button onclick="saveBacklog()" id="save-backlog-btn"
                    class="flex items-center gap-2 bg-primary text-on-primary px-6 py-3 rounded-xl font-bold shadow-md hover:scale-105 transition-all">
                    <span class="material-symbols-outlined">save</span>
                    Save Backlog to System
                </button>
            </div>
            <div id="sprints-container" class="space-y-6"></div>
        </div>

    </div>

    {{-- Empty / Loading State --}}
    <div id="skeleton-area" class="hidden space-y-4">
        @for ($i = 0; $i < 6; $i++)
            <div class="bg-surface-container-lowest border border-outline/8 rounded-2xl p-6 animate-pulse">
                <div class="flex items-start gap-4">
                    <div class="w-5 h-5 rounded bg-surface-container-high mt-1"></div>
                    <div class="flex-1 space-y-3">
                        <div class="h-4 bg-surface-container-high rounded-full w-3/4"></div>
                        <div class="h-3 bg-surface-container-high rounded-full w-full"></div>
                        <div class="h-3 bg-surface-container-high rounded-full w-2/3"></div>
                        <div class="flex gap-2 mt-2">
                            <div class="h-6 w-16 bg-surface-container-high rounded-full"></div>
                            <div class="h-6 w-12 bg-surface-container-high rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>

    @push('style')
        <style>
            .task-card {
                transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
            }

            .task-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 12px 32px rgba(0, 101, 101, 0.12);
            }

            .task-card.selected {
                border-color: #006565 !important;
                background: #f0fafa;
                box-shadow: 0 0 0 2px rgba(0, 101, 101, 0.2);
            }

            .sprint-card {
                animation: slideUp 0.4s ease forwards;
                opacity: 0;
            }

            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(16px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            #results-area {
                animation: fadeIn 0.35s ease;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            .priority-high {
                background: #ffe4e4;
                color: #a43c12;
            }

            .priority-med {
                background: #fff3e0;
                color: #795200;
            }

            .priority-low {
                background: #e8f5e9;
                color: #1b5e20;
            }
        </style>
    @endpush

    @push('script')
        <script>
            // ── State ──────────────────────────────────────────────────────────────────
            let currentMode = 'breakdown';
            let selectedTasks = new Set();
            let allGeneratedTasks = [];
            let currentProjectTitle = '';
            let currentProjectSummary = '';
            let currentBacklogData = null;
            let currentIdea = '';

            const CSRF = document.querySelector('meta[name="csrf-token"]')?.content ?? '{{ csrf_token() }}';

            // ── Mode Switching ─────────────────────────────────────────────────────────
            function switchMode(mode) {
                currentMode = mode;
                const hints = {
                    breakdown: 'Will break your idea into actionable dev tasks with priorities ',
                    backlog: 'Will generate a full Agile backlog with sprints, user stories, and acceptance criteria.'
                };
                const labels = {
                    breakdown: 'Describe your feature or idea',
                    backlog: 'Describe your feature or product idea'
                };

                document.getElementById('mode-hint').textContent = hints[mode];
                document.getElementById('input-label').textContent = labels[mode];
                document.getElementById('idea-input').placeholder =
                    mode === 'breakdown' ?
                    'e.g. Build a user authentication system with email verification and OAuth support...' :
                    'e.g. An e-commerce platform where users can browse products, add to cart, and checkout with multiple payment options...';

                // Toggle button styles
                const btnBreakdown = document.getElementById('btn-breakdown');
                const btnBacklog = document.getElementById('btn-backlog');
                const active = 'bg-primary text-on-primary shadow-md';
                const inactive = 'text-on-surface-variant hover:bg-surface-variant/30';

                if (mode === 'breakdown') {
                    btnBreakdown.className =
                        `mode-btn flex items-center gap-2 px-5 py-2.5 rounded-xl font-label-md text-label-md transition-all duration-300 ${active}`;
                    btnBacklog.className =
                        `mode-btn flex items-center gap-2 px-5 py-2.5 rounded-xl font-label-md text-label-md transition-all duration-300 ${inactive}`;
                } else {
                    btnBacklog.className =
                        `mode-btn flex items-center gap-2 px-5 py-2.5 rounded-xl font-label-md text-label-md transition-all duration-300 ${active}`;
                    btnBreakdown.className =
                        `mode-btn flex items-center gap-2 px-5 py-2.5 rounded-xl font-label-md text-label-md transition-all duration-300 ${inactive}`;
                }

                clearResults();
            }

            // ── Character counter ──────────────────────────────────────────────────────
            document.getElementById('idea-input').addEventListener('input', function() {
                document.getElementById('char-count').textContent = `${this.value.length} / 2000`;
            });

            // ── Generate ───────────────────────────────────────────────────────────────
            async function generate() {
                const idea = document.getElementById('idea-input').value.trim();
                if (!idea || idea.length < 10) {
                    showError('Please enter at least 10 characters describing your idea.');
                    return;
                }

                hideError();
                setLoading(true);

                try {
                    const endpoint = currentMode === 'breakdown' ?
                        '{{ route('ai.breakdown') }}' :
                        '{{ route('ai.backlog') }}';

                    const res = await fetch(endpoint, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': CSRF,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            idea
                        }),
                    });

                    const data = await res.json(); // هذا هو الـ Object الذي أرسلتِه لي في الـ Log

                    console.log('AI Response:', data);

                    if (!res.ok || data.error) {
                        showError(data.error ?? data.message ?? 'Something went wrong.');
                        return;
                    }

                    // التعديل هنا: استخراج الـ JSON من الخاصية 'text' وتحويله
                    // let backlogData;
                    // try {
                    //     backlogData = JSON.parse(data.text);
                    // } catch (e) {
                    //     showError('Failed to parse AI response.');
                    //     return;
                    // }

                    if (currentMode === 'breakdown') {


                        // For breakdown: response has tasks array directly
                        currentProjectTitle = data.project_title || '';
                        currentProjectSummary = data.summary || '';
                        renderTaskBreakdown(data.tasks, idea);
                    } else {
                        currentIdea = idea;
                        renderAgileBacklog(data, idea);
                    }

                } catch (err) {
                    console.error('Generation error:', err);
                    showError('Network error: ' + err.message);
                } finally {
                    setLoading(false);
                }
            }

            // ── Render: Task Breakdown ─────────────────────────────────────────────────
            function renderTaskBreakdown(tasks, idea) {
                allGeneratedTasks = Array.isArray(tasks) ? tasks : [];
                selectedTasks.clear();

                if (!allGeneratedTasks.length) {
                    showError('AI returned no tasks. Try rephrasing your idea.');
                    return;
                }

                document.getElementById('results-title').textContent = `${allGeneratedTasks.length} Tasks Generated`;
                document.getElementById('results-subtitle').textContent =
                    `From: "${idea.substring(0, 80)}${idea.length > 80 ? '...' : ''}"`;
                document.getElementById('results-summary').textContent =
                    `From: "${currentProjectSummary.substring(0, 80)}${currentProjectSummary.length > 80 ? '...' : ''}"`;

                // Populate project title input with AI suggestion (user can edit before saving)
                const projectInput = document.getElementById('save-due-project-title');
                if (projectInput) projectInput.value = currentProjectTitle || projectInput.value || '';

                const container = document.getElementById('task-cards');
                container.innerHTML = '';

                allGeneratedTasks.forEach((task, i) => {
                    const priorityClass = `priority-${(task.priority||'low').toLowerCase()}`;
                    const priorityLabel = (task.priority || 'low').toUpperCase();

                    const category = task.category || 'General';

                    const card = document.createElement('div');
                    card.className =
                        'task-card bg-surface-container-lowest border border-outline/8 rounded-2xl p-5 cursor-pointer relative';
                    card.dataset.index = i;
                    card.innerHTML = `
                <div class="absolute top-4 right-4">
                    <input type="checkbox" id="task-check-${i}"
                        class="w-5 h-5 rounded border-2 border-outline-variant text-primary focus:ring-primary cursor-pointer"
                        onchange="toggleTask(${i}, this.checked)">
                </div>
                <div class="pr-8 space-y-3">
                    <p class="font-label-sm text-label-sm text-primary uppercase tracking-wider">${escHtml(category)}</p>
                    <h4 class="font-headline-md text-body-lg text-on-surface font-semibold leading-snug">${escHtml(task.title)}</h4>
                    <p class="font-body-md text-label-md text-on-surface-variant leading-relaxed">${escHtml(task.description)}</p>
                    <div class="flex items-center flex-wrap gap-2 pt-1">
                        <span class="px-3 py-1 rounded-full text-label-sm font-bold ${priorityClass}">${priorityLabel}</span>
                       </div>
                </div>
            `;
                    card.addEventListener('click', (e) => {
                        if (e.target.type === 'checkbox') return;
                        const cb = document.getElementById(`task-check-${i}`);
                        cb.checked = !cb.checked;
                        toggleTask(i, cb.checked);
                    });

                    container.appendChild(card);
                });

                document.getElementById('breakdown-results').classList.remove('hidden');
                document.getElementById('backlog-results').classList.add('hidden');
                document.getElementById('results-area').classList.remove('hidden');

                // Select all by default
                allGeneratedTasks.forEach((_, i) => {
                    const cb = document.getElementById(`task-check-${i}`);
                    if (cb) {
                        cb.checked = true;
                        toggleTask(i, true);
                    }
                });
            }

            function toggleTask(index, checked) {
                const card = document.querySelector(`[data-index="${index}"]`);
                if (checked) {
                    selectedTasks.add(index);
                    card?.classList.add('selected');
                } else {
                    selectedTasks.delete(index);
                    card?.classList.remove('selected');
                }
                updateSaveBar();
            }

            function updateSaveBar() {
                const count = selectedTasks.size;
                const bar = document.getElementById('save-bar');
                document.getElementById('selected-count').textContent = count;
                if (count > 0) {
                    bar.classList.remove('hidden');
                } else {
                    bar.classList.add('hidden');
                }
            }

            // ── Save Tasks ─────────────────────────────────────────────────────────────
            async function saveSelectedTasks() {
                if (!selectedTasks.size) return;

                const tasks = [...selectedTasks].map(i => ({
                    title: allGeneratedTasks[i].title,
                    description: allGeneratedTasks[i].description,
                    priority: allGeneratedTasks[i].priority || 'low',
                }));


                const categories_id = document.getElementById('save-category').value || null;
                const due_date = document.getElementById('save-due-date').value || null;
                const projectTitleInput = document.getElementById('save-due-project-title').value || null;
                const project_title = projectTitleInput || currentProjectTitle || null;

                const btn = document.getElementById('save-btn');
                btn.disabled = true;
                btn.innerHTML =
                    `<span class="material-symbols-outlined text-[18px] animate-spin">progress_activity</span> Saving...`;

                try {
                    const res = await fetch('{{ route('ai.save-tasks') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': CSRF,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            tasks,
                            categories_id,
                            due_date,
                            project_title,
                            summary: currentProjectSummary,
                        }),
                    });

                    const data = await res.json();

                    if (res.ok) {
                        console.log(data)

                        showSuccessToast(data.message);
                        // Uncheck & deselect saved tasks
                        [...selectedTasks].forEach(i => {
                            const cb = document.getElementById(`task-check-${i}`);
                            if (cb) cb.checked = false;
                            document.querySelector(`[data-index="${i}"]`)?.classList.remove('selected');
                        });
                        selectedTasks.clear();
                        updateSaveBar();
                    } else {
                        showError(data.message ?? 'Failed to save tasks.');
                    }
                } catch (err) {
                    showError('Network error while saving: ' + err.message);
                } finally {
                    btn.disabled = false;
                    btn.innerHTML = `<span class="material-symbols-outlined text-[18px]">save</span> Save to Tasks`;
                }
            }

            // ── Render: Agile Backlog ──────────────────────────────────────────────────
            function normalizePriority(p) {
                const key = (p || 'low').toLowerCase();
                if (key === 'high') return 'high';
                if (key === 'medium' || key === 'med') return 'med';
                return 'low';
            }

            function getStoryCriteria(story) {
                return story.acceptanceCriteria || story.acceptance_criteria || [];
            }

            function formatDateRange(sprint) {
                const start = sprint.startDate || sprint.start_date;
                const end = sprint.endDate || sprint.end_date;
                if (start && end) return `${start} → ${end}`;
                return '';
            }

            function renderAgileBacklog(backlog, idea) {
                const sprints = backlog?.sprints ?? backlog?.backlog?.sprints ?? null;

                if (!sprints || !sprints.length) {
                    showError('AI returned an incomplete backlog. Please try again.');
                    return;
                }

                const projectTitle = backlog.project_title || backlog.projectTitle ||
                    idea.substring(0, 80) + (idea.length > 80 ? '…' : '');
                const projectSummary = backlog.project_summary || backlog.projectSummary || idea;

                currentBacklogData = {
                    ...backlog,
                    sprints
                };

                document.getElementById('results-title').textContent = projectTitle;
                document.getElementById('results-subtitle').textContent = `${sprints.length} sprint(s) generated`;

                document.getElementById('backlog-project-title').value = projectTitle;
                document.getElementById('backlog-project-summary').value = projectSummary;

                const sprintsContainer = document.getElementById('sprints-container');
                sprintsContainer.innerHTML = '';

                const sprintColors = ['border-primary', 'border-secondary', 'border-tertiary', 'border-outline'];

                sprints.forEach((sprint, si) => {
                    const colorClass = sprintColors[si % sprintColors.length];
                    const delay = si * 80;
                    const sprintNumber = sprint.sprint_number ?? sprint.id ?? (si + 1);
                    const dateRange = formatDateRange(sprint);
                    const stories = sprint.stories || [];

                    const storiesHtml = stories.map(story => {
                        const criteria = getStoryCriteria(story);
                        const priorityKey = normalizePriority(story.priority);
                        const priorityLabel = (story.priority || 'low').toUpperCase();

                        // هنا "الذكاء" في العرض: إذا لم تتوفر الـ User Story (as_a)، نعرض الـ description كبديل
                        const userStoryHtml = (story.as_a) ? `
        <div class="bg-surface-container-low rounded-lg p-3 text-label-md text-on-surface-variant space-y-1">
            <p><span class="font-semibold text-on-surface">As a</span> ${escHtml(story.as_a)}</p>
            <p><span class="font-semibold text-on-surface">I want</span> ${escHtml(story.i_want || '—')}</p>
            <p><span class="font-semibold text-on-surface">So that</span> ${escHtml(story.so_that || '—')}</p>
        </div>` : `
        <div class="bg-surface-container-low rounded-lg p-3 text-label-md text-on-surface-variant">
            <p class="text-on-surface">${escHtml(story.description || 'No description provided')}</p>
        </div>`;

                        return `
    <div class="bg-surface rounded-xl p-5 border border-outline/6 space-y-3">
        <div class="flex items-start justify-between gap-3">
            <div>
                <span class="font-label-sm text-primary text-[11px] uppercase tracking-wider">${escHtml(story.id || '')}</span>
                <h5 class="font-headline-md text-label-md font-semibold text-on-surface mt-0.5">${escHtml(story.title)}</h5>
            </div>
            <div class="flex items-center gap-2 shrink-0">
                <span class="px-2 py-1 rounded-full text-[11px] font-bold priority-${priorityKey}">${escHtml(priorityLabel)}</span>
            </div>
        </div>
        
        ${userStoryHtml}

        ${criteria.length ? `
                        <div>
                            <p class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant mb-2">Acceptance Criteria</p>
                            <ul class="space-y-1">
                                ${criteria.map(c => `
                    <li class="flex items-start gap-2 text-label-md text-on-surface-variant">
                        <span class="material-symbols-outlined text-primary text-[16px] mt-0.5 shrink-0">check_circle</span>
                        ${escHtml(c)}
                    </li>`).join('')}
                            </ul>
                        </div>` : ''}
    </div>`;
                    }).join('');

                    const sprintEl = document.createElement('div');
                    sprintEl.className =
                        `sprint-card bg-surface-container-lowest border border-outline/8 rounded-2xl overflow-hidden border-l-4 ${colorClass}`;
                    sprintEl.style.animationDelay = `${delay}ms`;

                    sprintEl.innerHTML = `
                <button onclick="toggleSprint(this)" class="w-full flex items-center justify-between p-6 text-left group">
                    <div>
                        <p class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant mb-1">Sprint ${escHtml(String(sprintNumber))}</p>
                        <h4 class="font-display text-headline-md text-on-surface font-bold">${escHtml(sprint.name || sprint.title || `Sprint ${sprintNumber}`)}</h4>
                        ${dateRange ? `<p class="font-body-md text-label-md text-primary mt-1">${escHtml(dateRange)}</p>` : ''}
                        ${sprint.goal ? `<p class="font-body-md text-label-md text-on-surface-variant mt-1">${escHtml(sprint.goal)}</p>` : ''}
                    </div>
                    <div class="flex items-center gap-4 shrink-0 ml-4">
                        <div class="text-right">
                            <p class="font-label-sm text-label-sm text-on-surface-variant">${stories.length} stories</p>
                        </div>
                        <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors rotate-0 sprint-chevron">expand_more</span>
                    </div>
                </button>
                <div class="sprint-body px-6 pb-6 space-y-4 hidden">
                    ${storiesHtml || '<p class="text-on-surface-variant font-body-md">No stories in this sprint.</p>'}
                </div>
            `;

                    sprintsContainer.appendChild(sprintEl);
                });

                document.getElementById('backlog-results').classList.remove('hidden');
                document.getElementById('breakdown-results').classList.add('hidden');
                document.getElementById('results-area').classList.remove('hidden');
            }

            function toggleSprint(btn) {
                const body = btn.nextElementSibling;
                const chevron = btn.querySelector('.sprint-chevron');
                const isOpen = body.classList.contains('hidden');
                body.classList.toggle('hidden', !isOpen);
                chevron.style.transform = isOpen ? 'rotate(180deg)' : 'rotate(0deg)';
            }

            // ── Save Backlog ───────────────────────────────────────────────────────────
            async function saveBacklog() {
                if (!currentBacklogData?.sprints?.length) {
                    showError('No backlog data available to save.');
                    return;
                }

                const projectTitle = document.getElementById('backlog-project-title').value.trim();
                if (!projectTitle) {
                    showError('Please enter a project title before saving.');
                    return;
                }

                const btn = document.getElementById('save-backlog-btn');
                btn.disabled = true;
                btn.innerHTML = `<span class="material-symbols-outlined animate-spin">progress_activity</span> Saving...`;

                try {
                    const payload = {
                        project_title: projectTitle,
                        project_summary: document.getElementById('backlog-project-summary').value.trim() || currentIdea,
                        sprints: currentBacklogData.sprints,
                    };

                    const res = await fetch('{{ route('ai.import-backlog') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': CSRF,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify(payload),
                    });

                    const data = await res.json();

                    if (res.ok) {
                        showBacklogSuccessToast(data.message || 'Backlog saved successfully!', data.redirect);
                        btn.innerHTML = `<span class="material-symbols-outlined">check</span> Saved!`;
                        setTimeout(() => clearResults(), 2000);
                    } else {
                        const errors = data.errors ? Object.values(data.errors).flat().join(' ') : null;
                        showError(errors || data.message || 'Failed to save backlog.');
                        btn.disabled = false;
                        btn.innerHTML = `<span class="material-symbols-outlined">save</span> Save Backlog to System`;
                    }
                } catch (err) {
                    console.error('Save backlog error:', err);
                    showError('Network error: ' + err.message);
                    btn.disabled = false;
                    btn.innerHTML = `<span class="material-symbols-outlined">save</span> Save Backlog to System`;
                }
            }

            // ── Helpers ────────────────────────────────────────────────────────────────
            function setLoading(on) {
                const btn = document.getElementById('generate-btn');
                const icon = document.getElementById('btn-icon');
                const text = document.getElementById('btn-text');
                const skel = document.getElementById('skeleton-area');
                const res = document.getElementById('results-area');

                btn.disabled = on;
                if (on) {
                    icon.classList.add('animate-spin');
                    icon.textContent = 'progress_activity';
                    text.textContent = 'Generating…';
                    skel.classList.remove('hidden');
                    res.classList.add('hidden');
                } else {
                    icon.classList.remove('animate-spin');
                    icon.textContent = 'auto_awesome';
                    text.textContent = 'Generate with AI';
                    skel.classList.add('hidden');
                }
            }

            function clearResults() {
                document.getElementById('results-area').classList.add('hidden');
                document.getElementById('breakdown-results').classList.add('hidden');
                document.getElementById('backlog-results').classList.add('hidden');
                document.getElementById('save-bar').classList.add('hidden');
                document.getElementById('task-cards').innerHTML = '';
                document.getElementById('sprints-container').innerHTML = '';
                selectedTasks.clear();
                allGeneratedTasks = [];
                currentBacklogData = null;
                currentIdea = '';
                hideError();
            }

            function showError(msg) {
                const banner = document.getElementById('error-banner');
                document.getElementById('error-msg').textContent = msg;
                banner.classList.remove('hidden');
            }

            function hideError() {
                document.getElementById('error-banner').classList.add('hidden');
            }

            function showSuccessToast(msg) {
                const toast = document.createElement('div');
                toast.className =
                    'fixed bottom-6 right-6 bg-primary text-on-primary px-6 py-4 rounded-2xl font-label-md shadow-xl flex items-center gap-3 z-50 animate-bounce';
                toast.innerHTML =
                    `<span class="material-symbols-outlined">check_circle</span> ${escHtml(msg)} — <a href="{{ route('tasks.index') }}" class="underline font-bold">View Tasks →</a>`;
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 5000);
            }

            function showBacklogSuccessToast(msg, redirectUrl) {
                const toast = document.createElement('div');
                toast.className =
                    'fixed bottom-6 right-6 bg-primary text-on-primary px-6 py-4 rounded-2xl font-label-md shadow-xl flex items-center gap-3 z-50 animate-bounce';
                const link = redirectUrl || '{{ route('projects.index') }}';
                toast.innerHTML =
                    `<span class="material-symbols-outlined">check_circle</span> ${escHtml(msg)} — <a href="${escHtml(link)}" class="underline font-bold">View Sprints →</a>`;
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 5000);
            }

            function escHtml(str) {
                const d = document.createElement('div');
                d.textContent = str ?? '';
                return d.innerHTML;
            }

            // Open all sprints by default (they start hidden via classList)
            // They render open so no action needed.
        </script>
    @endpush

</x-layouts.front>
