@props([
    'id',
    'category',
    'title',
    'departure',
    'price',
    'gallery'
])

<a 
    href="{{ route('excursion', $id) }}" 
    class="h-[485px] rounded-xl relative" 
    style="
        box-shadow: 8px 12px 44px 8px #00000040;
    "
>
    <div class="w-full h-full overflow-hidden rounded-xl">
        <div class="swiper relative w-full h-full">
            <div class="swiper-wrapper">
                @foreach ($gallery as $img)
                    <div class="swiper-slide relative">
                        <div 
                            class="absolute top-0 left-0 h-full w-full z-10"
                            style="background: linear-gradient(180deg, rgba(0, 39, 62, 0) 55.26%, rgba(0, 39, 62, 0.8) 89.07%);"
                        ></div>
                        <img src="{{ asset('storage') . '/' . $img }}" class="w-full h-full object-cover" style="background: linear-gradient(180deg, rgba(0, 39, 62, 0) 55.26%, rgba(0, 39, 62, 0.8) 89.07%);" />
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-prev after:!text-xl !text-white !bg-transparent !rounded-full !w-10 !h-10 !flex !items-center !justify-center shadow-md"></div>
            <div class="swiper-button-next after:!text-xl !text-white !bg-transparent !rounded-full !w-10 !h-10 !flex !items-center !justify-center shadow-md"></div>
            
            <span class="bg-[#F2F9FB] z-10 py-2 px-4 text-[#004972] absolute top-6 left-5 text-sm font-bold work-sans rounded-4xl">{{ $category }}</span>
    
            <div class="max-w-[65%] z-10 absolute bottom-6 left-6">
                <p class="text-[#FBBB0E] font-semibold italic text-base work-sans">Experience</p>
                <p class="text-white font-semibold text-3xl poetsen-one-regular">{{ $title }}</p>
                <hr class="bg-[#F2F9FB] w-12 my-2 border-none h-[1px]">
                <p class="work-sans text-sm font-medium text-white">Departure: <span class="text-[#FBBB0E]">{{ $departure }}</span></p>
            </div>
        </div>
    </div>

    <div class="absolute z-50 bottom-6 -right-5 rounded-xl p-3.5 flex flex-col items-start gap-0 text-[#004972] poetsen-one-regular text-base" style="background: linear-gradient(105.06deg, #FBBB0E 34.41%, #F2A20E 100.37%);">
        <span>From</span>
        <span class="text-4xl">{{ $price }}<sup>€</sup></span>
        <span>per person</span>
    </div>
</a>