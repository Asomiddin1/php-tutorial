<x-layout>
    <x-slot:heading>
         <div class="flex items-center justify-between w-full px-6">
            <h1 class="text-2xl font-bold text-gray-800">Posts Page</h1>
            <a href="/posts/create" 
               class="text-sm bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                Create New Post
            </a>
        </div>
    </x-slot:heading>

        <div class="bg-gray-100 min-h-screen py-8">
    
    <div class="flex flex-wrap justify-center gap-8 px-4 md:px-8 w-full max-w-screen-xl mx-auto">

      @foreach($posts as $post)
        <a href="/post/{{ $post->id }}" class="w-full sm:w-[350px] bg-white p-6 rounded-xl shadow-xl hover:shadow-2xl 
             transition duration-300 transform hover:-translate-y-1 block group">
            
            <div class="mb-4">
                <img class="w-full h-48 object-cover rounded-lg" 
                     src="https://futurimedia.com/wp-content/uploads/2025/06/POST-logo-with-black-background.jpg" 
                     alt="Post Rasmi">
            </div>
            
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4 line-clamp-2 min-h-[3rem] transition duration-300 group-hover:text-indigo-700">
                    {{ $post->title }} 
                </h2>
                
                <div class="flex items-center justify-between border-t pt-4 border-gray-200">
                    <div class="flex items-center">
                        <img class="w-10 h-10 rounded-full object-cover mr-3" 
                             src="https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740&q=80" 
                             alt="Muallif Avatari">
                        
                        <span class="text-md font-semibold text-gray-700">
                            Muallif: <span class="text-indigo-600">{{ $post->user->name }}</span>
                        </span>
                    </div>
                    
                    <div>
                        <span class='text-indigo-600 font-medium hover:text-indigo-800 underline transition duration-300'>
                            Batafsil
                        </span>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
    </div>
</div>
</x-layout>