<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-3xl mx-auto px-6 py-10">
            <h1 class="text-3xl font-black text-slate-900 mb-6">
                {{ $user->name }} is Following
            </h1>

            <div class="space-y-4">
                @forelse($following as $followedUser)
                    <a href="{{ route('profile.show', $followedUser) }}" class="block bg-white rounded-2xl p-5 border shadow-sm hover:border-indigo-300 transition">
                        <div class="font-bold text-slate-900">
                            {{ $followedUser->name }}
                        </div>
                        <div class="text-sm text-slate-500">
                            {{ $followedUser->email }}
                        </div>
                    </a>
                @empty
                    <div class="bg-white rounded-2xl p-8 text-center text-slate-500">
                        Not following anyone yet.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>