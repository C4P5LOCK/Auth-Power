<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-7xl mx-auto px-6 py-10">

            <div class="mb-8">
                <h1 class="text-3xl font-black text-slate-900">
                    Welcome back, {{ Auth::user()->name }} 👋
                </h1>
                <p class="mt-2 text-slate-500">
                    Share updates, view your timeline, and manage your account.
                </p>
            </div>

            @if (session('success'))
                <div class="mb-6 rounded-2xl bg-green-100 border border-green-200 text-green-700 px-5 py-4 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid lg:grid-cols-3 gap-6">

                <div class="lg:col-span-2 space-y-6">

                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
                        <h2 class="text-xl font-black text-slate-900 mb-4">Share an update</h2>

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

                    <div class="space-y-6">
                        @forelse($posts as $post)
                            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">

                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center gap-4">
                                        @if($post->user->avatar)
                                            <img src="{{ $post->user->avatar }}" class="h-12 w-12 rounded-full object-cover">
                                        @else
                                            <div class="h-12 w-12 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold">
                                                {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                            </div>
                                        @endif

                                        <div>
                                            <h3 class="font-bold text-slate-900">
                                                <a href="{{ route('profile.show', $post->user) }}" class="hover:text-indigo-600 transition">
                                                    {{ $post->user->name }}
                                                </a>
                                            </h3>
                                            <p class="text-sm text-slate-500">
                                                {{ $post->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>

                                    @if($post->user_id === Auth::id())
                                        <div class="flex items-center gap-3">
                                            <button
                                                onclick="document.getElementById('edit-post-{{ $post->id }}').classList.toggle('hidden')"
                                                type="button"
                                                class="text-blue-500 hover:text-blue-700"
                                                title="Edit Post"
                                            >
                                                ✏️
                                            </button>

                                            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    onclick="return confirm('Delete this post?')"
                                                    class="text-red-500 hover:text-red-700"
                                                    title="Delete Post"
                                                >
                                                    🗑️
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>

                                <p class="text-slate-700 leading-7">
                                    {{ $post->body }}
                                </p>

                                @if($post->user_id === Auth::id())
                                    <div id="edit-post-{{ $post->id }}" class="hidden mt-4">
                                        <form action="{{ route('posts.update', $post) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <textarea
                                                name="body"
                                                rows="3"
                                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500"
                                            >{{ $post->body }}</textarea>

                                            <button
                                                type="submit"
                                                class="mt-2 px-4 py-2 bg-indigo-600 text-white rounded-xl font-bold"
                                            >
                                                Save Changes
                                            </button>
                                        </form>
                                    </div>
                                @endif

                                <div class="mt-5 flex items-center gap-6 border-t border-slate-100 pt-4">
                                    <form action="{{ route('posts.like', $post) }}" method="POST">
                                        @csrf

                                        <button
                                            type="submit"
                                            class="flex items-center gap-2 text-sm font-bold transition
                                            {{ $post->likedByUser()->exists() ? 'text-red-500' : 'text-slate-500 hover:text-red-500' }}"
                                        >
                                            <span class="text-lg">
                                                {{ $post->likedByUser()->exists() ? '❤️' : '🤍' }}
                                            </span>
                                            <span>
                                                {{ $post->likes_count }} {{ $post->likes_count == 1 ? 'Like' : 'Likes' }}
                                            </span>
                                        </button>
                                    </form>

                                    <div class="flex items-center gap-2 text-sm font-bold text-slate-500">
                                        <span class="text-lg">💬</span>
                                        <span>
                                            {{ $post->comments_count }} {{ $post->comments_count == 1 ? 'Comment' : 'Comments' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <form action="{{ route('comments.store', $post) }}" method="POST" class="flex gap-3">
                                        @csrf

                                        <input
                                            type="text"
                                            name="body"
                                            placeholder="Write a comment..."
                                            class="flex-1 rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        >

                                        <button
                                            type="submit"
                                            class="px-4 py-2 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700"
                                        >
                                            Comment
                                        </button>
                                    </form>
                                </div>

                                <div class="mt-4 space-y-3">
                                    @foreach($post->comments as $comment)
                                        <div class="bg-slate-50 rounded-2xl p-4">
                                            <div class="flex items-start justify-between gap-4">

                                                <div class="flex-1">
                                                    <div class="flex items-center gap-2 mb-1">
                                                        <span class="font-bold text-slate-900">
                                                            {{ $comment->user->name }}
                                                        </span>

                                                        <span class="text-xs text-slate-500">
                                                            {{ $comment->created_at->diffForHumans() }}
                                                        </span>
                                                    </div>

                                                    <p class="text-slate-700">
                                                        {{ $comment->body }}
                                                    </p>

                                                    @if($comment->user_id === Auth::id())
                                                        <div id="edit-comment-{{ $comment->id }}" class="hidden mt-3">
                                                            <form action="{{ route('comments.update', $comment) }}" method="POST">
                                                                @csrf
                                                                @method('PATCH')

                                                                <input
                                                                    type="text"
                                                                    name="body"
                                                                    value="{{ $comment->body }}"
                                                                    class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500"
                                                                >

                                                                <button
                                                                    type="submit"
                                                                    class="mt-2 px-4 py-2 bg-indigo-600 text-white rounded-xl font-bold"
                                                                >
                                                                    Save Changes
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>

                                                @if($comment->user_id === Auth::id())
                                                    <div class="flex items-center gap-2">
                                                        <button
                                                            onclick="document.getElementById('edit-comment-{{ $comment->id }}').classList.toggle('hidden')"
                                                            type="button"
                                                            class="text-blue-500 hover:text-blue-700"
                                                            title="Edit Comment"
                                                        >
                                                            ✏️
                                                        </button>

                                                        <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button
                                                                type="submit"
                                                                onclick="return confirm('Delete this comment?')"
                                                                class="text-red-500 hover:text-red-700"
                                                                title="Delete Comment"
                                                            >
                                                                🗑️
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        @empty
                            <div class="bg-white rounded-3xl p-10 text-center border border-slate-200">
                                <p class="text-slate-500">No posts yet.</p>
                            </div>
                        @endforelse
                    </div>

                </div>

                <div class="space-y-6">

                    <div class="rounded-3xl bg-slate-950 p-8 shadow-sm text-white">
                        <div class="flex items-center gap-4">
                            @if(Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" class="h-16 w-16 rounded-2xl object-cover">
                            @else
                                <div class="h-16 w-16 rounded-2xl bg-indigo-500 flex items-center justify-center text-xl font-black">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif

                            <div>
                                <h3 class="font-black text-lg">
                                    {{ Auth::user()->name }}
                                </h3>
                                <p class="text-sm text-white/60">Active User</p>
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

                    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                        <h2 class="text-xl font-black text-slate-900 mb-5">
                            Account Overview
                        </h2>

                        <div class="space-y-4">
                            <div class="rounded-2xl bg-slate-50 p-4">
                                <p class="text-sm text-slate-500">Email Address</p>
                                <p class="mt-1 font-bold text-slate-900 break-all">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-4">
                                <p class="text-sm text-slate-500">Login Provider</p>
                                <p class="mt-1 font-bold text-slate-900">
                                    {{ Auth::user()->provider ?? 'Email / Password' }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-4">
                                <p class="text-sm text-slate-500">Account Created</p>
                                <p class="mt-1 font-bold text-slate-900">
                                    {{ Auth::user()->created_at->format('M d, Y') }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-4">
                                <p class="text-sm text-slate-500">Google Connected</p>
                                <p class="mt-1 font-bold text-slate-900">
                                    {{ Auth::user()->google_id ? 'Yes' : 'No' }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>