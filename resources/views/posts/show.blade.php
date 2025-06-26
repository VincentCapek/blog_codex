@extends('layouts.app')

@section('content')
    <article>
        <h1 class="text-3xl font-bold mb-2">{{ $post->title }}</h1>
        <p class="text-sm text-gray-500 mb-4">{{ $post->category->name }} - {{ $post->created_at->format('Y-m-d') }}</p>
        <div class="prose">{{ $post->content }}</div>
        <p class="mt-4 text-sm">Tags:
            @foreach($post->tags as $tag)
                <a href="{{ route('posts.tag', $tag) }}" class="text-blue-600">#{{ $tag->name }}</a>
            @endforeach
        </p>
    </article>
@endsection
