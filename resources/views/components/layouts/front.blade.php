<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>SmartTask | {{ $title ?? '' }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&amp;family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .artistic-pattern {
            background-image: radial-gradient(#00006e 0.5px, transparent 0.5px);
            background-size: 24px 24px;
            opacity: 0.03;
        }

        .writing-line {
            border-bottom: 2px solid #3e4949;
            background-color: rgba(62, 73, 73, 0.04);
        }

        .spring-checkbox:checked {
            animation: spring 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        }

        @keyframes spring {
            0% {
                transform: scale(0.8);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "secondary-fixed": "#ffdbcf",
                        "tertiary-fixed-dim": "#c8bfff",
                        "on-tertiary-fixed-variant": "#4532a6",
                        "surface": "#fbf8ff",
                        "surface-bright": "#fbf8ff",
                        "outline": "#6e7979",
                        "surface-variant": "#e0e0ff",
                        "outline-variant": "#bdc9c8",
                        "surface-tint": "#006a6a",
                        "secondary": "#a43c12",
                        "primary-fixed-dim": "#76d6d5",
                        "on-tertiary-fixed": "#190064",
                        "on-primary-fixed": "#002020",
                        "surface-container-high": "#e7e6ff",
                        "surface-container": "#eeecff",
                        "surface-container-lowest": "#ffffff",
                        "primary": "#006565",
                        "inverse-surface": "#181d8c",
                        "primary-fixed": "#93f2f2",
                        "on-surface-variant": "#3e4949",
                        "on-primary": "#ffffff",
                        "surface-container-highest": "#e0e0ff",
                        "on-surface": "#00006e",
                        "on-error-container": "#93000a",
                        "error": "#ba1a1a",
                        "secondary-container": "#fe7e4f",
                        "inverse-primary": "#76d6d5",
                        "on-secondary": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-tertiary": "#ffffff",
                        "on-secondary-container": "#6b1f00",
                        "tertiary-container": "#7262d5",
                        "on-secondary-fixed": "#380c00",
                        "primary-container": "#008080",
                        "on-tertiary-container": "#fdf8ff",
                        "surface-dim": "#d6d7ff",
                        "surface-container-low": "#f5f2ff",
                        "on-primary-container": "#e3fffe",
                        "on-error": "#ffffff",
                        "tertiary-fixed": "#e5deff",
                        "on-secondary-fixed-variant": "#822800",
                        "tertiary": "#5948ba",
                        "secondary-fixed-dim": "#ffb59c",
                        "background": "#fbf8ff",
                        "on-primary-fixed-variant": "#004f4f",
                        "inverse-on-surface": "#f1efff",
                        "on-background": "#00006e"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "gutter": "24px",
                        "margin-mobile": "16px",
                        "unit": "8px",
                        "margin-desktop": "48px",
                        "container-max": "1440px"
                    },
                    "fontFamily": {
                        "headline-md": ["Sora"],
                        "body-lg": ["Plus Jakarta Sans"],
                        "headline-lg": ["Sora"],
                        "label-sm": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"],
                        "headline-lg-mobile": ["Sora"],
                        "body-md": ["Plus Jakarta Sans"],
                        "display": ["Sora"]
                    },
                    "fontSize": {
                        "headline-md": ["24px", {
                            "lineHeight": "1.3",
                            "fontWeight": "600"
                        }],
                        "body-lg": ["18px", {
                            "lineHeight": "1.6",
                            "fontWeight": "400"
                        }],
                        "headline-lg": ["32px", {
                            "lineHeight": "1.2",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "700"
                        }],
                        "label-sm": ["12px", {
                            "lineHeight": "1.4",
                            "fontWeight": "700"
                        }],
                        "label-md": ["14px", {
                            "lineHeight": "1.4",
                            "letterSpacing": "0.02em",
                            "fontWeight": "600"
                        }],
                        "headline-lg-mobile": ["28px", {
                            "lineHeight": "1.2",
                            "fontWeight": "700"
                        }],
                        "body-md": ["16px", {
                            "lineHeight": "1.6",
                            "fontWeight": "400"
                        }],
                        "display": ["48px", {
                            "lineHeight": "1.1",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "800"
                        }]
                    }
                }
            }
        }
    </script>
    @stack('style')
</head>

