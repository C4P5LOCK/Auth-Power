

<x-app-layout>
    <div class="min-h-screen bg-slate-100">
        <div class="max-w-3xl mx-auto px-6 py-10">

            <div class="mb-8">
                <h1 class="text-3xl font-black text-slate-900">
                    Edit Profile
                </h1>
                <p class="mt-2 text-slate-500">
                    Update your personal information and public profile details.
                </p>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-200">
                <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Full Name
                        </label>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', Auth::user()->name) }}"
                            class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500"
                        >

                        @error('name')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Bio
                        </label>
                        <textarea
                            name="bio"
                            rows="4"
                            class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Tell people a little about yourself..."
                        >{{ old('bio', Auth::user()->bio) }}</textarea>

                        @error('bio')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Location
                        </label>
                        <input
                            type="text"
                            name="location"
                            value="{{ old('location', Auth::user()->location) }}"
                            class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Abuja, Nigeria"
                        >

                        @error('location')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Website
                        </label>
                        <input
                            type="url"
                            name="website"
                            value="{{ old('website', Auth::user()->website) }}"
                            class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="https://example.com"
                        >

                        @error('website')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between pt-4">
                        <a
                            href="{{ route('profile.show', Auth::user()) }}"
                            class="text-sm font-bold text-slate-500 hover:text-slate-800"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="px-6 py-3 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition"
                        >
                            Save Profile
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>