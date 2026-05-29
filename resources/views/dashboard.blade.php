<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-6 py-10">

            <div class="mb-8">
                <h1 class="text-3xl font-black text-slate-900">
                    Welcome back, {{ Auth::user()->name }} 👋
                </h1>
                <p class="mt-2 text-slate-500">
                    Manage your account, security, and authentication settings.
                </p>
            </div>

            <div class="grid lg:grid-cols-3 gap-6">
                
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200 mb-6">
                    @if (session('success'))
                    <div class="mb-6 rounded-2xl bg-green-100 border border-green-200 text-green-700 px-5 py-4 font-semibold">
                        {{ session('success') }}
                    </div>
                @endif
                    <h2 class="text-xl font-black text-slate-900 mb-4">
                        Share an update
                    </h2>

                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf

                        <textarea
                            name="body"
                            rows="4"
                            maxlength="500"
                            class="w-full rounded-2xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="What's on your mind?"
                        ></textarea>

                        @error('body')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror

                        <div class="mt-4 flex justify-end">
                            <button
                                type="submit"
                                class="px-6 py-3 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition"
                            >
                                Post Update
                            </button>
                        </div>
                    </form>
                </div>
                <div class="lg:col-span-2 rounded-3xl bg-white p-8 shadow-sm border border-slate-200">
                    <h2 class="text-xl font-black text-slate-900">
                        Account Overview
                    </h2>

                    <div class="mt-6 grid sm:grid-cols-2 gap-4">
                        <div class="rounded-2xl bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Email Address</p>
                            <p class="mt-1 font-bold text-slate-900">
                                {{ Auth::user()->email }}
                            </p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Login Provider</p>
                            <p class="mt-1 font-bold text-slate-900">
                                {{ Auth::user()->provider ?? 'Email / Password' }}
                            </p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Account Created</p>
                            <p class="mt-1 font-bold text-slate-900">
                                {{ Auth::user()->created_at->format('M d, Y') }}
                            </p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Google Connected</p>
                            <p class="mt-1 font-bold text-slate-900">
                                {{ Auth::user()->google_id ? 'Yes' : 'No' }}
                            </p>
                        </div>
                    </div>

                    
                </div>


                
                <div class="rounded-3xl bg-slate-950 p-8 shadow-sm text-white">
                    <div class="flex items-center gap-4">
                        @if(Auth::user()->avatar)
                            <img
                                src="{{ Auth::user()->avatar }}"
                                alt="{{ Auth::user()->name }}"
                                class="h-16 w-16 rounded-2xl object-cover"
                            >
                        @else
                            <div class="h-16 w-16 rounded-2xl bg-indigo-500 flex items-center justify-center text-xl font-black">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif

                        <div>
                            <h3 class="font-black text-lg">
                                {{ Auth::user()->name }}
                            </h3>
                            <p class="text-sm text-white/60">
                                Active User
                            </p>
                        </div>
                    </div>

                    <div class="mt-8 space-y-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-white/60">Auth Status</span>
                            <span class="font-bold">Verified</span>
                        </div>

                        <div class="flex justify-between text-sm">
                            <span class="text-white/60">Provider</span>
                            <span class="font-bold">
                                {{ Auth::user()->provider ?? 'Email' }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>