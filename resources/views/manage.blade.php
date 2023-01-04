@extends('layout')

@section('content')

<div class="bg-gray-50 border border-gray-200 p-10 rounded">
    <header>
        <h1 class="text-3xl text-center font-bold my-6 uppercase">
            Manage Heroes
        </h1>
    </header>

    <table class="w-full table-auto rounded-sm">
        <tbody>
            @unless ($heroes->isEmpty())
            @foreach ($heroes as $hero)

            <tr class="border-gray-300">
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <a href="/hero/{{ $hero->id }}">
                        {{ $hero->name }}
                    </a>
                </td>
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <a href="/hero/edit/{{ $hero->id }}" class="text-blue-400 px-6 py-2 rounded-xl">
                        <i class="fa-solid fa-pen-to-square"></i>
                        Edit</a>
                </td>
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <form action="/hero/{{ $hero->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                        <button class="text-red-600" onclick="return confirm('Are you sure?')">
                            <i class="fa-solid fa-trash-can"></i>
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
            @else
            <tr class="border-gray-300">
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                  <p class="text-center">No Heroes Found</p>
                </td>
              </tr>
            @endunless
        </tbody>
    </table>
</div>


@endsection
