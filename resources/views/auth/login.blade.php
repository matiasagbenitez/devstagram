@extends('layouts.app')

@section('title')
    Sign in on DevStagram
@endsection

@section('content')

    <div class="md:flex md:justify-center md:items-center">

        {{-- IMAGEN --}}
        <div class="md:w-7/12 shadow">
            <img src="{{ asset('img/login.jpg') }}" alt="Login image" class="md:rounded-l-xl">
        </div>

        {{-- FORMULARIO --}}
        <div class="md:w-4/12 bg-white md:rounded-r-xl px-6 pt-6 pb-56 shadow">

            <form action="{{ route('login.store')}}" method="POST" novalidate>

                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold text-sm">Email</label>
                    <input id="email" name="email" type="text" placeholder="Your email..." value="{{ old('email') }}"
                    class="border p-2 w-full rounded-lg text-sm @error('email') border-red-500 shadow-md @enderror">
                    @error('email')<p class="bg-red-500 text-white my-2 p-2 rounded-lg text-xs"">{{ $message }}</p>@enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold text-sm">Password</label>
                    <input id="password" name="password" type="password" placeholder="Your password..."
                    class="border p-2 w-full rounded-lg text-sm @error('password') border-red-500 shadow-md @enderror">
                    @error('password')<p class="bg-red-500 text-white my-2 p-2 rounded-lg text-xs"">{{ $message }}</p>@enderror
                </div>

                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 p-2 rounded-lg text-xs"">{{ session('mensaje') }}</p>
                @endif

                <div class="mb-2">
                    <input type="checkbox" name="remember">
                    <label class="text-gray-500 text-sm">
                        Keep me logged in
                    </label>
                </div>

                <input type="submit" value="Sign in" class="my-3 bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white rounded-lg text-sm">

            </form>

        </div>

    </div>

@endsection
