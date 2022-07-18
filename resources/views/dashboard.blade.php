@extends('layouts.app')

@section('title')
    Your profile
@endsection

@section('content')

    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 md:flex">

            <div class="md:w-8/12 lg:w-6/12 px-2">
                <img src="{{ asset('img/default-user-icon.jpg') }}" alt="User icon">
            </div>

            <div class="md:w-8/12 lg:w-6/12 px-2">
                <p class="text-gray-700 text-xl">{{ auth()->user()->username }}</p>
            </div>

        </div>
    </div>

@endsection
