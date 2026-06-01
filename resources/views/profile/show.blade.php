<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-5xl mx-auto px-6 py-10">

            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-200 mb-6">
                <div class="flex items-center gap-6">
                    @if($user->avatar)
                        <img src="{{ $user->avatar }}" class="h-24 w-24 rounded-3xl object-cover">
                    @else
                        <div class="h-24 w-24 rounded-3xl bg-indigo-600 text-white flex items-center justify-center text-4xl font-black">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif

                    <div>
                        <h1 class="text-3xl font-black text-slate-900">
                            {{ $user->name }}
                        </h1>

                        <p class="text-slate-500 mt-1">
                            Joined {{ $user->created_at->format('M d, Y') }}
                        </p>
                    </div>
                </div>

                <div class="grid sm:grid-cols-3 gap-4 mt-8">
                    <div class="rounded-2xl bg-slate-50 p-5">
                        <p class="text-sm text-slate-500">Posts</p>
                        <p class="text-2xl font-black text-slate-900">
                            {{ $user->posts->count() }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-slate-50 p-5">
                        <p class="text-sm text-slate-500">Comments</p>
                        <p class="text-2xl font-black text-slate-900">
                            {{ $user->comments->count() }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-slate-50 p-5">
                        <p class="text-sm text-slate-500">Provider</p>
                        <p class="text-2xl font-black text-slate-900">
                            {{ $user->provider ?? 'Email' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <h2 class="text-2xl font-black text-slate-900">
                    Recent Posts
                </h2>

                @forelse($user->posts as $post)
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
                        <p class="text-slate-700 leading-7">
                            {{ $post->body }}
                        </p>

                        <p class="text-sm text-slate-500 mt-4">
                            {{ $post->created_at->diffForHumans() }}
                        </p>
                    </div>
                @empty
                    <div class="bg-white rounded-3xl p-10 text-center border border-slate-200">
                        <p class="text-slate-500">
                            This user has not posted yet.
                        </p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>