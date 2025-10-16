<x-layout>
    <x-slot:heading>
        <div class="overflow-x-auto w-full flex justify-between items-center">
            <h1 class="px-4 text-2xl font-bold">Students Page</h1>

            <form method="GET" action="/students" class="flex items-center gap-2">
                <input 
                    type="text" 
                    name="id" 
                    placeholder="Enter ID..." 
                    value="{{ $searchId ?? '' }}"
                    class="border border-gray-300 rounded-md px-4 py-2 text-sm"
                >
                <button class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded-md text-sm">
                    Search
                </button>
            </form>

            <a href="/student/create" 
               class="text-sm font-semibold bg-blue-600 hover:bg-blue-700 text-white py-2 px-3 rounded-xl">
               Create Student
            </a>
        </div>
    </x-slot:heading>

    <div class="overflow-x-auto w-full flex flex-col items-center mx-auto">
        <table class="table-auto border-collapse border border-slate-400 mt-4 w-2/3 pb-10">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-slate-300 px-4 py-2">ID</th>
                    <th class="border border-slate-300 px-4 py-2">Student ID</th>
                    <th class="border border-slate-300 px-4 py-2">Name</th>
                    <th class="border border-slate-300 px-4 py-2">Lastname</th>
                    <th class="border border-slate-300 px-4 py-2">Email</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    <tr 
                        class="hover:bg-gray-100 cursor-pointer transition duration-150"
                        onclick="window.location='/student/{{ $student['student_id'] }}'">
                        <td class="border border-slate-300 px-4 py-2">{{ $student['id'] }}</td>
                        <td class="border border-slate-300 px-4 py-2">{{ $student['student_id'] }}</td>
                        <td class="border border-slate-300 px-4 py-2">{{ $student['name'] }}</td>
                        <td class="border border-slate-300 px-4 py-2">{{ $student['lastname'] }}</td>
                        <td class="border border-slate-300 px-4 py-2">{{ $student['email'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">Student not found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="my-4 w-full flex justify-center">
            {{ $students->links() }}
        </div>
    </div>
</x-layout>
