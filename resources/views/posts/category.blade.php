@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Category: {{ $category->name }}</h1>
    @include('posts.partials.list')
@endsection
