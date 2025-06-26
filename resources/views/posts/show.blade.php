@extends('layouts.app')

@section('content')
    <article class="bg-white rounded shadow p-6">
        <h1 class="text-3xl font-bold mb-2">{{ $post->title }}</h1>
        <p class="text-sm text-gray-500 mb-4">
            <a href="{{ route('posts.category', $post->category) }}" class="text-blue-600 hover:underline">
                {{ $post->category->name }}
            </a> - {{ $post->created_at->format('Y-m-d') }}
        </p>
        <div class="prose">{{ $post->content }}</div>
        <p class="mt-4 text-sm">Tags:
            @foreach($post->tags as $tag)
                <a href="{{ route('posts.tag', $tag) }}" class="text-blue-600">#{{ $tag->name }}</a>
            @endforeach
        </p>
        <a href="{{ route('posts.edit', $post) }}"
           class="inline-flex items-center mt-4 px-3 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="1.5"
                 stroke="currentColor" class="w-4 h-4 mr-1">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M16.862 3.487a2.05 2.05 0 1 1 2.901 2.902l-9.26 9.26a1 1 0 0 1-.47.263l-3.704.926a.25.25 0 0 1-.303-.303l.927-3.704a1 1 0 0 1 .263-.47l9.646-9.647ZM11.25 6.75l6 6M18 14.25v4.5A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6h4.5"/>
            </svg>
            Edit
        </a>
    </article>
@endsection
