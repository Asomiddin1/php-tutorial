<div>
    <h1>{{ $post->title }}</h1>
    <h3>Your Post created succsefull</h3>
    <a href="{{ url('/post/' . $post->id) }}" class="btn btn-primary mt-3">
        Show Post details
    </a>
</div>