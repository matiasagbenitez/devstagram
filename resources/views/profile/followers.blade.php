@extends('layouts.app')

@section('title')
    {{ $user->username }}'s followers
@endsection

@section('content')
    <div class="container justify-center mt-5">

        <div class="w-10/12 md:w-6/12 justify-center mx-auto items-center bg-white p-5 rounded-lg">

            {{-- DIV SEGUIDORES --}}
            <div class=" border-gray-300 text-sm">
                @if ($followers->count())
                    @foreach ($followers as $follower)

                        {{-- DIV SEGUIDOR --}}
                        <div class="p-3 border-gray-300 border-b text-sm flex">

                            {{-- IMAGEN SEGUIDOR Y NOMBRE --}}
                            <div class="w-6/12 flex items-center gap-2">
                                <a href="{{ route('posts.index', $follower->username)}}">
                                    <img class="imagen-perfil h-8 w-8" src="{{ $follower->image ? asset('profiles').'/'.$follower->image : asset('img/default-user-icon.jpg') }}" alt="User image">
                                </a>
                                <a href="{{ route('posts.index', $follower->username)}}" class="font-bold">
                                    {{ $follower->username }}
                                </a>
                            </div>

                            {{-- NOMBRE SEGUIR Y BOTÓN SEGUIR --}}
                            <div class="w-6/12 flex items-center place-content-end">
                                @auth
                                    @if ($follower->id !== auth()->user()->id)
                                        @if (!$follower->siguiendo(auth()->user()))

                                            <form method="POST" action="{{ route('followers.store', $follower) }}">
                                                @csrf
                                                <input type="submit"
                                                    class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                                    value="Follow"
                                                />
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('followers.destroy', $follower) }}">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit"
                                                    class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                                    value="Unfollow"
                                                />
                                            </form>
                                        @endif
                                    @endif

                                @endauth
                            </div>
                        </div>

                    @endforeach
                @else
                    <p class="text-center">¡{{$user->username}} has no followers!</p>
                @endif
            </div>

        </div>

@endsection
