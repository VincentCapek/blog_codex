@foreach($posts as $post)
    <article class="mb-4">
        <a href="{{ route('posts.show', $post) }}" class="text-xl text-blue-600">{{ $post->title }}</a>
        <p class="text-sm text-gray-500">{{ $post->category->name }} - {{ $post->created_at->format('Y-m-d') }}</p>
    </article>
@endforeach
{{ $posts->links() }}
