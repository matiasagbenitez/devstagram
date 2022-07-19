@extends('layouts.app')

@section('title')
    {{ $user->username }}
@endsection

@section('content')

    {{-- PARTE SUPERIOR --}}
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

    {{-- PUBLICACIONES --}}
    <section class="container mx-auto mt-10">
        <h2 class="text-xl text-center font-black my-10">Posts</h2>

        @if ($posts->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                @foreach ($posts as $post)
                <div class="">
                    <a href="{{ route('posts.show', [$post->user, $post]) }}">
                        <img src="{{ asset('uploads').'/'.$post->image }}" alt="Imagen del post {{ $post->title }}">
                    </a>
                </div>
                @endforeach
            </div>
            <div class="mt-5">
                {{ $posts->links()}}
            </div>
        @else
            <p class="text-gray-600 text-sm text-center font-bold">No posts to show</p>
        @endif

    </section>

@endsection
