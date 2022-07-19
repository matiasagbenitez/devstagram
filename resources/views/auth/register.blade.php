@extends('layouts.app')

@section('title')
    Sign up for DevStagram
@endsection

@section('content')

    <div class="md:flex md:justify-center md:items-center mt-5">

        {{-- IMAGEN --}}
        <div class="md:w-7/12 shadow">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Registration image" class="md:rounded-l-xl">
        </div>

        {{-- FORMULARIO --}}
        <div class="md:w-4/12 bg-white md:rounded-r-xl p-6 shadow">

            <form action="{{ route('register.store') }}" method="POST" novalidate>

                @csrf

                {{-- Name --}}
                <div class="mb-3">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold text-sm">Name</label>
                    <input id="name" name="name" type="text" placeholder="Your name..." value="{{ old('name') }}"
                    class="border p-2 w-full rounded-lg text-sm @error('name') border-red-500 shadow-md @enderror">
                    @error('name')<p class="bg-red-500 text-white my-2 p-2 rounded-lg text-xs"">{{ $message }}</p>@enderror
                </div>

                {{-- Username --}}
                <div class="mb-3">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold text-sm">Username</label>
                    <input id="username" name="username" type="text" placeholder="Your username..." value="{{ old('username') }}"
                    class="border p-2 w-full rounded-lg text-sm @error('username') border-red-500 shadow-md @enderror">
                    @error('username')<p class="bg-red-500 text-white my-2 p-2 rounded-lg text-xs"">{{ $message }}</p>@enderror
                </div>

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

                {{-- Password confirmation --}}
                <div class="mb-3">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold text-sm">Password confirmation</label>
                    <input id="password_confirmation"" name="password_confirmation"" type="password" placeholder="Repeat your password..."
                    class="border p-2 w-full rounded-lg text-sm @error('password_confirmation') border-red-500 shadow-md @enderror">
                    @error('password_confirmation')<p class="bg-red-500 text-white my-2 p-2 rounded-lg text-xs"">{{ $message }}</p>@enderror
                </div>

                <input type="submit" value="Create account" class="my-3 bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white rounded-lg text-sm">

            </form>

        </div>

    </div>

@endsection
