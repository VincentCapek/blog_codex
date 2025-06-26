@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Post</h1>
    <form method="POST" action="{{ route('posts.update', $post) }}">
        @method('PUT')
        @include('posts.partials.form', ['post' => $post])
    </form>
@endsection
