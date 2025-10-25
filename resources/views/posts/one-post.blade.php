<x-layout>
    <x-slot:heading>
        <div class="flex items-center justify-between w-full px-6">
            <h1>Post Detail Page</h1>
            <a href="/posts" 
               class="text-sm bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                ← Back to Posts
            </a>
        </div>
    </x-slot:heading>

    <div class="flex flex-col lg:flex-row px-4 md:px-8 justify-center bg-gray-100 py-8 gap-8 min-h-screen">
        
        <div class="w-full max-w-3xl bg-white p-8 rounded-xl shadow-2xl h-fit">
              
              <div class="mb-6">
                <img class="w-full h-96 object-cover rounded-lg shadow-lg" 
                     src="https://futurimedia.com/wp-content/uploads/2025/06/POST-logo-with-black-background.jpg" 
                     alt="Post Rasmi">
              </div>
              
              <div>
                <h2 class="text-2xl font-extrabold text-gray-900 mb-6 mt-4">
                    {{ $post->title ?? 'Sarlavha aniqlanmadi' }}
                </h2>
                
                <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200">
                   
                   <div class="flex items-center">
                     <img class="w-12 h-12 rounded-full object-cover mr-4 shadow-md ring-2 ring-indigo-100" 
                         src="https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740&q=80" 
                         alt="Muallif Avatari">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700">
                            Muallif: <span class="text-indigo-600">{{ $post->user->name ?? 'Noma\'lum' }}</span>
                        </h2>
                        <p class="text-sm text-gray-500">{{ $post->created_at->format('Y-m-d') ?? 'Sana Noma\'lum' }}</p>
                    </div>
                   </div>
                   
                   <div class="flex items-center gap-3">
                        @can('edit', $post)
                        <a href="/post/{{ $post->id }}/edit" 
                            class="text-md bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg font-semibold transition shadow-md">
                            Tahrirlash
                        </a>

                        <form method="POST" action="/post/{{ $post->id }}" class="m-0 p-0" onsubmit="return confirm('Haqiqatan ham bu postni oʻchirmoqchimisiz?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="text-md bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg font-semibold transition shadow-md">
                                O'chirish
                            </button>
                        </form>
                        @endcan
                      
                  </div>
                   
                </div>
                
                <p class="text-lg text-gray-700 leading-relaxed mb-8">
                    {{ $post->body ?? 'Bu postning asosiy mazmuni. Bu yerda siz turli mavzulardagi qiziqarli maqolalar va ma\'lumotlarni topishingiz mumkin. Yangilanishlarni kuzatib boring!' }}
                </p>
                
                <div class="mt-8 pt-4 border-t border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Kommentariya Qoldirish</h3>
                   <form action="/comment" method="POST" class="flex gap-3 w-full items-center">
    @csrf
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <input type="text" name="comment" placeholder="O'z fikringizni yozing..." 
           class="border border-gray-300 rounded-lg px-4 py-2 w-full focus:ring-indigo-500 focus:border-indigo-500 transition duration-150">
               <button type="submit" 
            class="bg-indigo-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition duration-150 flex-shrink-0">
              Yuborish
           </button>
         </form>
         <!-- comments -->
          <div class="mt-6">
    <h4 class="text-xl font-semibold mb-3">Fikrlar</h4>

    @foreach($post->comments->reverse() as $comment)
        <div class="border-b border-gray-200 py-3 relative">
            <p class="text-gray-800">{{ $comment->comment }}</p>

            <div class="flex justify-between items-center mt-2">
                <p class="text-sm text-gray-500">
                    {{ $comment->user->name ?? 'Anonim' }} - {{ $comment->created_at->diffForHumans() }}
                </p>

                <div class="flex items-center gap-3">
                    @if(auth()->check() && auth()->user()->id === $comment->user_id)
                        {{-- ID va matnni funksiyaga uzatish --}}
                        <button 
                            class="text-xs text-indigo-600 hover:text-indigo-800 font-medium transition"
                            onclick="openEditModal({{ $comment->id }}, '{{ e($comment->comment) }}')">
                            Tahrirlash
                        </button>

                        <form method="POST" action="/comment/{{ $comment->id }}" class="inline-block m-0 p-0"
                              onsubmit="return confirm('Haqiqatan ham bu kommentariyani oʻchirmoqchimisiz?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="text-xs text-red-600 hover:text-red-800 font-medium transition">
                                O'chirish
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

