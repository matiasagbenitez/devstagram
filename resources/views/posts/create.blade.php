@extends('layouts.app')

@section('title')
    New post
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('content')
    <div class="md:flex md:items-center mt-5">

        {{-- DROPZONE --}}
        <div class="md:w-1/2 px-10">
            <form action="{{ route('images.store') }}" id="dropzone" method="POST" enctype="multipart/form-data"
                class="dropzone border-dashed border-2 w-full h-96 rounded-lg flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>

        {{-- FORMULARIO --}}
        <div class="md:w-4/12 bg-white md:rounded-xl p-6 shadow mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>

                @csrf

                {{-- Titulo --}}
                <div class="mb-3">
                    <label for="title" class="mb-2 block uppercase text-gray-500 font-bold text-sm">Title</label>
                    <input id="title" name="title" type="text" placeholder="Post title..." value="{{ old('title') }}"
                    class="border p-2 w-full rounded-lg text-sm @error('title') border-red-500 shadow-md @enderror">
                    @error('title')<p class="bg-red-500 text-white my-2 p-2 rounded-lg text-xs"">{{ $message }}</p>@enderror
                </div>

                {{-- Descripción --}}
                <div class="mb-3">
                    <label for="description" class="mb-2 block uppercase text-gray-500 font-bold text-sm">Description</label>
                    <textarea id="description" name="description" type="text" class="border p-2 w-full rounded-lg text-sm @error('description') border-red-500 shadow-md @enderror"
                    placeholder="Post description...">{{old('description')}}</textarea>
                    @error('description')<p class="bg-red-500 text-white my-2 p-2 rounded-lg text-xs"">{{ $message }}</p>@enderror
                </div>

                <div>
                    <input name="image" type="hidden" value="{{ old('image') }}">
                    @error('image')<p class="bg-red-500 text-white my-2 p-2 rounded-lg text-xs"">{{ $message }}</p>@enderror
                </div>

                <input type="submit" value="Create post" class="my-3 bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white rounded-lg text-sm">

            </form>
        </div>

    </div>
@endsection
