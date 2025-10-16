<x-layout>
    <x-slot:heading>
        <h1>Users page</h1>
     </x-slot:heading>
     <div class='flex justify-center items-center mt-8'>
        <table class="table-auto border-collapse border border-slate-400 mt-4 w-2/3">
           <tr class="bg-gray-300">
               <th class="border border-slate-300 px-4 py-2">ID</th>
               <th class="border border-slate-300 px-4 py-2">Name</th>
               <th class="border border-slate-300 px-4 py-2">Email</th>
           </tr>

           @foreach ($users as $user)       
            <tr onclick="window.location.href='/user/{{ $user['id'] }}'"  class="hover:bg-gray-100 cursor-pointer">
               <td class="border border-slate-300 px-4 py-2">{{ $user['id'] }}</td>
               <td class="border border-slate-300 px-4 py-2">{{ $user['name'] }}</td>
               <td class="border border-slate-300 px-4 py-2">{{ $user['email'] }}</td>
           </tr>
           @endforeach
       </table>
     </div>
</x-layout>