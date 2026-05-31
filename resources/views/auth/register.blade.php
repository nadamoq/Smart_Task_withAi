<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>SmartTask - Join the Creative Movement</title>
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

        .creative-bg-pattern {
            background-image: radial-gradient(circle at 2px 2px, rgba(0, 0, 110, 0.03) 1px, transparent 0);
            background-size: 24px 24px;
        }

        .artistic-accent {
            box-shadow: -4px 0 0 0 #fe7e4f;
            /* Coral Accent from secondary-container */
        }
    </style>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-error-container": "#93000a",
                        "surface-dim": "#d6d7ff",
                        "outline": "#6e7979",
                        "on-tertiary-container": "#fdf8ff",
                        "surface-container": "#eeecff",
                        "on-error": "#ffffff",
                        "on-primary-fixed": "#002020",
                        "surface-container-lowest": "#ffffff",
                        "surface-bright": "#fbf8ff",
                        "primary": "#006565",
                        "surface-variant": "#e0e0ff",
                        "outline-variant": "#bdc9c8",
                        "tertiary": "#5948ba",
                        "on-primary-container": "#e3fffe",
                        "secondary-fixed-dim": "#ffb59c",
                        "on-secondary-fixed": "#380c00",
                        "primary-container": "#008080",
                        "primary-fixed": "#93f2f2",
                        "tertiary-fixed": "#e5deff",
                        "secondary-fixed": "#ffdbcf",
                        "inverse-surface": "#181d8c",
                        "tertiary-container": "#7262d5",
                        "on-surface": "#00006e",
                        "secondary-container": "#fe7e4f",
                        "tertiary-fixed-dim": "#c8bfff",
                        "surface": "#fbf8ff",
                        "surface-container-low": "#f5f2ff",
                        "surface-container-high": "#e7e6ff",
                        "secondary": "#a43c12",
                        "error-container": "#ffdad6",
                        "on-surface-variant": "#3e4949",
                        "on-primary-fixed-variant": "#004f4f",
                        "on-secondary-fixed-variant": "#822800",
                        "on-secondary": "#ffffff",
                        "on-tertiary-fixed-variant": "#4532a6",
                        "on-tertiary-fixed": "#190064",
                        "on-primary": "#ffffff",
                        "on-background": "#00006e",
                        "surface-container-highest": "#e0e0ff",
                        "background": "#fbf8ff",
                        "primary-fixed-dim": "#76d6d5",
                        "inverse-on-surface": "#f1efff",
                        "error": "#ba1a1a",
                        "surface-tint": "#006a6a",
                        "on-tertiary": "#ffffff",
                        "on-secondary-container": "#6b1f00",
                        "inverse-primary": "#76d6d5"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "unit": "8px",
                        "container-max": "1440px",
                        "gutter": "24px",
                        "margin-mobile": "16px",
                        "margin-desktop": "48px"
                    },
                    "fontFamily": {
                        "label-md": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"],
                        "headline-lg": ["Sora"],
                        "headline-md": ["Sora"],
                        "label-sm": ["Plus Jakarta Sans"],
                        "headline-lg-mobile": ["Sora"],
                        "display": ["Sora"],
                        "body-lg": ["Plus Jakarta Sans"]
                    },
                    "fontSize": {
                        "label-md": ["14px", {
                            "lineHeight": "1.4",
                            "letterSpacing": "0.02em",
                            "fontWeight": "600"
                        }],
                        "body-md": ["16px", {
                            "lineHeight": "1.6",
                            "fontWeight": "400"
                        }],
                        "headline-lg": ["32px", {
                            "lineHeight": "1.2",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "700"
                        }],
                        "headline-md": ["24px", {
                            "lineHeight": "1.3",
                            "fontWeight": "600"
                        }],
                        "label-sm": ["12px", {
                            "lineHeight": "1.4",
                            "fontWeight": "700"
                        }],
                        "headline-lg-mobile": ["28px", {
                            "lineHeight": "1.2",
                            "fontWeight": "700"
                        }],
                        "display": ["48px", {
                            "lineHeight": "1.1",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "800"
                        }],
                        "body-lg": ["18px", {
                            "lineHeight": "1.6",
                            "fontWeight": "400"
                        }]
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-background text-on-background font-body-md creative-bg-pattern min-h-screen">
    <main class="flex flex-col md:flex-row min-h-screen w-full">
        <!-- LEFT SIDE: High-Impact Visual -->
        <section
            class="relative w-full md:w-1/2 min-h-[409px] md:min-h-screen bg-on-background overflow-hidden flex flex-col justify-end p-margin-mobile md:p-margin-desktop">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0 z-0">
                <img alt="Artistic Precision Workspace"
                    class="w-full h-full object-cover opacity-60 mix-blend-luminosity"
                    data-alt="A sophisticated and high-contrast creative studio environment featuring minimalist black furniture and vibrant abstract paintings on the walls. The scene is bathed in a dramatic directional light that emphasizes sleek textures and sharp geometric shapes. A deep navy and teal color palette dominates the atmosphere, punctuated by energetic pops of coral red. The mood is professional, empowering, and intensely focused on artistic production."
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDAX4uWnlwC89IgYwREvI-yWofRuD2mSCjZwKE5ZER50J03kqwoqjWE0bC3fjmB8gMQ8DqLvtGBNALiulcpmpiLNQE20Wgt_K3tlqYZRl4_3iVO9lTQLl2UDg2X9AAFsEZ10rUWCmqGTgj7Ix2sIeFCbfszTwKgmlI8hI54-JB2gPAUqsEyRMHuGSlOUeoiOsj-s9kuCrMeQtaoohzJCqemnNk9mxmJgw77KaY1k8L0N4MITKD4MykRvuFbDwfgIPchPXJmZwTsqTu_" />
                <div class="absolute inset-0 bg-gradient-to-t from-on-background via-on-background/40 to-transparent">
                </div>
            </div>
            <!-- Text Content -->
            <div class="relative z-10 max-w-lg mb-12">
                <div class="mb-6">
                    <span
                        class="inline-block px-4 py-1 rounded-full bg-secondary-container text-on-secondary-fixed font-label-sm uppercase tracking-wider mb-4">
                        Platform v2.0
                    </span>
                    <h1 class="font-display text-headline-lg-mobile md:text-display text-surface leading-tight">
                        Join the <br /><span class="text-primary-fixed">Creative</span> Movement
                    </h1>
                </div>
                <p class="font-body-lg text-surface-variant max-w-md">
                    Fuel your inspiration with a workspace designed for the systematic artist. Precision meets play in
                    the ultimate productivity engine.
                </p>
            </div>
            <!-- Brand Logo Anchor -->
            <div class="absolute top-margin-desktop left-margin-desktop z-10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-primary flex items-center justify-center rounded-lg shadow-lg">
                        <span class="material-symbols-outlined text-white"
                            style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
                    </div>
                    <span
                        class="font-display text-headline-md font-extrabold text-surface tracking-tighter">SmartTask</span>
                </div>
            </div>
        </section>
        <!-- RIGHT SIDE: Registration Form -->
        <section
            class="w-full md:w-1/2 bg-surface flex flex-col justify-center items-center py-16 px-margin-mobile md:px-margin-desktop">
            <div class="w-full max-w-md">
                <!-- Header -->
                <header class="mb-10">
                    <h2 class="font-display text-headline-lg text-on-surface mb-2">Initialize Workspace</h2>
                    <p class="font-body-md text-on-surface-variant">Setup your profile to begin your creative journey.
                    </p>
                </header>
                <!-- Registration Form -->
                 @if ($errors->any())
                <div class="mb-4 p-4 rounded-xl bg-error-container text-on-error-container border border-error/20 text-label-md">
                    <div class="flex items-center gap-2 mb-2 font-bold">
                        <span class="material-symbols-outlined text-[20px]">error</span>
                        <span>error occured during registration</span>
                    </div>
                    <ul class="list-disc list-inside space-y-1 opacity-90 font-body-md">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <form method="POST" action="{{route('register.store')}}" class="space-y-6" id="registrationForm">
                    <!-- Full Name -->
                    @csrf

                    <div class="group">
                        <label class="block font-label-md text-on-surface mb-2" for="name">Full Name</label>
                        <div class="relative">
                            <input
                                class="w-full bg-on-background/[0.04] border-0 border-b-2 border-on-background/20 py-4 px-0 focus:ring-0 focus:border-primary transition-all text-on-surface placeholder:text-on-surface-variant/40 font-body-md"
                                name="name"
                                id="name" placeholder="Leonardo Da Vinci" type="text" />
                            <span
                                class="material-symbols-outlined absolute right-0 top-1/2 -translate-y-1/2 text-on-surface-variant/50 group-focus-within:text-primary transition-colors">person</span>
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="group">
                        <label class="block font-label-md text-on-surface mb-2" for="email">Creative Email</label>
                        <div class="relative">
                            <input name="{{ config('fortify.email') }}"
                                class="w-full bg-on-background/[0.04] border-0 border-b-2 border-on-background/20 py-4 px-0 focus:ring-0 focus:border-primary transition-all text-on-surface placeholder:text-on-surface-variant/40 font-body-md"
                                id="email" placeholder="leo@studio.art" type="email" />
                            <span
                                class="material-symbols-outlined absolute right-0 top-1/2 -translate-y-1/2 text-on-surface-variant/50 group-focus-within:text-primary transition-colors">mail</span>
                        </div>
                    </div>
                    <!-- Password (Access Key) -->
                    <div class="group">
                        <label class="block font-label-md text-on-surface mb-2" for="password">Password</label>
                        <div class="relative">
                            <input
                                class="w-full bg-on-background/[0.04] border-0 border-b-2 border-on-background/20 py-4 px-0 focus:ring-0 focus:border-primary transition-all text-on-surface placeholder:text-on-surface-variant/40 font-body-md"
                               name="password" id="password" placeholder="••••••••••••" type="password" />
                            <button
                                class="absolute right-0 top-1/2 -translate-y-1/2 text-on-surface-variant/50 hover:text-primary transition-colors"
                                type="button">
                                <span class="material-symbols-outlined">visibility_off</span>
                            </button>
                        </div>
                    </div>
                     <div class="group">
                        <label class="block font-label-md text-on-surface mb-2" for="password_confirmation">Confirm Password</label>
                        <div class="relative">
                            <input
                                class="w-full bg-on-background/[0.04] border-0 border-b-2 border-on-background/20 py-4 px-0 focus:ring-0 focus:border-primary transition-all text-on-surface placeholder:text-on-surface-variant/40 font-body-md"
                               name="password_confirmation" id="password_confirmation" placeholder="••••••••••••" type="password" />
                            <button
                                class="absolute right-0 top-1/2 -translate-y-1/2 text-on-surface-variant/50 hover:text-primary transition-colors"
                                type="button">
                                <span class="material-symbols-outlined">visibility_off</span>
                            </button>
                        </div>
                    </div>
                    <!-- CTA Button -->
                    <button
                        class="w-full bg-primary hover:bg-primary-container text-white font-display text-label-md py-5 rounded-lg shadow-lg transform active:scale-95 transition-all duration-300 flex items-center justify-center gap-2 group"
                        type="submit">
                        Create Account
                        <span
                            class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                </form>
                <!-- Divider -->
                <div class="relative my-10 flex items-center">
                    <div class="flex-grow border-t border-outline-variant"></div>
                    <span class="flex-shrink mx-4 font-label-sm text-on-surface-variant/60 uppercase tracking-widest">Or
                        Secure Link Via</span>
                    <div class="flex-grow border-t border-outline-variant"></div>
                </div>
                <!-- Social Options -->
                <div class="grid grid-cols-2 gap-4">
                    <button
                        class="flex items-center justify-center gap-3 py-3 border-2 border-on-background/10 rounded-lg hover:bg-on-background/[0.02] transition-colors font-label-md text-on-surface">
                        <svg class="w-5 h-5" viewbox="0 0 24 24">
                            <path
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                fill="currentColor"></path>
                            <path
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                fill="currentColor"></path>
                            <path
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"
                                fill="currentColor"></path>
                            <path
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 1.16-4.53z"
                                fill="currentColor"></path>
                        </svg>
                        Google
                    </button>
                    <button
                        class="flex items-center justify-center gap-3 py-3 border-2 border-on-background/10 rounded-lg hover:bg-on-background/[0.02] transition-colors font-label-md text-on-surface">
                        <svg class="w-5 h-5" viewbox="0 0 24 24">
                            <path
                                d="M17.05 20.28c-.98.95-2.05 1.78-3.4 1.78-1.3 0-1.74-.79-3.26-.79-1.52 0-2.02.77-3.26.77-1.32 0-2.37-.81-3.38-1.76C1.7 18.24 0 15.27 0 12.28c0-3.11 1.94-4.8 3.84-4.8 1.18 0 2.12.65 2.92.65.75 0 1.93-.78 3.35-.78 1.1 0 2.45.48 3.4 1.55-2.73 1.48-2.28 5.23.47 6.48-.68 1.72-1.55 3.43-2.93 5.17zM12.03 5.3c-.02-2.12 1.75-3.94 3.79-4.3 0.2 2.45-2.03 4.45-3.79 4.3z"
                                fill="currentColor"></path>
                        </svg>
                        Apple
                    </button>
                </div>
                <!-- Footer Link -->
                <footer class="mt-12 text-center">
                    <p class="font-body-md text-on-surface-variant">
                        Already have an account?
                        <a class="text-primary font-label-md hover:underline decoration-2 underline-offset-4 ml-1"
                            href="{{ route('login') }}">Sign In</a>
                    </p>
                </footer>
            </div>
        </section>
    </main>
    <!-- Micro-interactions Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('registrationForm');
            const inputs = form.querySelectorAll('input');

            inputs.forEach(input => {
                input.addEventListener('focus', () => {
                    input.parentElement.parentElement.classList.add('artistic-accent');
                });
                input.addEventListener('blur', () => {
                    input.parentElement.parentElement.classList.remove('artistic-accent');
                });
            });

            // Password toggle interaction
            const togglePass = document.querySelector('button span.material-symbols-outlined');
            let isVisible = false;
            togglePass.parentElement.addEventListener('click', () => {
                isVisible = !isVisible;
                const input = togglePass.parentElement.previousElementSibling;
                input.type = isVisible ? 'text' : 'password';
                togglePass.innerText = isVisible ? 'visibility' : 'visibility_off';
            });

           
        });
    </script>
</body>

</html>