<div id="editModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-semibold mb-4">Kommentariyani tahrirlash</h3>
        
        {{-- Action URL JS orqali dinamik oʻrnatiladi, shuning uchun hozircha boʻsh qoldiramiz --}}
        <form id="editCommentForm" method="POST" action=""> 
            @csrf
            @method('PATCH')
            {{-- ID qoʻshildi --}}
            <textarea id="editCommentBody" name="comment" 
                      class="w-full border border-gray-300 rounded-lg p-3 focus:ring-indigo-500 focus:border-indigo-500 transition"
                      rows="3" required></textarea>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button"
                        onclick="closeEditModal()"
                        class="text-xs bg-gray-300 hover:bg-gray-400 text-gray-800 px-3 py-1 rounded font-medium transition">
                    Bekor qilish
                </button>
                <button type="submit"
                        class="text-xs bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded font-medium transition">
                    Saqlash
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Bu funksiya HTML maxsus belgilarini (&#039; kabi) asl belgiga (') aylantiradi.
function decodeHtml(html) {
    const txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
}

function openEditModal(commentId, commentBody) {
    const modal = document.getElementById('editModal');
    const form = document.getElementById('editCommentForm');
    const textarea = document.getElementById('editCommentBody');

    // Matnni dekodlash
    const decodedComment = decodeHtml(commentBody); 

    // Formaning action URL manzilini oʻrnatish
    form.action = `/comment/${commentId}`; 

    // Dekodlangan matnni textarea ichiga yuklash
    textarea.value = decodedComment;

    // Modal oynani koʻrsatish
    modal.classList.remove('hidden');
    modal.classList.add('flex'); 
}


function closeEditModal() {
    const modal = document.getElementById('editModal');
    
    modal.classList.remove('flex'); 
    modal.classList.add('hidden');

    document.getElementById('editCommentBody').value = '';
    document.getElementById('editCommentForm').action = '';
}
</script>
          <!-- comments -->
                    </div>
              </div>
        </div>
             
        <div class="w-full lg:w-80 bg-white p-6 rounded-xl shadow-2xl h-fit">
            <h1 class="text-2xl font-bold text-gray-800 pb-3 mb-4 border-b-4 border-indigo-500/75">
                Barcha Postlar
            </h1>
            <div class="space-y-4">
                
                @foreach($posts as $postItem)
                <a href="/post/{{ $postItem['id'] }}" class="block group relative pb-4 border-b border-gray-200 transition duration-300 ease-in-out hover:bg-gray-50 p-2 rounded-lg -mx-2">
                    <div class="flex items-center gap-4">
                        <div class="w-30 h-20 flex-shrink-0 relative"> 
                            <img class="w-full h-full object-cover rounded-lg shadow-lg border border-gray-200 transition duration-300 group-hover:scale-105" 
                                 src="https://futurimedia.com/wp-content/uploads/2025/06/POST-logo-with-black-background.jpg" 
                                 alt="Post Rasmi">
                        </div>
                        <div>
                            <h2 class="text-base font-semibold text-gray-800 transition duration-300 group-hover:text-indigo-600 line-clamp-2">{{ $postItem['title'] }}</h2>
                            <p class="text-xs text-gray-500 mt-1">Muallif: {{ $postItem->user->name ?? 'Noma\'lum' }}</p>
                        </div>
                    </div>
                </a>
                @endforeach
                
            </div>
        </div>
        
    </div>
</x-layout>