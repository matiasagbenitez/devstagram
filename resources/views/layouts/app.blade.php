<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @stack('styles')
    <title>Devstagram - @yield('title')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="bg-gray-100">

    {{-- HEADER --}}
    <header class="p-3 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-black">DevStagram</h1>

            @if (auth()->user())
                <nav class="flex gap-2 items-center">
                    <a class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer" href="{{ route('posts.create') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Create
                    </a>
                    <a class="text-gray-600 text-sm" href="{{ route('posts.index', auth()->user()->username)}}">{{ auth()->user()->username }}</a>
                    <form action="{{ route('logout')}}" method="POST">
                        @csrf
                        <button class="font-bold uppercase text-gray-600 text-sm" type="submit">Log out</button>
                    </form>
                </nav>
            @else
                <nav class="flex gap-2 items-center">
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('login')}}">Login</a>
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register.index')}}">Register</a>
                </nav>
            @endif


        </div>
    </header>

    {{-- MAIN --}}
    <main class="container mx-auto mt-5">
        <h2 class="font-black text-center text-2xl mb-5">@yield('title')</h2>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="text-center p-5 text-gray-500 font-bold uppercase text-sm mt-5">
        DevStagram - All rights reserved {{ date('Y') }}
    </footer>

</body>

</html>
