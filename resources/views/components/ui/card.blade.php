@props([
    'id',
    'category',
    'title',
    'departure',
    'price',
    'image_url'
])

<a 
    href="{{ route('excursion', $id) }}" 
    class="bg-red-500 rounded-xl h-[485px] py-6 px-5 relative" 
    style="
        box-shadow: 8px 12px 44px 8px #00000040; 
        background: linear-gradient(180deg, rgba(0, 39, 62, 0) 55.26%, rgba(0, 39, 62, 0.8) 89.07%), url('{{ asset('storage/' . $image_url) }}'); 
        background-size: cover; 
        background-position: center;"
>
    <div class="flex flex-col items-start justify-between h-full">
        <span class="bg-[#F2F9FB] py-2 px-4 text-[#004972] text-sm font-bold work-sans rounded-4xl">{{ $category }}</span>

        <div class="max-w-[70%]">
            <p class="text-[#FBBB0E] font-semibold italic text-base work-sans">Experience</p>
            <p class="text-white font-semibold text-3xl poetsen-one-regular">{{ $title }}</p>
            <hr class="bg-[#F2F9FB] w-12 my-2 border-none h-[1px]">
            <p class="work-sans text-sm font-medium text-white">Departure: <span class="text-[#FBBB0E]">{{ $departure }}</span></p>
        </div>

        <div class="absolute bottom-5 -right-5 rounded-xl p-3.5 flex flex-col items-start gap-0 text-[#004972] poetsen-one-regular text-base" style="background: linear-gradient(105.06deg, #FBBB0E 34.41%, #F2A20E 100.37%);">
            <span>From</span>
            <span class="text-4xl">{{ $price }}<sup>€</sup></span>
            <span>per person</span>
        </div>
    </div>
</a>