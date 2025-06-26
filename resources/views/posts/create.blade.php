@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Create Post</h1>
    <form method="POST" action="{{ route('posts.store') }}">
        @include('posts.partials.form')
    </form>
@endsection
