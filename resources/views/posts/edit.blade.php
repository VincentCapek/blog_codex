@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Post</h1>
    <form method="POST" enctype="multipart/form-data" action="{{ route('posts.update', $post) }}" class="bg-white rounded shadow p-6">
        @method('PUT')
        @include('posts.partials.form', ['post' => $post])
    </form>
@endsection
