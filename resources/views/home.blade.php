@extends('layouts.app')

@section('title')
    Página principal
@endsection

@section('content')

    <section class="container mx-auto mt-5">

        @if ($posts->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                @foreach ($posts as $post)
                    <div class="border-b">
                        <div>
                            <a href="{{ route('posts.show', ['user' => $post->user, 'post' => $post]) }}">
                                <img class="md:rounded-lg hover:shadow-lg" src="{{ asset('uploads'.'/'.$post->image) }}" alt="Imagen del post {{ $post->title }}">
                            </a>
                        </div>

                        {{-- Image footer --}}
                        <div class="mb-2 gap-2 flex place-content-between p-2">

                            {{-- Nombre de usuario --}}
                            <a href="{{ route('posts.index', $post->user->username)}}">
                                <p class="mt-1 text-sm hover:cursor-pointer hover:underline hover:font-bold">{{ $post->user->username }}</p>
                            </a>

                            <div class="flex gap-2">
                                @if ($post->checkLike(auth()->user()))
                                    <form method="POST" action=" {{ route('posts.likes.destroy', $post) }} ">
                                        @method('DELETE')
                                        @csrf
                                        <div class="flex gap-1">
                                            <button type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="red" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                </svg>
                                            </button>
                                            <p>{{ $post->likes->count() }}</p>
                                        </div>
                                    </form>
                                @else
                                    <form method="POST" action=" {{ route('posts.likes.store', $post) }} ">
                                        @csrf
                                        <div class="flex gap-1">
                                            <button type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                @endif

                            {{-- Comentarios --}}
                            <a href="{{ route('posts.show', ['user' => $post->user, 'post' => $post]) }}">
                                <div class="flex gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                    <p>{{ $post->comments->count() }}</p>
                                </div>
                            </a>
                            </div>

                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center">¡No hay posts! Prueba siguiendo a algunos usuarios</p>
        @endif

    </section>

@endsection
