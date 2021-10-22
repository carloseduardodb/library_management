@php $editing = isset($book) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            value="{{ old('name', ($editing ? $book->name : '')) }}"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="pagecount"
            label="Pagecount"
            value="{{ old('pagecount', ($editing ? $book->pagecount : '')) }}"
            max="255"
            placeholder="Pagecount"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="category"
            label="Category"
            value="{{ old('category', ($editing ? $book->category : '')) }}"
            max="255"
            placeholder="Category"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="authors"
            label="Authors"
            value="{{ old('authors', ($editing ? $book->authors : '')) }}"
            max="255"
            placeholder="Authors"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
