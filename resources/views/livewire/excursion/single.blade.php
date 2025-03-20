<div class="pt-20">
    <div class="grid grid-cols-2 gap-4 auto-rows-auto items-start">
        <div class="relative rounded-2xl p-6 bg-white space-y-8">
            <h1 class="poetsen-one-regular text-[#004972] text-5xl">{{ $excursion->title }}</h1>

            <div class="relative">
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
                    <div class="swiper-button-prev after:!text-xl !text-white !bg-transparent !rounded-full !w-10 !h-10 !flex !items-center !justify-center shadow-md"></div>
                    <div class="swiper-button-next after:!text-xl !text-white !bg-transparent !rounded-full !w-10 !h-10 !flex !items-center !justify-center shadow-md"></div>
                </div>

                <div class="absolute bottom-5 -right-4 z-10 rounded-xl p-3.5 flex flex-col items-start gap-0 text-[#004972] poetsen-one-regular text-base" style="background: linear-gradient(105.06deg, #FBBB0E 34.41%, #F2A20E 100.37%);">
                    <span>From</span>
                    <span class="text-4xl">{{ $excursion->price }}<sup>€</sup></span>
                    <span>per person</span>
                </div>
            </div>

            <p>{!! $excursion->description !!}</p>
        </div>
        <div class="relative rounded-2xl p-6 bg-white">
            <p class="poetsen-one-regular text-[#004972] text-lg">Details</p>

            <div class="pt-4 flex flex-col gap-4 text-[#004972] font-medium">
                <div class="flex items-center gap-2">
                    <img src="/img/globe.svg" />
                    <span class="text-[#01A6CD] font-bold">Departure:</span>
                    <a class="underline" href="{{ $excursion->google_maps_url }}" target="_blank">{{ $excursion->departure ?? 'None' }}</a>
                </div>
                <div class="flex items-center gap-2">
                    <img src="/img/clock.svg" />
                    <span class="text-[#01A6CD] font-bold">Duration:</span> {{ $excursion->duration ?? '0' }} hours
                </div>
                <div class="flex items-center gap-2">
                    <img src="/img/boat.svg" />
                    <span class="text-[#01A6CD] font-bold">Boat capacity:</span> {{ $seatAvailable ?? '0' }} seats
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
                
                <p class="font-bold italic text-sm pl-7">*  Possible deviations in terms due to weather conditions.</p>
            </div>

            <hr class="border-none h-[1px] bg-[#E3E3E3] my-4">

            <p class="poetsen-one-regular text-[#004972] text-lg">Rent date</p>

            <div wire:ignore x-data="calendarComponent({{ json_encode($availableDates) }}, '{{ $excursion->id }}')" x-init="initCalendar()" class="flex justify-center mt-3">
                <div x-ref="calendar"></div>
            </div>

            <p class="text-[#004972] font-bold text-sm text-right mt-5">{{ $seatAvailable }} seat avilable</p>

            <hr class="border-none h-[1px] bg-[#E3E3E3] my-4">

            <form wire:submit="save">
                <p class="poetsen-one-regular text-[#004972] text-lg">Choose time</p>

                @if (!empty($times))
                    <div class="flex items-center gap-3 mt-3">
                        @foreach ($times as $time)
                            <flux:badge as="button" wire:click="setStartTime('{{ $time }}')" variant="pill"
                                :class="$time == $chooseTime ? '!bg-[#004972] !text-[#F2F9FB] !font-bold' : '!bg-[#F2F9FB] !text-[#01A6CD] !font-bold'"
                            >
                                {{ $time }}
                            </flux:badge>
                        @endforeach
                    </div>
                @endif

                <input wire:model='chooseTime' type="hidden" />
                @error('chooseTime') <span class="text-red-500 text-sm mt-5">{{ $message }}</span> @enderror 

                <hr class="border-none h-[1px] bg-[#E3E3E3] my-4">

                @if ($excursion->skipper == 'yes')
                    <div class="flex items-center gap-10">
                        <p class="poetsen-one-regular text-[#004972] text-lg">Skipper</p>

                        <flux:radio.group class="flex items-center gap-3">
                            <flux:radio value="yes" label="Yes" wire:click="updateSkipper('yes')" />
                            <flux:radio value="no" label="No" wire:click="updateSkipper('no')" checked  />
                        </flux:radio.group>
                    </div>
                    
                    <hr class="border-none h-[1px] bg-[#E3E3E3] my-4">
                @endif

                <div class="">
                    <flux:heading class="flex items-center gap-2">
                        <p class="poetsen-one-regular text-[#004972] text-lg">Reservation details</p>

                        <flux:tooltip toggleable position="bottom">
                            <flux:button size="sm" class="!bg-white !border-none !text-red-500 !shadow-none !p-0">
                                <img src="/img/information-circle.svg" />
                            </flux:button>


                            <flux:tooltip.content class="max-w-[20rem] space-y-2">
                                @if (!empty($excursion->tooltip_info))
                                    <p>{{ $excursion->tooltip_info }}</p>
                                @else
                                    <p>Person can choose type of meal or no meat at all.</p>
                                    <p>Children have 30% discount</p>
                                    <p>Children under 3 years have 100% discount</p>
                                @endif
                            </flux:tooltip.content>
                        </flux:tooltip>
                    </flux:heading>

                    @if (session('seatAvailable'))
                        <div class="text-red-500 text-sm">
                            {{ session('seatAvailable') }}
                        </div>
                    @endif
                </div>

                <div class="bg-[#F2F9FB] rounded-2xl p-8 mt-3 space-y-8">
                    <div>
                        <div class="flex items-center justify-between gap-11">
                            <div>
                                <p class="text-[#01A6CD] font-bold text-sm">How many adults:</p>
                            </div>
                            <div class="flex items-center gap-1">
                                <flux:button wire:click="updateCount('countAdults', 'decrement')" icon="minus" class="!text-[#01A6CD] !border-[1px] !border-[#D9D9D9] cursor-pointer"></flux:button>
                                <flux:button class="!text-[#01A6CD] !border-[1px] !border-[#D9D9D9]">{{ $countAdults }}</flux:button>
                                <flux:button wire:click="updateCount('countAdults', 'increment')" icon="plus" class="!text-[#01A6CD] !border-[1px] !border-[#D9D9D9] cursor-pointer"></flux:button>
                            </div>
                        </div>
                        @for ($i = 0; $i < $countAdults; $i++)
                            <div class="flex items-center justify-between gap-10 mt-3 text-[#004972] text-sm font-medium">
                                <p>Person {{ $i + 1 }}</p>
                                <flux:radio.group wire:model="adult_eat.{{ $i }}" class="flex items-center gap-3">
                                    <flux:radio value="meat" label="Meat" />
                                    <flux:radio value="fish" label="Fish" checked  />
                                    <flux:radio value="vege" label="Vege"  />
                                </flux:radio.group>
                            </div>
                        @endfor
                    </div>

                    <div>
                        <div class="flex items-center justify-between gap-11">
                            <div>
                                <p class="text-[#01A6CD] font-bold text-sm">How many children:</p>
                            </div>
                            <div class="flex items-center gap-1">
                                <flux:button wire:click="updateCount('countChildren', 'decrement')" icon="minus" class="!text-[#01A6CD] !border-[1px] !border-[#D9D9D9] cursor-pointer"></flux:button>
                                <flux:button class="!text-[#01A6CD] !border-[1px] !border-[#D9D9D9]">{{ $countChildren }}</flux:button>
                                <flux:button wire:click="updateCount('countChildren', 'increment')" icon="plus" class="!text-[#01A6CD] !border-[1px] !border-[#D9D9D9] cursor-pointer"></flux:button>
                            </div>
                        </div>
                        @for ($i = 0; $i < $countChildren; $i++)
                            <div class="flex items-center justify-between gap-10 mt-3 text-[#004972] font-medium">
                                <p>Person {{ $i + 1 }}</p>
                                <flux:radio.group wire:model="children_eat.{{ $i }}" class="flex items-center gap-3">
                                    <flux:radio value="meat" label="Meat" />
                                    <flux:radio value="fish" label="Fish" checked  />
                                    <flux:radio value="vege" label="Vege"  />
                                </flux:radio.group>
                            </div>
                        @endfor
                    </div>

                    <div>
                        <div class="flex items-center justify-between gap-11">
                            <div>
                                <p class="work-sans text-[#01A6CD] text-sm"><span class="font-bold">Childrens</span> (under 3 yrs)</p>
                            </div>
                            <div class="flex items-center gap-1">
                                <flux:button wire:click="updateCount('countChildrenUnder', 'decrement')" icon="minus" class="!text-[#01A6CD] !border-[1px] !border-[#D9D9D9] cursor-pointer"></flux:button>
                                <flux:button class="!text-[#01A6CD] !border-[1px] !border-[#D9D9D9]">{{ $countChildrenUnder }}</flux:button>
                                <flux:button wire:click="updateCount('countChildrenUnder', 'increment')" icon="plus" class="!text-[#01A6CD] !border-[1px] !border-[#D9D9D9] cursor-pointer"></flux:button>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="border-none h-[1px] bg-[#E3E3E3] my-4">

                <p class="poetsen-one-regular text-[#004972] text-lg">Info details</p>

                <div class="bg-[#F2F9FB] rounded-2xl p-8 mt-3 space-y-4">
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

                <hr class="border-none h-[1px] bg-[#E3E3E3] my-4">

                <div class="flex items-center gap-3 mb-4">
                    <p class="poetsen-one-regular text-[#004972] text-lg">Total</p>
                    <p class="text-[#01A6CD] font-medium text-base">{{ $totalPrice }} €</p>
                </div>

                <button 
                    {{-- x-on:click="$dispatch('notice', {type: 'warning', text: 'TEST!!'})" --}}
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
    function calendarComponent(availableDates, excursionId) {
        return {
            availableDates: availableDates,
            excursionId: excursionId,
            initCalendar() {
                if (this.$refs.calendar._flatpickr) return;

                let firstAvailableDate = this.availableDates != null && this.availableDates.length > 0 ? this.availableDates[0] : null;

                let fp = flatpickr(this.$refs.calendar, {
                    locale: 'en',
                    inline: true,
                    enable: this.availableDates && this.availableDates.length > 0 ? this.availableDates : [],
                    dateFormat: "Y-m-d",
                    onDayCreate: function(dObj, dStr, fp, dayElem) {
                        let date = fp.formatDate(dayElem.dateObj, "Y-m-d");
                        
                        if (availableDates != null && availableDates.includes(date)) {
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