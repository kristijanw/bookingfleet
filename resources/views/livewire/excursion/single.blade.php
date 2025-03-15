<div class="pt-20">
    <div class="grid grid-cols-2 gap-4 auto-rows-auto items-start">
        <div class="relative rounded-2xl p-8 bg-white space-y-8">
            <h1 class="poetsen-one-regular text-[#004972] text-5xl">{{ $excursion->title }}</h1>

            <div wire:ignore class="swiper relative rounded-2xl">
                <span class="absolute top-4 left-4 bg-[#F2F9FB] py-2 px-4 z-10 text-[#004972] text-sm font-bold work-sans rounded-4xl">
                    {{ $excursion->category->title }}
                </span>
                <div class="swiper-wrapper">
                    @foreach ($excursion->gallery as $img)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage') . '/' . $img }}" class="w-full h-[400px] object-cover" />
                        </div>
                    @endforeach
                </div>
    
                <!-- Custom Strelice -->
                <div class="swiper-button-prev after:!text-xl !text-gray-700 !bg-white !rounded-full !w-10 !h-10 !flex !items-center !justify-center shadow-md"></div>
                <div class="swiper-button-next after:!text-xl !text-gray-700 !bg-white !rounded-full !w-10 !h-10 !flex !items-center !justify-center shadow-md"></div>
            </div>

            <p>{!! $excursion->description !!}</p>
        </div>
        <div class="relative rounded-2xl p-8 bg-white">
            <p class="poetsen-one-regular text-[#004972] text-lg">Details</p>

            <div class="pt-4 flex flex-col gap-4 text-[#004972] work-sans font-medium">
                <div class="flex items-center gap-2">
                    <img src="/img/globe.svg" />
                    <span class="text-[#01A6CD] font-bold">Departure:</span> Beach Center
                </div>
                <div class="flex items-center gap-2">
                    <img src="/img/clock.svg" />
                    <span class="text-[#01A6CD] font-bold">Duration:</span> 4 hours
                </div>
                <div class="flex items-center gap-2">
                    <img src="/img/boat.svg" />
                    <span class="text-[#01A6CD] font-bold">Boat capacity:</span> {{ $excursion->boat_capacity }} seats
                </div>
                <div class="flex flex-col items-start">
                    <div class="flex items-center gap-2">
                        <img src="/img/included.svg" />
                        <span class="text-[#01A6CD] font-bold">Included:</span>
                    </div>
                    <div class="pl-8">
                        @foreach ($excursion->included_in_price as $incl)
                            <p>{{ $incl }}</p>
                        @endforeach
                    </div>
                </div>
            </div>

            <hr class="border-none h-[1px] bg-[#E3E3E3] my-4">

            <p class="poetsen-one-regular text-[#004972] text-lg">Rent date</p>

            <div wire:ignore x-data="calendarComponent({{ json_encode($availableDates) }}, '{{ $excursion->id }}')" x-init="initCalendar()" class="flex justify-center mt-5">
                <div x-ref="calendar"></div>
            </div>

            <hr class="border-none h-[1px] bg-[#E3E3E3] mt-8 mb-4">

            <p class="poetsen-one-regular text-[#004972] text-lg">Choose time</p>

            @if (!empty($times))
                <div class="flex items-center gap-3">
                    @foreach ($times as $time)
                        <flux:badge variant="solid" color="lime">{{ $time }}</flux:badge>
                    @endforeach
                </div>
            @endif
            
        </div>
    </div>    
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (typeof Swiper !== "undefined" && !window.swiperInitialized) {
            window.swiperInitialized = true;
            new Swiper(".swiper", {
                loop: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        }
    });

    function calendarComponent(availableDates, excursionId) {
        return {
            availableDates: availableDates,
            excursionId: excursionId,
            initCalendar() {
                // Provjera da li je kalendar već inicijaliziran
                if (this.$refs.calendar._flatpickr) return;

                let firstAvailableDate = this.availableDates.length > 0 ? this.availableDates[0] : null;

                let fp = flatpickr(this.$refs.calendar, {
                    locale: 'en',
                    inline: true,
                    enable: this.availableDates,
                    dateFormat: "Y-m-d",
                    onDayCreate: function(dObj, dStr, fp, dayElem) {
                        let date = fp.formatDate(dayElem.dateObj, "Y-m-d");
                        
                        if (availableDates.includes(date)) {
                            dayElem.classList.add('available-date');
                        }
                    },
                    onChange: (selectedDates, dateStr, instance) => {
                        Livewire.dispatch('fetchStartTime', { datum: dateStr, id: this.excursionId });
                    }
                });

                if (firstAvailableDate) {
                    fp.jumpToDate(firstAvailableDate);
                }
            }
        };
    }
</script>