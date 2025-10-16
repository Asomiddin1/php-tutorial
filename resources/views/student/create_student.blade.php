

<x-layout>
    <x-slot:heading>
        <h1>Craete new Student</h1>
    </x-slot:heading>
    <form method="POST" action="/student/store"   class="max-w-md mx-auto mt-8 ">
        @csrf
          <div class="flex flex-col mb-4">
            <label for="student_id">Student_id</label>
            <input type="text" name="student_id" id="student_id" value="{{ old('student_id') }}" class="border border-gray-300 p-2 rounded">
            @error('student_id')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex flex-col mb-4">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="border border-gray-300 p-2 rounded">
            @error('name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
         
         <div class="flex flex-col mb-4">
            <label for="lastname">Lastname</label>
            <input type="text" name="lastname" id="lastname" value="{{ old('lastname') }}" class="border border-gray-300 p-2 rounded">
            @error('lastname')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col mb-4">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="border border-gray-300 p-2 rounded">
            @error('email')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>


        <button class=" bg-blue-400 py-1 px-4 text-white rounded" type="submit">Create Student</button>
    </form>
</x-layout>