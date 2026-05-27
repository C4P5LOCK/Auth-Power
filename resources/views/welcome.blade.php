<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'AuthUI') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-slate-950 text-white antialiased">

    <div class="min-h-screen overflow-hidden relative">

        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[800px] bg-indigo-600/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-pink-500/20 rounded-full blur-3xl"></div>

        <header class="relative z-10 max-w-7xl mx-auto px-6 py-6 flex items-center justify-between">
            <a href="/" class="text-2xl font-black tracking-tight">
                Auth<span class="text-indigo-400">UI</span>
            </a>

            <nav class="flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="rounded-full bg-white text-slate-900 px-5 py-2.5 text-sm font-bold hover:bg-slate-200 transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-white/80 hover:text-white">
                        Login
                    </a>

                    <a href="{{ route('register') }}" class="rounded-full bg-indigo-500 px-5 py-2.5 text-sm font-bold hover:bg-indigo-600 transition shadow-lg shadow-indigo-500/30">
                        Get Started
                    </a>
                @endauth
            </nav>
        </header>

        <main class="relative z-10">
            <section class="max-w-7xl mx-auto px-6 pt-20 pb-24 grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm text-white/80 mb-6">
                        <span class="h-2 w-2 rounded-full bg-green-400"></span>
                        Secure login with email and Google
                    </div>

                    <h1 class="text-5xl md:text-7xl font-black leading-tight tracking-tight">
                        Authentication that feels
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-pink-400">
                            beautiful.
                        </span>
                    </h1>

                    <p class="mt-6 text-lg text-white/70 max-w-xl leading-8">
                        A modern Laravel authentication system with custom login, secure signup, Google social login, and a clean user experience.
                    </p>

                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="rounded-2xl bg-white text-slate-900 px-7 py-4 text-sm font-black text-center hover:bg-slate-200 transition">
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="rounded-2xl bg-indigo-500 px-7 py-4 text-sm font-black text-center hover:bg-indigo-600 transition shadow-xl shadow-indigo-500/30">
                                Create Free Account
                            </a>

                            <a href="{{ route('google.redirect') }}" class="rounded-2xl bg-white/10 border border-white/10 px-7 py-4 text-sm font-black text-center hover:bg-white/15 transition">
                                Continue with Google
                            </a>
                        @endauth
                    </div>
                </div>

                <div class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-r from-indigo-500 to-pink-500 rounded-[2rem] blur-2xl opacity-30"></div>

                    <div class="relative bg-white/10 backdrop-blur-xl border border-white/10 rounded-[2rem] p-6 shadow-2xl">
                        <div class="bg-white text-slate-900 rounded-3xl p-6">
                            <div class="flex items-center justify-between mb-8">
                                <div>
                                    <p class="text-sm text-slate-500">Welcome back</p>
                                    <h3 class="text-2xl font-black">Sign in</h3>
                                </div>
                                <div class="h-12 w-12 rounded-2xl bg-indigo-100 flex items-center justify-center text-indigo-600 font-black">
                                    A
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="h-12 rounded-xl bg-slate-100"></div>
                                <div class="h-12 rounded-xl bg-slate-100"></div>
                                <div class="h-12 rounded-xl bg-indigo-600"></div>
                                <div class="flex items-center gap-3">
                                    <div class="h-px bg-slate-200 flex-1"></div>
                                    <span class="text-xs text-slate-400">or</span>
                                    <div class="h-px bg-slate-200 flex-1"></div>
                                </div>
                                <div class="h-12 rounded-xl border border-slate-200"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="max-w-7xl mx-auto px-6 pb-24 grid md:grid-cols-3 gap-6">
                <div class="rounded-3xl bg-white/5 border border-white/10 p-8">
                    <h3 class="text-xl font-black">Email Auth</h3>
                    <p class="mt-3 text-white/60 leading-7">
                        Register and login securely with email and password using Laravel’s authentication system.
                    </p>
                </div>

                <div class="rounded-3xl bg-white/5 border border-white/10 p-8">
                    <h3 class="text-xl font-black">Google Login</h3>
                    <p class="mt-3 text-white/60 leading-7">
                        Let users sign in quickly with their Google account using Laravel Socialite.
                    </p>
                </div>

                <div class="rounded-3xl bg-white/5 border border-white/10 p-8">
                    <h3 class="text-xl font-black">Modern UI</h3>
                    <p class="mt-3 text-white/60 leading-7">
                        Clean Tailwind design, responsive layout, smooth sections, and a polished SaaS feel.
                    </p>
                </div>
            </section>
        </main>

    </div>

</body>
</html>