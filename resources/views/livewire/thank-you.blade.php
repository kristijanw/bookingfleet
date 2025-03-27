<div class="pt-14">

    <h1 class="poetsen-one-regular text-white text-5xl">Wohoo!</h1>

    <div class="mt-20 rounded-full py-4 px-10 max-w-[900px] mx-auto bg-white flex items-center justify-between" style="box-shadow: 8px 12px 44px 8px #00000040;">
        <div class="flex items-center gap-2">
            <img src="/img/thankyouicon.svg" />
            <p class="text-[#004972] font-medium text-lg">Successfully purchased! You will </p>
        </div>

        <div>
            <flux:button 
                href="{{ route('home') }}"
                class="uppercase text-[#111827] w-full !font-bold text-sm !border-[1px] !border-[#58B6E7] py-3.5 px-6 !rounded-4xl"
            >
                go to homepage
            </flux:button>
        </div>
    </div>
</div>