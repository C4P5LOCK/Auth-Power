<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Auth UI') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen grid lg:grid-cols-2 bg-slate-950">

        <div class="hidden lg:flex flex-col justify-between p-12 text-white bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500">
            <div>
                <a href="/" class="text-2xl font-extrabold tracking-tight">
                    AuthUI
                </a>
            </div>

            <div>
                <h1 class="text-5xl font-extrabold leading-tight">
                    Secure access, beautiful experience.
                </h1>

                <p class="mt-5 text-lg text-white/80 max-w-md">
                    Sign up with email or continue instantly with your Google account.
                </p>
            </div>

            <p class="text-sm text-white/70">
                © {{ date('Y') }} AuthUI. All rights reserved.
            </p>
        </div>

        <div class="flex items-center justify-center px-6 py-10 bg-slate-100">
            <div class="w-full max-w-md">
                <div class="mb-8 text-center lg:hidden">
                    <a href="/" class="text-3xl font-extrabold text-indigo-600">
                        AuthUI
                    </a>
                </div>

                <div class="bg-white rounded-3xl shadow-xl p-8 border border-slate-200">
                    {{ $slot }}
                </div>
            </div>
        </div>

    </div>
</body>
</html>