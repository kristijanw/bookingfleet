<div>
    <a href="{{ route('cart') }}" class="relative">
        <img src="/img/cart.svg" />
        <span class="bg-[#FBBB0E] rounded-full flex items-center justify-center w-6 h-6 absolute -right-2 top-0 text-[#004972] work-sans font-semibold">
            {{ $content->count() }}
        </span>
    </a>
</div>
