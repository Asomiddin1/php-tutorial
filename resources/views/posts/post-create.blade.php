<x-layout>
    <x-slot:heading>
        <div class="flex items-center justify-between w-full px-6">
            <h1>Post Create Page</h1>
            <a href="/posts" 
               class="text-sm bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                ← Back to Posts
            </a>
        </div>
</x-slot:heading>
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white border border-gray-300 rounded">
        <h2 class="text-2xl font-bold mb-6 text-center">Create a New Post</h2>
        <form method="POST" action="/posts">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 mb-2">Title:</label>
                <input type="text" id="title" name="title" required class="w-full px-3 py-2 border border-gray-300 rounded">
                @error('title')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="body" class="block text-gray-700 mb-2">Body:</label>
                <textarea id="body" name="body" rows="5" required class="w-full px-3 py-2 border border-gray-300 rounded"></textarea>
                @error('body')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer">Create Post</button>
            </div>
        </form>
    </div>
</x-layout>