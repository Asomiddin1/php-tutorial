<x-layout>
    <x-slot:heading>
        <h1>Register page</h1>
     </x-slot:heading>
    <form method="POST" action="/register" class="max-w-2/4 mx-auto mt-10 p-6 border border-gray-300 rounded">
        @csrf
        <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>

        <div>
            <label for="name" class="block text-gray-700 mb-2">Name:</label>
            <input type="text" id="name" name="name" required value="{{ old('name') }}" class="w-full px-3 py-2 border border-gray-300 rounded">
              @error('name')
                <p style="color: red;">{{ $message }}</p>
              @enderror
        </div>
         
        <div class="mb-4">
            <label for="email" class="block text-gray-700 mb-2">Email:</label>
            <input type="email" id="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded">
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
        <div>
            <label for="password_confirmation" class="block text-gray-700 mb-2">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full px-3 py-2 border border-gray-300 rounded mb-6">
                @error('password_confirmation')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer">Create Account</button>
            <a href="/login" class="text-blue-500 hover:underline">Login qiling</a>
        </div>
    </form>
</x-layout>