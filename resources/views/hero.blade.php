@extends('layout')

@section('content')

@include('partials._hero')

<a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back</a>

<div class="mx-4">
    <div class="bg-gray-50 border border-gray-200 p-10 rounded">
        <div class="flex flex-col items-center justify-center text-center">
            <img
                class="w-48 mr-6 mb-6"
                src="{{ $hero->logo ? asset('storage/' . $hero->logo) : asset('/images/no-image.png') }}"
                alt=""/>

            <h3 class="text-5xl mb-2 text-sky-900 font-extrabold">{{ $hero->name }}</h3>

            <x-tags :tagsCsv="$hero->tags" />

            <div class="border border-gray-200 w-full mb-6"></div>
            <div>
                <h3 class="text-3xl font-bold mb-4">
                    Description
                </h3>
                <div class="text-lg space-y-6">
                    <p>
                        {{ $hero->description }}
                    </p>

                </div>
                @if ($hero->user_id === auth()->id())
                <a href="/hero/edit/{{ $hero->id }}"
                    class="block bg-sky-700 text-white mt-6 py-2 rounded-xl hover:opacity-80"><i
                    class="fa-solid fa-pen"></i> Edit Hero</a>

                <form action="/hero/{{ $hero->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-700 text-white mt-6 py-2 rounded-xl hover:opacity-80 w-full"><i
                        class="fa-solid fa-trash"></i> Delete
                    </button>
                </form>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection
