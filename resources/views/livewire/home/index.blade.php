<div>
    <div class="pt-10">

        @if(session('qrcode-success'))
            <div 
                x-data="{ show: true }" 
                x-init="setTimeout(() => show = false, 3000)" 
                x-show="show" 
                x-transition 
                class="bg-green-500 text-white p-4 rounded-lg mb-4"
            >
                {{ session('qrcode-success') }}
            </div>
        @endif

        @if(session('qrcode-error'))
            <div 
                x-data="{ show: true }" 
                x-init="setTimeout(() => show = false, 3000)" 
                x-show="show" 
                x-transition 
                class="bg-red-500 text-white p-4 rounded-lg mb-4"
            >
                {{ session('qrcode-error') }}
            </div>
        @endif

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
            <x-ui.category wire:key="{{ $cat->id }}" :id="$cat->id" :title="$cat->title" :icon="$cat->image" />
        @endforeach
    </div>
    
    <div x-cloak x-show="@json(App\Models\Excursion::count() > 0)">
        <div class="pt-10 grid grid-cols-2 gap-10">
            @foreach (App\Models\Excursion::with('category')->orderBy('created_at', 'desc')->limit(2)->get() as $excursion)
                <x-ui.card 
                    id="{{ $excursion->id }}" 
                    category="{{ $excursion->category->title }}" 
                    title="{{ $excursion->title }}" 
                    departure="{{ $excursion->departure ?? 'test' }}" 
                    price="{{ $excursion->price }}" 
                    :gallery="$excursion->gallery" 
                />
            @endforeach
        </div>
    </div>
    
    <div x-cloak x-show="@json(App\Models\Excursion::count() > 2)">
        <div class="pt-10 grid grid-cols-3 gap-8">
            @foreach (App\Models\Excursion::with('category')->orderBy('created_at', 'desc')->skip(2)->limit(3)->get() as $excursion)
                <x-ui.card 
                    id="{{ $excursion->id }}" 
                    category="{{ $excursion->category->title }}" 
                    title="{{ $excursion->title }}" 
                    departure="{{ $excursion->departure ?? 'test' }}" 
                    price="{{ $excursion->price }}" 
                    :gallery="$excursion->gallery" 
                />
            @endforeach
        </div>
    </div>
</div>