<!-- da bi mogli pristupiti $hero treba nam prop -->
@props(['hero'])

<div class="bg-gray-50 border border-gray-200 rounded p-6">
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block h-72"
            src="{{ $hero->logo ? asset('storage/' . $hero->logo) : asset('/images/no-image.png') }}"
            alt=""/>
        <div>
            <h3 class="text-2xl text-sky-900">
                <a href="/hero/{{ $hero->id }}">{{ $hero->name }}</a>
            </h3>
            <x-tags :tagsCsv="$hero->tags" />
        </div>
    </div>
</div>