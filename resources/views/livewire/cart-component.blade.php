<div class="pt-14">

    <h1 class="poetsen-one-regular text-white text-5xl">Cart</h1>

    <div class="pt-20 grid grid-cols-12 gap-4 text-[#004972]">
        <div class="col-span-8 rounded-2xl bg-white p-8" style="box-shadow: 8px 12px 44px 8px #00000040;">

            <div class="grid grid-cols-12">
                <div class="col-span-6">
                    <p class="poetsen-one-regular text-xl">Product</p>
                </div>
                <div class="col-span-6">
                    <p class="poetsen-one-regular text-xl">Price</p>
                </div>
            </div>

            <hr class="my-5 border-none h-[1px] bg-[#E3E3E3]">

            @if ($content->count() > 0)
                <div class="space-y-7">
                    @foreach ($content as $id => $item)
                        <div class="grid grid-cols-12 relative border-b-[1px] border-[#E3E3E3] pb-5">
                            <div class="col-span-6 flex flex-col gap-4 relative">
                                <p class="poetsen-one-regular text-base">{{ $item->get('name') }}</p>
    
                                <div class="text-base font-medium">
                                    <p><span class="text-[#01A6CD] inline-block w-28">Trip day:</span> {{ $item->get('options')['date']->format('d.m.Y') }}</p>
                                    <p><span class="text-[#01A6CD] inline-block w-28">Start time:</span> {{ $item->get('options')['chooseTime'] }} h</p>
                                    <p><span class="text-[#01A6CD] inline-block w-28">Location:</span> {{ $item->get('options')['location'] }}</p>
                                </div>
                            </div>

                            <div class="col-span-6 text-base font-medium pt-9">
                                <p>{{ $item->get('options')['countAdults'] }} person x {{ $item->get('options')['price'] }} €</p>
                                @php
                                    $groupedEats = array_count_values($item->get('options')['adult_eat'] ?? []);
                                @endphp
                                <div class="pl-4">
                                    @foreach ($groupedEats as $eat => $count)
                                        <p class="text-[#01A6CD]">{{ $count }}x {{ ucfirst($eat) }}</p>
                                    @endforeach
                                </div>
                                
                                @if (isset($item->get('options')['countChildren']) && $item->get('options')['countChildren'] > 0)
                                    @php
                                        $discountRate = 1 - ($item->get('options')['childrenPrice'] / 100);
                                    @endphp
                                    <p>{{ $item->get('options')['countChildren'] }} children x {{ $item->get('options')['price'] * $discountRate }} €</p>
                                    @php
                                        $groupedEatsChildren = array_count_values($item->get('options')['children_eat'] ?? []);
                                    @endphp
                                    <div class="pl-4">
                                        @foreach ($groupedEatsChildren as $eatC => $countC)
                                            <p class="text-[#01A6CD]">{{ $countC }}x {{ ucfirst($eatC) }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
    
                            <button wire:click="removeFromCart('{{ $id }}')" class="absolute right-0 cursor-pointer">
                                <flux:icon.trash class="text-red-500" />
                            </button>
                        </div>
                    @endforeach
                </div>

                <div class="pt-10">
                    @if(empty($usedCoupon))
                        <form wire:submit="applyCoupon" class="flex items-center gap-3">
                            <p class="poetsen-one-regular text-xl">Coupon</p>
                            <flux:input wire:model="coupon" />
                            <flux:button type="submit" variant="primary" class="disabled:cursor-not-allowed disabled:opacity-50 uppercase border-none !rounded-4xl" style="background: linear-gradient(233.75deg, #01A6CD 1.53%, #004972 137.53%);">
                                Apply coupon
                            </flux:button>
                        </form>
                        @error('coupon') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    @else
                        <div class="flex items-center gap-3">
                            <p class="poetsen-one-regular text-xl">Coupon</p>
                            <flux:input disabled value="{{ $usedCoupon['code'] }}" />
                            <flux:button wire:click='removeCoupon' variant="danger" class="uppercase border-none !rounded-4xl">
                                Remove coupon
                            </flux:button>
                        </div>
                        <div class="text-green-500 text-sm mt-2">
                            Coupon has been successfully applied.
                        </div>
                    @endif
                </div>
            @else
                <p class="text-3xl text-center mb-2">cart is empty!</p>
            @endif
        </div>

        <div class="col-span-4 rounded-2xl bg-[#DCFAFF] p-8 h-fit">
            <p class="poetsen-one-regular text-[#004972] text-2xl">Cart</p>

            <div class="pt-10 text-base">
                <div class="flex items-start justify-between">
                    <p class="text-[#01A6CD] font-bold">Subtotal:</p>
                    <div class="text-[#004972] text-right font-bold">
                        @foreach ($content as $id => $item)
                            <div>
                                <p class="font-medium">{{ $item->get('options')['countAdults'] }} person x {{ $item->get('options')['price'] }} €</p>
                                @if (isset($item->get('options')['countChildren']) && $item->get('options')['countChildren'] > 0)
                                    @php
                                        $discountRate = 1 - ($item->get('options')['childrenPrice'] / 100);
                                    @endphp
                                    <p class="font-medium">{{ $item->get('options')['countChildren'] }} children x {{ $item->get('options')['price'] * $discountRate }} €</p>
                                @endif

                                @if ($item->get('options')['skipper'] == 'yes')
                                    <p class="font-medium">Skipper x {{ $item->get('options')['skipperPrice'] }} €</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="flex items-start justify-between border-y-[1px] border-[#E3E3E3] py-3 my-2">
                    <p class="text-[#01A6CD] font-bold">Total:</p>
                    <p class="text-[#004972] font-bold">{{ $total }} €</p>
                </div>
                <button class="w-full mt-4 rounded-4xl py-3.5 px-6 text-white uppercase font-bold" style="background: linear-gradient(233.75deg, #01A6CD 1.53%, #004972 137.53%);">
                    Proceed to checkout
                </button>
            </div>
        </div>
    </div>
</div>