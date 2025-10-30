<x-mail::message>
   <div>
    <h1>{{ $post->title }}</h1>
    <h3>Your Post Edited succsefull</h3>
    <a href="{{ url('/post/' . $post->id) }}" class="btn btn-primary mt-3">
        Go your posts
    </a>
</div>
</x-mail::message>
