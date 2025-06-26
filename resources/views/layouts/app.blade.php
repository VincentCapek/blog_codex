<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Larablog</title>
</head>
<body class="font-sans antialiased bg-gray-100">
    <header class="bg-white shadow mb-8">
        <nav class="container mx-auto px-4 py-4 flex justify-between">
            <a href="{{ route('posts.index') }}" class="text-2xl font-bold text-red-600">Larablog</a>
            <div class="space-x-4">
                <a href="{{ route('posts.index') }}" class="text-gray-700 hover:text-red-600">Home</a>
                @auth
                    <a href="{{ route('posts.create') }}" class="text-gray-700 hover:text-red-600">New Post</a>
                @endauth
            </div>
        </nav>
    </header>
    <main class="container mx-auto px-4">
        @include('partials.flash')
        @yield('content')
    </main>
</body>
</html>
