@props([
    'title',
    'icon'
])

<div tabindex="0" class="group bg-[#F2F9FBBF] cursor-pointer text-[#004972] font-normal poetsen-one-regular flex items-center gap-2 py-5 px-6 rounded-xl transition-all duration-300 hover:bg-[#004972] hover:text-[#F2F9FB] focus:bg-[#004972] focus:text-[#F2F9FB] outline-none">
    <div class="transition-all duration-300 bg-[#004972] group-hover:bg-[#F2F9FB] group-focus:bg-[#F2F9FB]" style="
        min-width: 40px;
        height: 25px;
        mask: url({{ asset('storage') . '/' . $icon }}) no-repeat center / contain !important;
        -webkit-mask: url({{ asset('storage') . '/' . $icon }}) no-repeat center / contain !important;
    "></div>
    <p>{{ $title }}</p>
</div>
