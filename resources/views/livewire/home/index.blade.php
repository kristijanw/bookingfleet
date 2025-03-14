<div>
    <div class="pt-10">
        <h1 class="text-6xl font-normal poetsen-one-regular text-white" style="text-shadow: 8px 12px 44px rgba(0, 0, 0, 0.25), 3px 3px 0px #FBBB0E;">
            Your Croatian Adventure
        </h1>
        <h1 class="text-6xl font-normal poetsen-one-regular text-[#FBBB0E]">starts here!</h1>
    
        <p class="text-white font-bold text-lg pt-6 max-w-lg">
            Discover Croatia's stunning coastline with our wide range of water activities. <span class="text-[#FBBB0E]">Choose your experience!</span>
        </p>
    </div>
    
    <div class="pt-10 flex items-center gap-1.5 flex-wrap">
        @foreach (App\Models\Category::orderBy('order_column', 'asc')->get() as $cat)
            <x-ui.category wire:key="{{ $cat->id }}" :title="$cat->title" :icon="$cat->image" />
        @endforeach
    </div>
    
    <div class="pt-10 grid grid-cols-2 gap-10">
        <x-ui.card id="1" category="Boat excursion" image_url="/img/test.jpg" title="Private boat tour" departure="Rijeka" price="40" />
        <x-ui.card id="1" category="Boat excursion" image_url="/img/test.jpg" title="Private boat tour" departure="Rovinj" price="55" />
    </div>
    
    <div class="pt-10 grid grid-cols-3 gap-8">
        <x-ui.card id="1" category="Boat excursion" image_url="/img/test1.jpg" title="Private boat tour" departure="Rijeka" price="40" />
        <x-ui.card id="1" category="Boat excursion" image_url="/img/test1.jpg" title="Private boat tour" departure="Rovinj" price="55" />
        <x-ui.card id="1" category="Boat excursion" image_url="/img/test1.jpg" title="Private boat tour" departure="Pula" price="60" />
    </div>
</div>