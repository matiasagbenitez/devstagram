@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container mx-auto md:flex mt-5">

        {{-- Contenedor izquierda --}}
        <div class="md:w-1/2">
            {{-- Imagen --}}
            <img src="{{asset('uploads').'/'.$post->image}}" alt="Imagen del post {{ $post->title }}">
        </div>

        {{-- Contenedor derecha --}}
        <div class="md:w-1/2 md:px-5">
            <div class="shadow bg-white p-3 mb-3">

                {{-- Usuario, fecha de creación y descripción --}}
                <div class="p-2">
                    <div class="mx-auto flex justify-between items-center">
                        <div class="flex gap-2 items-center">
                            <a href="{{ route('posts.index', $post->user->username)}}">
                                <img class="imagen-perfil h-8 w-8" src="{{ $user->image ? asset('profiles').'/'.$user->image : asset('img/default-user-icon.jpg') }}" alt="Imagen usuario">
                            </a>
                            <a href="{{ route('posts.index', $post->user->username) }}" class="font-bold">{{ $post->user->username }}</a>
                        </div>

                        @auth
                            @if ($post->user_id === auth()->user()->id)
                                <div class="flex flex-row-reverse gap-3 place-content-center">
                                    {{-- Eliminar --}}
                                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                                        @method('DELETE')   {{-- Método spoofing --}}
                                        @csrf
                                        <button type="submit" title="Eliminar publicación">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                    {{-- Editar publicación --}}
                                    <a href="{{ route('posts.edit', [$post->user, $post]) }}" title="Edit post">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        @endauth

                    </div>
                    <p class="mt-3">{{ $post->description }}</p>
                </div>

                {{-- Likes --}}
                <div class="border-b flex items-center gap-3 px-2">

                    <div class="mx-auto flex items-center gap-3 ml-0">
                        @auth
                            @if ($post->checkLike(auth()->user()))
                                <form method="POST" action=" {{ route('posts.likes.destroy', $post) }} ">
                                    @method('DELETE')
                                    @csrf
                                    <div class="my-4">
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="red" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            @else
                                <form method="POST" action=" {{ route('posts.likes.store', $post) }} ">
                                    @csrf
                                    <div class="my-4">
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            @endif

                        @endauth

                        {{-- Cantidad de me gustas --}}
                        @if ($post->likes->count() != 1)
                            <p class="font-bold"> {{ $post->likes->count() }} likes</p>
                        @else
                            <p class="font-bold"> {{ $post->likes->count() }} like</p>
                        @endif
                    </div>

                    {{-- Fecha de publicación --}}
                    <div>
                        <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                    </div>

                </div>

                <p class="text-center py-2 border-b text-sm text-gray-600">Post's comments</p>

                {{-- Comentarios --}}
                <div class="bg-white shadow mb-5 max-h-72 overflow-y-scroll">
                    @if ($post->comments->count())
                        @foreach ($post->comments as $comment)

                        {{-- DIV COMENTARIO --}}
                            <div class="p-3 border-gray-300 border-b text-sm">

                                {{-- SUPERIOR --}}
                                <div class="mx-auto flex justify-between items-center">

                                    {{-- Foto de perfil y nombre de usuario--}}
                                    <div class="flex gap-2 items-center">
                                        <a href="{{ route('posts.index', $comment->user)}}">
                                            <img class="imagen-perfil h-8 w-8" src="{{ $comment->user->image ? asset('profiles').'/'.$comment->user->image : asset('img/default-user-icon.jpg') }}" alt="Imagen usuario">
                                        </a>
                                        <a href="{{ route('posts.index', $comment->user)}}" class="font-bold">{{ $comment->user->username }}</a>
                                    </div>

                                    @auth
                                        @if ($post->user_id === auth()->user()->id || $comment->user->id === auth()->user()->id)
                                            <div>
                                                <form method="POST" action=" {{ route('comments.destroy', $comment) }} ">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 svgEliminar" viewBox="0 0 20 20" fill="gray">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @endauth

                                </div> {{-- Fin superior --}}

                                {{-- INFERIOR --}}
                                <div class="text-justify">
                                    <p class="break-all py-2">{{ $comment->comment }}</p>
                                    <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                </div>

                            </div>

                        @endforeach
                    @else
                        <p class="p-8 text-center">No comments to show</p>
                    @endif
                </div>

                @auth
                    @if (session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-4 text-white text-center uppercase font-bold">
                            {{ session('mensaje') }}
                        </div>
                    @endif

                    {{-- Formulario --}}
                    <form action="{{ route('comments.store', ['user' => $user, 'post' => $post]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="comment" class="mb-1 block text-gray-500 text-sm">Comment</>
                            <textarea
                                id="comment"
                                name="comment"
                                placeholder="Post comment..."
                                class="border p-1 mt-1 w-full rounded-lg @error('comment') border-red-500 @enderror"
                                rows="2"
                            ></textarea>

                            @error('comment')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Botón submit --}}
                        <input
                            type="submit"
                            value="Comment"
                            class="bg-sky-600 hover:bg-sky-700 rounded-lg transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white my-3"
                        />
                    </form>
                @endauth

            </div>
        </div>
    </div>
@endsection
