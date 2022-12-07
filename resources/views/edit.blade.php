@extends('layout')

@section('content')
    <div class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1 text-sky-900">Edit Hero</h2>
        </header>

        <form action="/hero/{{ $hero->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="name" class="inline-block text-lg mb-2">Hero Name</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name" value="{{ $hero->name }}"/>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="tags" class="inline-block text-lg mb-2">Tags</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags" value="{{ $hero->tags }}"/>
                @error('tags')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="inline-block text-lg mb-2">Description</label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10" >{{ $hero->description }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="logo" class="inline-block text-lg mb-2">
                  Company Logo
                </label>
                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo" />
        
                @error('logo')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            <img
                class="w-48 mr-6 mb-6"
                src="{{ $hero->logo ? asset('storage/' . $hero->logo) : asset('/images/no-image.png') }}"
                alt=""/>

            <div class="mb-6">
                <button class="bg-cyan-800 w-40 text-white rounded py-2 px-4 hover:bg-black">
                    Save changes
                </button>

                <a href="/hero/{{ $hero->id }}" class="btn bg-yellow-800 text-white rounded py-2 px-4 hover:bg-black">
                    Go Back 
                </a>
            </div>
        </form>
    </div>
@endsection