<body class="bg-surface text-on-surface font-body-md overflow-x-hidden">
    <div class="fixed inset-0 artistic-pattern pointer-events-none"></div>
    <div class="flex min-h-screen relative">
        <!-- SideNavBar -->
        <aside
            class="hidden md:flex flex-col h-screen sticky left-0 top-0 w-[280px] bg-surface-container-low border-r border-outline/8 py-gutter px-4 gap-4 z-50">
            <div class="flex flex-col gap-2 mb-8 px-4">
                <h1 class="font-display text-headline-md font-extrabold text-primary">SmartTask</h1>
                <p class="font-label-md text-label-md text-on-surface-variant">Creative Workspace</p>
            </div>
            <nav class="flex flex-col gap-2">
                <a class="flex items-center gap-4 transition-all duration-300
    {{ request()->routeIs('tasks.*')
        ? 'bg-secondary-container text-on-secondary-container font-bold border-l-4 border-secondary rounded-xl px-4 py-3'
        : 'text-on-surface-variant hover:bg-surface-variant/30 rounded-xl px-4 py-3' }}"
                    href="{{ route('tasks.index') }}">
                    <span class="material-symbols-outlined">assignment_turned_in</span>
                    <span class="font-label-md text-label-md">Tasks</span>
                </a>

                <a class="flex items-center gap-4 transition-all duration-300
    {{ request()->routeIs('projects.*')
        ? 'bg-secondary-container text-on-secondary-container font-bold border-l-4 border-secondary rounded-xl px-4 py-3'
        : 'text-on-surface-variant hover:bg-surface-variant/30 rounded-xl px-4 py-3' }}"
                    href="{{ route('projects.index') }}">
                    <span class="material-symbols-outlined">folder_shared</span>
                    <span class="font-label-md text-label-md">Projects</span>
                </a>

                <a class="flex items-center gap-4 {{ request()->routeIs('ai.*') ? 'bg-primary-fixed text-on-primary-fixed-variant rounded-xl px-4 py-3 font-bold border-l-4 border-primary' : 'text-on-surface-variant px-4 py-3 rounded-xl hover:bg-surface-variant/30' }} transition-all duration-300"
                    href="{{ route('ai.index') }}">
                    <span class="material-symbols-outlined" data-icon="auto_awesome">auto_awesome</span>
                    <span class="font-label-md text-label-md">AI Studio</span>
                </a>
                <a class="flex items-center gap-4 text-on-surface-variant px-4 py-3 rounded-xl hover:bg-surface-variant/30 transition-all duration-300"
                    href="#">
                    <span class="material-symbols-outlined" data-icon="person">person</span>
                    <span class="font-label-md text-label-md">Profile</span>
                </a>

            </nav>
            <div class="mt-4">
                <h2 class="font-label-md text-label-md text-on-surface-variant mb-2">Recent Projects</h2>
                @if ($recentProjects)


                    <ul class="space-y-1">
                        @foreach ($recentProjects as $proj)
                            <li>
                                <a href="{{ route('projects.show', $proj) ?? '#' }}"
                                    class="flex items-center gap-2 text-on-surface-variant hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined" data-icon="folder">folder</span>
                                    <span class="font-label-sm">{{ $proj->title }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="mt-auto p-4">
                <a href="{{ route('tasks.create') }}"
                    class="w-full bg-primary text-on-primary py-4 rounded-xl font-headline-md text-label-md flex items-center justify-center gap-2 hover:opacity-90 active:scale-95 transition-all duration-300 shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined" data-icon="add">add</span>
                    New Task
                </a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
            <a class="flex items-center space-x-4 py-2 text-on-surface-variant pl-4 hover:text-primary transition-colors"
                href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="material-symbols-outlined" data-icon="logout">logout</span>
                <span class="font-label-md text-label-md">Sign Out</span>
            </a>
        </aside>
        <main class="flex-1 flex flex-col min-w-0">
            <!-- TopAppBar -->
            <header
                class="flex justify-between items-center w-full px-margin-desktop h-16 z-40 bg-surface border-b border-outline/10 sticky top-0">
                <div class="flex items-center gap-4 flex-1">
                    <div class="relative w-full max-w-md">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline-variant"
                            data-icon="search">search</span>
                        <input
                            class="w-full pl-10 pr-4 py-2 bg-surface-container-low border-none rounded-full font-label-md focus:ring-2 focus:ring-primary/20"
                            placeholder="Search tasks..." type="text" />
                    </div>
                </div>
                <div class="flex items-center gap-6">
                    <button class="relative text-on-surface-variant hover:text-primary transition-colors">
                        <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-secondary rounded-full"></span>
                    </button>

                    <div
                        class="h-10 w-10 rounded-full overflow-hidden border-2 border-primary/20 hover:border-primary transition-colors cursor-pointer">
                        <img alt="User Profile"
                            data-alt="A professional headshot of a creative director in a minimalist studio. The lighting is soft and natural, emphasizing a calm and focused expression. The overall aesthetic is clean and high-end, aligned with a modern design system's sophisticated and warm tones."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBMgHsLXI1dV9HTz2PSI7LkW2OxBTR4CvnhlBAIu5AyalDMOvP4R2aOyiQr2ItNXkWDBCYFIsslgfVAqJCGR8Box6BpiSpAf6-fSa99Wx0F1F6BZxiWUZBi1AZdNA1kvtx4sILTKj4g3Z1gL_zVtCaUOSodp2P0Ic-70eH7-jByfzj6_ART6SiLAiCAxz3z6gx4aTqawIxm-GzYjkZ6d-V--ioC-2ubixNKGqNSQq5ysaqmpPh9p9ReSW5KuSNDLqDRByJGpYwiz2wx" />
                    </div>
                    <div>
                        @auth
                            {{ Auth::user()->name }}
                        @endauth

                    </div>
                </div>
            </header>
            <!-- Content Area -->
            <div class="p-margin-desktop space-y-gutter overflow-y-auto">


                {{ $slot }}

            </div>
        </main>
    </div>
    <!-- Mobile Navigation (BottomNavBar) -->

    <script>
        // Simple micro-interaction for task items
        document.querySelectorAll('.group').forEach(item => {
            item.addEventListener('mouseenter', () => {
                item.style.transform = 'translateX(4px)';
            });
            item.addEventListener('mouseleave', () => {
                item.style.transform = 'translateX(0)';
            });
        });

        // Toggle Active State for Filters
        const filterButtons = document.querySelectorAll('section .flex button');
        filterButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                filterButtons.forEach(b => {
                    b.classList.remove('bg-primary', 'text-on-primary');
                    b.classList.add('bg-surface-container-highest', 'text-on-surface-variant');
                });
                btn.classList.remove('bg-surface-container-highest', 'text-on-surface-variant');
                btn.classList.add('bg-primary', 'text-on-primary');
            });
        });
    </script>
    @stack('script')
</body>

</html>
