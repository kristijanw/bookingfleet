<div class="pt-14">

    <h1 class="poetsen-one-regular text-[#004972] text-5xl">Cart</h1>

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
                        <div class="flex flex-col gap-4 relative border-b-[1px] border-[#E3E3E3] pb-5">
                            <p class="poetsen-one-regular text-lg">{{ $item->get('name') }}</p>

                            <div class="text-lg font-medium">
                                <p><span class="text-[#01A6CD] inline-block w-24">Trip day:</span> {{ $item->get('options')['date']->format('d.m.Y') }}</p>
                                <p><span class="text-[#01A6CD] inline-block w-24">Start time:</span> {{ $item->get('options')['chooseTime'] }} h</p>
                            </div>

                            <p class="text-[#004972] font-bold text-lg absolute right-0 bottom-5">{{ $item->get('price') }} €</p>

                            <button wire:click="removeFromCart('{{ $id }}')" class="absolute right-0 cursor-pointer">
                                <flux:icon.trash class="text-red-500" />
                            </button>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-3xl text-center mb-2">cart is empty!</p>
            @endif
        </div>

        <div class="col-span-4 rounded-2xl bg-[#DCFAFF] p-8">
            <p class="poetsen-one-regular text-[#004972] text-2xl">Cart</p>

            <div class="pt-10">
                <div class="flex items-center justify-between">
                    <p class="text-[#01A6CD] font-bold text-lg">Total:</p>
                    <p class="text-[#004972] font-bold text-lg">{{ $total }}</p>
                </div>
            </div>
        </div>
    </div>
</div>