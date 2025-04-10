<div>
    <div class="pt-10">
        <h1 class="text-6xl font-normal poetsen-one-regular text-white" style="text-shadow: 8px 12px 44px rgba(0, 0, 0, 0.25), 3px 3px 0px #FBBB0E;">
            Your boat excursions
        </h1>
    </div>
    
    <div wire:ignore class="pt-10 flex items-center gap-1.5 flex-wrap">
        @foreach (App\Models\Category::orderBy('order_column', 'asc')->get() as $cat)
            <x-ui.category wire:key="{{ $cat->id }}" :id="$cat->id" :title="$cat->title" :icon="$cat->image" />
        @endforeach
    </div>

    <div class="grid grid-cols-12 gap-8 pt-28">

        <!-- FILTERS -->
        <div class="col-span-3 space-y-3">
            <div 
                x-data="{
                    selected: null
                }"
                goo="fade-up" 
                goo-type="standard" 
                class="bg-white rounded-xl py-4 px-6"
            >
                <p 
                    class="flex items-center justify-between font-medium text-base text-[#004972] cursor-pointer"
                    @click="selected !== 1 ? selected = 1 : selected = null"
                >
                    Location <flux:icon.plus class="size-4" />
                </p>

                <div 
                    wire:ignore.self
                    class="relative overflow-hidden transition-all duration-300 max-h-0"
                    x-ref="container1"
                    x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''"
                >
                    <div class="pt-5">
                        @forelse ($categories as $key => $cat)
                            <p 
                                wire:click="setLocation('{{ $cat }}')" 
                                class="cursor-pointer text-lg {{ $location == $cat ? 'text-[#F2A20E] font-bold' : 'font-normal' }}"
                            >
                                {{ $cat }}
                            </p>
                        @empty
                            <p>Empty</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div 
                x-data="{
                    selected: null
                }" 
                goo="fade-up" 
                goo-type="standard" 
                class="bg-white rounded-xl py-4 px-6"
            >
                <p 
                    class="flex items-center justify-between font-medium text-base text-[#004972] cursor-pointer"
                    @click="selected !== 2 ? selected = 2 : selected = null"
                >
                    Price <flux:icon.plus class="size-4" />
                </p>

                <div 
                    wire:ignore.self
                    class="relative overflow-hidden transition-all duration-300 max-h-0"
                    x-ref="container2"
                    x-bind:style="selected == 2 ? 'max-height: ' + $refs.container2.scrollHeight + 'px' : ''"
                >
                    <div class="flex items-center space-x-2 pt-5">
                        <flux:button 
                            wire:click="decreasePrice" 
                            :loading="false"
                            icon="minus" 
                            class="!text-[#01A6CD] !border-[1px] !border-[#D9D9D9] cursor-pointer !h-7">
                        </flux:button>

                        <input 
                            type="range" 
                            min="0" 
                            max="1000" 
                            step="5" 
                            wire:model.lazy="rangePrice"
                            class="w-full h-2 bg-[#FBBB0E] accent-[#1d7792] rounded-lg appearance-none cursor-pointer"
                        >

                        <flux:button 
                            wire:click="increasePrice" 
                            :loading="false"
                            icon="plus" 
                            class="!text-[#01A6CD] !border-[1px] !border-[#D9D9D9] cursor-pointer !h-7">
                        </flux:button>
                    </div>
                    <p class="text-center font-bold text-[#004972]">{{ $rangePrice }} €</p>
                </div>
            </div>

            <div>
                <flux:button wire:click="resetFilters" size="sm" class="!rounded-4xl cursor-pointer !py-5 !text-[#111827] !font-bold !text-sm w-full uppercase" >
                    reset filter
                </flux:button>
            </div>
        </div>

        <!-- LIST EXCURSIONS -->
        <div class="col-span-9 grid grid-cols-2 gap-8">
            @forelse($excursions as $excursion)
                <x-ui.card 
                    id="{{ $excursion->id }}" 
                    category="{{ $excursion->category->title }}" 
                    title="{{ $excursion->title }}" 
                    departure="{{ $excursion->departure ?? 'test' }}" 
                    price="{{ $excursion->price }}" 
                    :gallery="$excursion->gallery" 
                />
            @empty
                <p>No found</p>
            @endforelse
        </div>
    </div>
</div>
