<x-layout>
    <x-slot:heading>
        <div class="flex items-center justify-between w-full px-6">
            <h1 class="text-2xl font-bold text-gray-800">Student Detail Page</h1>
            <a href="/students" 
               class="text-sm bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                ← Back to Students
            </a>
        </div>
    </x-slot:heading>

    <div class="w-full flex justify-center mt-10">
        <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-xl border border-gray-200 flex" >
            <div class="w-1/3 flex justify-center items-center">
                <img src="https://static.vecteezy.com/system/resources/previews/007/469/004/large_2x/graduated-student-in-simple-flat-personal-profile-icon-or-symbol-people-concept-illustration-vector.jpg" alt="">
            </div>
            <div>
                <h2 class="text-xl font-semibold text-gray-700 mb-4">
                🎓 Student ID: <span class="text-blue-600">{{ $student->student_id }}</span>
            </h2>

            <div class="space-y-3 text-gray-700">
                <p><span class="font-semibold text-gray-800">Name:</span> {{ $student->name }}</p>
                <p><span class="font-semibold text-gray-800">Lastname:</span> {{ $student->lastname }}</p>
                <p><span class="font-semibold text-gray-800">Email:</span> {{ $student->email }}</p>
            </div>

            <div class="flex py-1  space-x-8 mt-6">
                <button class=" cursor-pointer py-1 px-8 bg-green-400 rounded text-gray-700 hover:text-white"><a href="/student/{{{$student->student_id}}}/edit">Edit</a></button>
                <button form="delete-student" class=" py-1 px-4 bg-red-400 rounded text-gray-700  hover:text-white cursor-pointer">Delete</button>
            </div>
            </div> 
            <form id="delete-student" action="/student/{{$student->student_id}}" method="POST">
                @csrf
                @method('DELETE')
            </form>        
        </div>

    </div>
</x-layout>
