@extends('layouts.app')

@section('title')
    {{ $user->username }}
@endsection

@section('content')

    {{-- PARTE SUPERIOR --}}
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">

            {{-- Imagen usuario --}}
            <div class="w-8/12 lg:w-6/12 p-5">
                <img class="imagen-perfil" src="{{ $user->image ? asset('profiles').'/'.$user->image : asset('img/default-user-icon.jpg') }}" alt="Imagen usuario">
            </div>

            <div class="md:w-8/12 lg:w-6/12 px-2 flex flex-col items-center md:justify-center md:items-start py-4 md:py-10">

                {{-- DIV NOMBRE DE USUARIO + ICONO PARA EDITAR PERFIL --}}
                <div class="flex items-center gap-2 mb-3">
                    <p class="text-gray-700 text-xl">{{ $user->username }}</p>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{ route('profile.edit', $user) }}"
                                class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>

                <p class="text-gray-800 text-sm mb-3 font-bold">{{ $user->posts->count() }}<span class="font-normal"> posts</span></p>
                <a class="text-gray-800 text-sm mb-3 font-bold" href="{{ route('profile.followers', $user) }}">{{ $user->followers->count() }}
                    <span class="font-normal">@choice('follower|followers', $user->followers->count() )</span>
                </a>
                <a class="text-gray-800 text-sm mb-3 font-bold" href="{{ route('profile.following', $user) }}">{{ $user->following->count() }}<span class="font-normal"> following</span></a>

                {{-- SEGUIR / DEJAR DE SEGUIR --}}
                @auth
                    @if ($user->id !== auth()->user()->id)
                        @if (!$user->siguiendo(auth()->user()))
                            <form method="POST" action="{{ route('followers.store', $user) }}">
                                @csrf
                                <input type="submit"
                                    class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer mt-2"
                                    value="Follow"
                                />
                            </form>
                        @else
                            <form method="POST" action="{{ route('followers.destroy', $user) }}">
                                @csrf
                                @method('DELETE')
                                <input type="submit"
                                    class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer mt-2"
                                    value="Unfollow"
                                />
                            </form>
                        @endif
                    @endif
               @endauth

            </div>

        </div>
    </div>

    {{-- PUBLICACIONES --}}
    <section class="container mx-auto md:mt-10">
        <h2 class="text-xl text-center font-black my-5 md:my-10">Posts</h2>

        @if ($posts->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                @foreach ($posts as $post)
                <div class="">
                    <a href="{{ route('posts.show', [$post->user, $post]) }}">
                        <img class="md:rounded-lg" src="{{ asset('uploads').'/'.$post->image }}" alt="Imagen del post {{ $post->title }}">
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
