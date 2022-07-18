@extends('layouts.app')

@section('title')
    {{ $user->username }}
@endsection

@section('content')

    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">

            <div class="w-8/12 lg:w-6/12 px-2">
                <img src="{{ asset('img/default-user-icon.jpg') }}" alt="User icon">
            </div>

            <div class="md:w-8/12 lg:w-6/12 px-2 flex flex-col items-center md:justify-center md:items-start py-10">
                <p class="text-gray-700 text-xl mb-5">{{ $user->username }}</p>

                <p class="text-gray-800 text-sm mb-3 font-bold">0<span class="font-normal"> publicaciones</span></p>
                <p class="text-gray-800 text-sm mb-3 font-bold">0<span class="font-normal"> seguidores</span></p>
                <p class="text-gray-800 text-sm mb-3 font-bold">0<span class="font-normal"> seguidos</span></p>
            </div>

        </div>
    </div>

@endsection
