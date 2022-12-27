@props(['id' => null, 'maxWidth' => null])

<x-jet-modal :id="$id" {{ $attributes }}>
    <div class="text-lg justify-start px-3 py-3 bg-blue-100">
        {{ $title ?? null}}
        <hr>
    </div>

    <div class="px-3 py-3 mt-4">
        {{ $content }}
    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-blue-100 text-right">
        <hr>{{ $footer ?? null }}
    </div>
</x-jet-modal>
