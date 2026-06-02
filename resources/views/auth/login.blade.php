<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>SmartTask | Creative Login</title>
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
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fbf8ff;
            /* Fallback for surface */
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        /* Custom "Notebook Line" effect from Style Guidance */
        .input-line-effect {
            background-color: rgba(0, 0, 110, 0.04);
            border: none;
            border-bottom: 2px solid #00006e;
            transition: all 0.3s ease;
        }

        .input-line-effect:focus {
            outline: none;
            border-bottom-color: #006565;
            background-color: rgba(0, 101, 101, 0.06);
        }

        /* Geometric Pattern Background */
        .geo-pattern {
            background-image: radial-gradient(#00006e 0.5px, transparent 0.5px);
            background-size: 24px 24px;
            opacity: 0.03;
        }

        /* Asymmetric accents */
        .accent-stripe {
            width: 4px;
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
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
                },
            },
        }
    </script>
</head>

<body
    class="bg-surface text-on-surface selection:bg-primary-container selection:text-on-primary-container min-h-screen flex flex-col md:flex-row overflow-hidden">
    <!-- Left Hero Panel (Visual Anchor) -->
    <section
        class="hidden md:flex relative w-2/5 lg:w-2/5 min-h-screen bg-on-background items-center justify-center p-margin-desktop overflow-hidden">
        <!-- Artistic Geometric Elements -->
        <div class="absolute inset-0 geo-pattern"></div>
        <div
            class="absolute top-[-10%] right-[-10%] w-[500px] h-[500px] bg-primary opacity-20 blur-[100px] rounded-full">
        </div>
        <div
            class="absolute bottom-[-5%] left-[10%] w-[300px] h-[300px] bg-secondary opacity-30 blur-[80px] rounded-full">
        </div>
        <div class="relative z-10 max-w-lg">
            <h1 class="font-display text-display text-surface mb-6">
                Organize <br /> <span class="text-primary-fixed">Creative</span> Chaos.
            </h1>
            <p class="font-body-lg text-body-lg text-surface-variant max-w-md mb-gutter opacity-80">
                The artistic workspace designed for systematic precision. Fuel your inspiration with SmartTask's
                intuitive creative engine.
            </p>
            <!-- Asymmetric Hero Image -->
            <div class="relative mt-8 overflow-hidden rounded-[32px] transform rotate-2 hover:rotate-0 transition-transform duration-700">
                <div class="absolute -inset-4 bg-tertiary-container/20 rounded-[32px] blur-xl"></div>
                <img alt="Artistic abstract composition"
                    class="w-full h-[320px] lg:h-[420px] object-cover rounded-[32px] shadow-2xl border border-surface/10"
                    data-alt="A sophisticated digital abstract composition featuring smooth, flowing geometric shapes and vibrant gradients of teal and coral against a deep navy background. The lighting is dramatic and directional, creating a sense of depth and tactile quality. This high-end artistic piece embodies the creative productivity brand identity with its balance of sharp precision and organic fluidity in a professional light-mode context."
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDKUwYtcDLoSHn7IbXmkNBogBY4cicxXPAa7p9EnWutnrgjXl_hwVOIHwYxEtv_9y8LbSJda5HZM0IZfsJoOVkgj6oVf7pVkHtFw5LvD3H5-2a6Iu1uFFwMSPeY94vWYMklDJYMyvdDnqM6Cc7Mnvih7XhwH3QZ6TFdkYbiLuNwRxv5hJqGTMtc9FNmuVATFrINVnHNchLgRtd2HAwasHEmzkA-Pr2QM6qzgxw7aZ7CR9EqLAQj6EtW1vnmmT-jhkhYuHlmC3JBtaBC" />
            </div>
        </div>
    </section>
    <!-- Right Interaction Panel (Login Form) -->
    <main
        class="w-full md:w-3/5 lg:w-3/5 min-h-screen bg-surface flex flex-col items-center justify-center p-margin-mobile md:p-margin-desktop relative">
        <div class="w-full max-w-sm">
            <div class="mb-8">
                <span
                    class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-primary-container text-primary font-bold text-label-md shadow-sm shadow-primary/10">
                    <span class="material-symbols-outlined">task_alt</span>
                    SmartTask
                </span>
            </div>
            <header class="mb-gutter">
                <h2 class="font-headline-lg text-headline-lg text-on-surface mb-2">Welcome Back</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">Ready to continue your creative journey?
                </p>
            </header>
           @if ($errors->any())
                <div class="mb-4 p-4 rounded-xl bg-error-container text-on-error-container border border-error/20 text-label-md">
                    <div class="flex items-center gap-2 mb-2 font-bold">
                        <span class="material-symbols-outlined text-[20px]">error</span>
                        <span>حدث خطأ أثناء تسجيل الدخول:</span>
                    </div>
                    <ul class="list-disc list-inside space-y-1 opacity-90 font-body-md">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}" class="space-y-6" id="login-form">
                <!-- User Identifier Field -->
                @csrf

                <div class="space-y-2 group">
                    <label class="font-label-md text-label-md text-on-surface-variant block" for="identifier">User
                        email</label>
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-0 top-1/2 -translate-y-1/2 text-primary opacity-60">person</span>
                        <input class="w-full pl-8 pr-4 py-3 input-line-effect font-body-md text-on-surface" value="{{old(config('fortify.username'))}}"
                            id="identifier" name="{{ config('fortify.username') }}" placeholder="creative_soul@smarttask.com" required=""
                            type="text" />
                    </div>
                </div>
                <!-- Access Key Field -->
                <div class="space-y-2 group">
                    <div class="flex justify-between items-center">
                        <label class="font-label-md text-label-md text-on-surface-variant" for="access_key">Access
                            Key</label>
                        <a class="font-label-sm text-label-sm text-primary hover:underline" href="#">Forgot?</a>
                    </div>
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-0 top-1/2 -translate-y-1/2 text-primary opacity-60">key</span>
                        <input class="w-full pl-8 pr-4 py-3 input-line-effect font-body-md text-on-surface"
                            id="access_key" name="password" placeholder="••••••••" required="" type="password" />
                    </div>
                </div>
                <!-- Keep Me Inspired (Checkbox) -->
                <div class="flex items-center gap-3">
                    <div class="relative flex items-center">
                        <input name="remember"
                            class="w-5 h-5 rounded border-2 border-outline/30 text-primary focus:ring-primary/20 transition-all cursor-pointer appearance-none checked:bg-primary checked:border-primary relative"
                            id="keep_inspired" type="checkbox" />
                        <span
                            class="material-symbols-outlined absolute text-[14px] text-on-primary pointer-events-none opacity-0 transition-opacity">check</span>
                    </div>
                    <label class="font-label-md text-label-md text-on-surface-variant cursor-pointer select-none"
                        for="keep_inspired">Keep me inspired</label>
                </div>
                <!-- Action Button -->
                <button
                    class="w-full py-4 bg-primary text-on-primary font-headline-md text-headline-md rounded-xl shadow-lg shadow-primary/20 hover:bg-primary-container active:scale-[0.98] transition-all duration-200"
                    type="submit">
                    Sign In
                </button>
            </form>
            <!-- Social Logins -->
            <div class="mt-gutter">
                <div class="relative flex items-center justify-center mb-gutter">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-outline/10"></div>
                    </div>
                    <span
                        class="relative bg-surface px-4 font-label-sm text-label-sm text-outline uppercase tracking-widest">Or
                        connect with</span>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <button
                        class="flex items-center justify-center gap-3 py-3 px-4 border-2 border-outline/10 rounded-xl hover:bg-surface-variant/30 active:scale-[0.98] transition-all duration-200 group">
                        <img alt="Google" class="w-5 h-5 grayscale group-hover:grayscale-0 transition-all"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuD4vyMbS5XvFr1484gwDIJ3uEAhsXUp8Wa9ER0Z3eFwhhlGolQzmFkDP5NPD7cTS-GQmaYqfkgilBXJQZmrMCi9hygkO0y5RD8-WIk2UdkNXkcBJ7Vu3GeK57Upg37P01_ecCsuwLKB9BDfhAJwXKJqtxoGpkJrArUI4GA0cZFf-2WoL61nP3Zsn7TOAplx5TobWrvCZ1NNI1cEKUHoaJrR7NtwN2r3xjKyLEixEIazDNoIF1cTy9SIAlQJmJkjZVZ5j0holovxPH43" />
                        <span class="font-label-md text-label-md text-on-surface">Google</span>
                    </button>
                    <button
                        class="flex items-center justify-center gap-3 py-3 px-4 border-2 border-outline/10 rounded-xl hover:bg-surface-variant/30 active:scale-[0.98] transition-all duration-200 group">
                        <span class="material-symbols-outlined text-[20px] text-on-surface">ios</span>
                        <span class="font-label-md text-label-md text-on-surface">Apple</span>
                    </button>
                </div>
            </div>
            <footer class="mt-margin-desktop text-center">
                <p class="font-body-md text-body-md text-on-surface-variant">
                    New to the workspace? <a class="text-secondary font-bold hover:underline" href="{{ route('register') }}">Start
                        Creating</a>
                </p>
            </footer>
        </div>
    </main>
    <script>
        // Custom interaction for the checkbox "spring" animation mentioned in Style Guidance
        const checkbox = document.getElementById('keep_inspired');
        const checkIcon = checkbox.nextElementSibling;

        checkbox.addEventListener('change', function() {
            if (this.checked) {
                checkIcon.style.opacity = '1';
                this.classList.add('scale-110');
                setTimeout(() => this.classList.remove('scale-110'), 200);
            } else {
                checkIcon.style.opacity = '0';
            }
        });

  // Form Submission Micro-interaction
document.getElementById('login-form').addEventListener('submit', function(e) {
    // حذفنا e.preventDefault() عشان الفورم يبعت البيانات للـ Backend فعلياً
    const btn = this.querySelector('button');
    btn.innerHTML = '<span class="material-symbols-outlined animate-spin">progress_activity</span>';
    btn.disabled = true;
});
    </script>
</body>

</html>
