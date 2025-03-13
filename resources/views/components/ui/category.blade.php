@props([
    'title',
    'icon'
])

<div class="bg-[#F2F9FBBF] text-[#004972] font-normal poetsen-one-regular flex items-center gap-2 py-5 px-8 rounded-xl">
    <img src="{{ $icon }}" class="w-6" />
    <p>{{ $title }}</p>
</div>