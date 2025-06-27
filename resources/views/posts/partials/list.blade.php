<div class="grid gap-4 md:grid-cols-2">
@foreach($posts as $post)
    <article class="bg-white rounded shadow p-4">
        @if($post->image_url)
            <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="mb-2 w-full h-48 object-cover">
        @endif
        <a href="{{ route('posts.show', $post) }}" class="text-xl font-semibold text-blue-600 hover:underline">{{ $post->title }}</a>
        <p class="text-sm text-gray-500">{{ $post->category->name }} - {{ $post->created_at->format('Y-m-d') }}</p>
    </article>
@endforeach
</div>
<div class="mt-4">
    {{ $posts->links() }}
</div>
