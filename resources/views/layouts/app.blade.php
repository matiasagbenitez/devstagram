<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Devstagram - @yield('title')</title>
    @vite('resources/css/app.css')
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="bg-gray-100">

    {{-- HEADER --}}
    <header class="p-3 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-black">DevStagram</h1>

            @if (auth()->user())
                <nav class="flex gap-2 items-center">
                    <a class="text-gray-600 text-sm" href="#">{{ auth()->user()->username }}</a>
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
