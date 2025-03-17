<div class="pt-20">
    <div class="grid grid-cols-2 gap-4 auto-rows-auto items-start">
        <div class="relative rounded-2xl p-6 bg-white space-y-8">
            <h1 class="poetsen-one-regular text-[#004972] text-5xl">{{ $excursion->title }}</h1>

            <div wire:ignore class="swiper relative rounded-2xl">
                <span class="absolute top-4 left-4 bg-[#F2F9FB] py-2 px-4 z-10 text-[#004972] text-sm font-bold rounded-4xl">
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
        <div class="relative rounded-2xl p-6 bg-white">
            <p class="poetsen-one-regular text-[#004972] text-lg">Details</p>

            <div class="pt-4 flex flex-col gap-4 text-[#004972] font-medium">
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
                
                <p class="font-bold italic text-sm">*  Possible deviations in terms due to weather conditions.</p>
            </div>

            <hr class="border-none h-[1px] bg-[#E3E3E3] my-4">

            <p class="poetsen-one-regular text-[#004972] text-lg">Rent date</p>

            <div wire:ignore x-data="calendarComponent({{ json_encode($availableDates) }}, '{{ $excursion->id }}')" x-init="initCalendar()" class="flex justify-center mt-5">
                <div x-ref="calendar"></div>
            </div>

            <hr class="border-none h-[1px] bg-[#E3E3E3] mt-8 mb-4">

            <form wire:submit="save">
                <p class="poetsen-one-regular text-[#004972] text-lg">Choose time</p>

                @if (!empty($times))
                    <div class="flex items-center gap-3 mt-5">
                        @foreach ($times as $time)
                            <flux:badge as="button" wire:click="setStartTime('{{ $time }}')" variant="pill"
                                class="!font-bold"
                                :class="$time == $chooseTime ? '!bg-[#004972] !text-[#F2F9FB]' : '!bg-[#F2F9FB] !text-[#01A6CD]'"
                            >
                                {{ $time }}
                            </flux:badge>
                        @endforeach
                    </div>
                @endif

                <input wire:model='chooseTime' type="hidden" />
                <div class="mt-5">
                    @error('chooseTime') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror 
                </div>

                <hr class="border-none h-[1px] bg-[#E3E3E3] mt-8 mb-4">

                <div class="mt-5">
                    <flux:heading class="flex items-center gap-2">
                        <p class="poetsen-one-regular text-[#004972] text-lg">Reservation details</p>

                        <flux:tooltip toggleable position="bottom" class="!bg-white">
                            <flux:button icon="information-circle" size="sm" />

                            <flux:tooltip.content class="max-w-[20rem] space-y-2">
                                <p>For US businesses, enter your 9-digit Employer Identification Number (EIN) without hyphens.</p>
                                <p>For European companies, enter your VAT number including the country prefix (e.g., DE123456789).</p>
                            </flux:tooltip.content>
                        </flux:tooltip>
                    </flux:heading>
                </div>

                <div class="bg-[#F2F9FB] rounded-2xl p-8 mt-5 space-y-8">
                    <div>
                        <div class="flex items-center justify-between gap-11">
                            <div>
                                <p class="text-[#01A6CD] font-bold text-sm">How many adults:</p>
                            </div>
                            <div class="flex items-center gap-1">
                                <flux:button wire:click="updateCount('countAdults', 'decrement')" icon="minus" variant="primary" class="!text-[#01A6CD] !border-[1px] !border-[#D9D9D9] cursor-pointer"></flux:button>
                                <flux:button variant="primary" class="!text-[#01A6CD] !border-[1px] !border-[#D9D9D9]">{{ $countAdults }}</flux:button>
                                <flux:button wire:click="updateCount('countAdults', 'increment')" icon="plus" variant="primary" class="!text-[#01A6CD] !border-[1px] !border-[#D9D9D9] cursor-pointer"></flux:button>
                            </div>
                        </div>
                        @for ($i = 0; $i < $countAdults; $i++)
                            <div class="flex items-center justify-between gap-10 mt-3 text-[#004972] text-sm font-medium">
                                <p>Person {{ $i + 1 }}</p>
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center gap-2">
                                        <label for="adult_eat_meat_{{ $i }}" class="text-sm font-medium text-[#004972]">Meat</label>
                                        <input id="adult_eat_meat_{{ $i }}" type="radio" wire:model="adult_eat.{{ $i }}" value="meat" class="w-4 h-4 text-blue-600">
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <label for="adult_eat_fish_{{ $i }}" class="text-sm font-medium text-[#004972]">Fish</label>
                                        <input id="adult_eat_fish_{{ $i }}" type="radio" wire:model="adult_eat.{{ $i }}" value="fish" class="w-4 h-4 text-blue-600">
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <label for="adult_eat_vege_{{ $i }}" class="text-sm font-medium text-[#004972]">Vege</label>
                                        <input id="adult_eat_vege_{{ $i }}" type="radio" wire:model="adult_eat.{{ $i }}" value="vege" class="w-4 h-4 text-blue-600">
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>

                    <div>
                        <div class="flex items-center justify-between gap-11">
                            <div>
                                <p class="text-[#01A6CD] font-bold text-sm">How many children:</p>
                            </div>
                            <div class="flex items-center gap-1">
                                <flux:button wire:click="updateCount('countChildren', 'decrement')" icon="minus" variant="primary" class="!text-[#01A6CD] !border-[1px] !border-[#D9D9D9] cursor-pointer"></flux:button>
                                <flux:button variant="primary" class="!text-[#01A6CD] !border-[1px] !border-[#D9D9D9]">{{ $countChildren }}</flux:button>
                                <flux:button wire:click="updateCount('countChildren', 'increment')" icon="plus" variant="primary" class="!text-[#01A6CD] !border-[1px] !border-[#D9D9D9] cursor-pointer"></flux:button>
                            </div>
                        </div>
                        @for ($i = 0; $i < $countChildren; $i++)
                            <div class="flex items-center justify-between gap-10 mt-3 text-[#004972] font-medium">
                                <p>Person {{ $i + 1 }}</p>
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center gap-2">
                                        <label for="children_eat_meat_{{ $i }}" class="text-sm font-medium text-[#004972]">Meat</label>
                                        <input id="children_eat_meat_{{ $i }}" type="radio" wire:model="children_eat.{{ $i }}" value="meat" class="w-4 h-4 text-blue-600">
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <label for="children_eat_fish_{{ $i }}" class="text-sm font-medium text-[#004972]">Fish</label>
                                        <input id="children_eat_fish_{{ $i }}" type="radio" wire:model="children_eat.{{ $i }}" value="fish" class="w-4 h-4 text-blue-600">
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <label for="children_eat_vege_{{ $i }}" class="text-sm font-medium text-[#004972]">Vege</label>
                                        <input id="children_eat_vege_{{ $i }}" type="radio" wire:model="children_eat.{{ $i }}" value="vege" class="w-4 h-4 text-blue-600">
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>

                    <div>
                        <div class="flex items-center justify-between gap-11">
                            <div>
                                <p class="work-sans text-[#01A6CD] text-sm"><span class="font-bold">Childrens</span> (under 3 yrs)</p>
                            </div>
                            <div class="flex items-center gap-1">
                                <flux:button wire:click="updateCount('countChildrenUnder', 'decrement')" icon="minus" variant="primary" class="!text-[#01A6CD] !border-[1px] !border-[#D9D9D9] cursor-pointer"></flux:button>
                                <flux:button variant="primary" class="!text-[#01A6CD] !border-[1px] !border-[#D9D9D9]">{{ $countChildrenUnder }}</flux:button>
                                <flux:button wire:click="updateCount('countChildrenUnder', 'increment')" icon="plus" variant="primary" class="!text-[#01A6CD] !border-[1px] !border-[#D9D9D9] cursor-pointer"></flux:button>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="border-none h-[1px] bg-[#E3E3E3] mt-8 mb-4">

                <p class="poetsen-one-regular text-[#004972] text-lg">Info details</p>

                <div class="bg-[#F2F9FB] rounded-2xl p-8 mt-5 space-y-4">
                    <div>
                        <div class="flex items-center justify-between">
                            <p class="text-[#01A6CD] font-bold text-sm">Your email</p>
                            <input type="email" wire:model="email" class="!w-[60%] !border-[1px] !border-[#D9D9D9] bg-white text-sm rounded-lg px-2 py-1" />
                        </div>
                        <div>
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror 
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between">
                            <p class="text-[#01A6CD] font-bold text-sm">Your phone</p>
                            <input type="tel" wire:model="phone" class="!w-[60%] !border-[1px] !border-[#D9D9D9] bg-white text-sm rounded-lg px-2 py-1" />
                        </div>
                        <div>
                            @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror 
                        </div>
                    </div>
                </div>

                <hr class="border-none h-[1px] bg-[#E3E3E3] mt-8 mb-4">

                <div class="flex items-center gap-3 mb-4">
                    <p class="poetsen-one-regular text-[#004972] text-lg">Total</p>
                    <p class="text-[#01A6CD] font-medium text-base">{{ $totalPrice }} €</p>
                </div>

                <button 
                    x-on:click="$dispatch('notice', {type: 'warning', text: 'TEST!!'})"
                    type="submit" 
                    class="uppercase text-white text-sm font-bold rounded-4xl py-2.5 px-6 w-full disabled:cursor-not-allowed disabled:opacity-50" 
                    style="background: linear-gradient(233.75deg, #01A6CD 1.53%, #004972 137.53%);"
                >
                    Book now
                </button>
            </form>

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