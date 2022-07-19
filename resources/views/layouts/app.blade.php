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
    @livewireStyles
</head>

<body class="bg-gray-100">

    {{-- HEADER --}}
    <header class="p-3 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <a class="text-3xl font-normal" href="{{ route('home') }}"> <span class="font-black">Dev</span>Stagram</a>

            @if (auth()->user())
                <nav class="flex gap-4 items-center">
                    <a class="bg-white border px-4 py-1 text-gray-600 rounded-lg  cursor-pointer" href="{{ route('posts.create') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                          </svg>
                    </a>
                    <a class="text-gray-600 text-sm" href="{{ route('posts.index', auth()->user()->username)}}">{{ auth()->user()->username }}</a>
                    <form action="{{ route('logout')}}" method="POST">
                        @csrf
                        <div class="flex items-center">
                            <button class="text-gray-600 px-4 py-1 text-sm border rounded-lg flex items-center gap-2" type="submit">
                                Log out
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </button>
                        </div>

                    </form>
                </nav>
            @else
                <nav class="flex gap-2 items-center">
                    <a class="text-gray-600 px-4 py-1 text-base font-sm" href="{{ route('login')}}">Sign in</a>
                    <a class="text-gray-600 px-4 py-1 text-base font-sm border rounded-lg" href="{{ route('register.index')}}">Sign up</a>
                </nav>
            @endif


        </div>
    </header>

    {{-- MAIN --}}
    <main class="container mx-auto mt-5">
        <h2 class="font-black text-center text-2xl">@yield('title')</h2>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="text-center p-5 text-gray-500 uppercase text-xs mt-5">
        DevStagram - All rights reserved {{ date('Y') }}
    </footer>

    @livewireScripts
</body>

</html>
