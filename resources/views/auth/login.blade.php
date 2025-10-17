<x-layout>
    <x-slot:heading>
        <h1>Login page</h1>
     </x-slot:heading>

    <form method="POST" action="/login" class="max-w-2/3 mx-auto mt-10 p-6 border border-gray-300 rounded">
        @csrf
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 mb-2">Email:</label>
            <input type="email" id="email" name="email" required  value="{{ old('email') }}" class="w-full px-3 py-2 border border-gray-300 rounded">
            @error('email')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password" class="block text-gray-700 mb-2">Password:</label>
            <input type="password" id="password" name="password" required class="w-full px-3 py-2 border border-gray-300 rounded">
            @error('password')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer">Login</button>
            <a href="/register" class="text-blue-500 hover:underline">Don't have an account? Register</a>
        </div>
    </form>
</x-layout>