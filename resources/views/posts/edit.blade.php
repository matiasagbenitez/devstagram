@extends('layouts.app')

@section('title')
    Edit post
@endsection

@section('content')

    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form method="POST" action="{{ route('posts.update', [$post->user, $post]) }}" class="mt-10 md:mt-0">
                @csrf

                {{-- Título --}}
                <div class="mb-3">
                    <label for="title" class="mb-1 block uppercase text-gray-500 font-bold text-sm">Title</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        placeholder="Post title..."
                        class="border p-1 w-full rounded-lg @error('title') border-red-500 @enderror"
                        value="{{ $post->title }}"
                    >

                    @error('title')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Campo descripción --}}
                <div class="mb-3">
                    <label for="description" class="mb-1 block uppercase text-gray-500 font-bold text-sm">Descripción</label>
                    <textarea
                        id="description"
                        name="description"
                        placeholder="Post description..."
                        class="border p-1 w-full rounded-lg @error('description') border-red-500 @enderror"
                        rows="5"
                    >{{ $post->description }}</textarea>

                    @error('description')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Botón submit --}}
                <input
                    type="submit"
                    value="Save changes"
                    class="bg-sky-600 hover:bg-sky-700 rounded-lg transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white"
                />

            </form>
        </div>
    </div>

@endsection
