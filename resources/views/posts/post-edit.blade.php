<x-layout>
    <x-slot:heading>
        <h1>Post Edit page</h1>
     </x-slot:heading>
     <div>
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white border border-gray-300 rounded">
        <h2 class="text-2xl font-bold mb-6 text-center">Edit Post</h2>
        <form method="POST" action="/post/{{ $post->id }}">
            @csrf
            @method('PATCH')
            <div class="mb-4">
                <label for="title" class="block text-gray-700 mb-2">Title:</label>
                <input type="text" id="title" name="title" required value="{{ old('title', $post->title) }}" class="w-full px-3 py-2 border border-gray-300 rounded">
                @error('title')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="body" class="block text-gray-700 mb-2">Body:</label>
                <textarea id="body" name="body" rows="5" required class="w-full px-3 py-2 border border-gray-300 rounded">{{ old('body', $post->body) }}</textarea>
                @error('body')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer">Update Post</button>
            </div>
        </form>
     </div>
</x-layout>