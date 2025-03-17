<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="apple-mobile-web-app-status-bar" content="#01d679">
        <meta name="apple-mobile-web-app-capable" content="yes">

        <title>{{ $title ?? 'Page Title' }}</title>

        <link rel="manifest" href="/manifest.json">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <link rel="apple-touch-icon" sizes="16x16" href="/img/AppImages/ios/16.png">
        <link rel="apple-touch-icon" sizes="20x20" href="/img/AppImages/ios/20.png">
        <link rel="apple-touch-icon" sizes="29x29" href="/img/AppImages/ios/29.png">
        <link rel="apple-touch-icon" sizes="32x32" href="/img/AppImages/ios/32.png">
        <link rel="apple-touch-icon" sizes="40x40" href="/img/AppImages/ios/40.png">
        <link rel="apple-touch-icon" sizes="50x50" href="/img/AppImages/ios/50.png">
        <link rel="apple-touch-icon" sizes="57x57" href="/img/AppImages/ios/57.png">
        <link rel="apple-touch-icon" sizes="58x58" href="/img/AppImages/ios/58.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/img/AppImages/ios/60.png">
        <link rel="apple-touch-icon" sizes="64x64" href="/img/AppImages/ios/64.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/img/AppImages/ios/72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/img/AppImages/ios/76.png">
        <link rel="apple-touch-icon" sizes="80x80" href="/img/AppImages/ios/80.png">
        <link rel="apple-touch-icon" sizes="87x87" href="/img/AppImages/ios/87.png">
        <link rel="apple-touch-icon" sizes="100x100" href="/img/AppImages/ios/100.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/img/AppImages/ios/114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/img/AppImages/ios/120.png">
        <link rel="apple-touch-icon" sizes="128x128" href="/img/AppImages/ios/128.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/img/AppImages/ios/144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/img/AppImages/ios/152.png">
        <link rel="apple-touch-icon" sizes="167x167" href="/img/AppImages/ios/167.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/img/AppImages/ios/180.png">
        <link rel="apple-touch-icon" sizes="192x192" href="/img/AppImages/ios/192.png">
        <link rel="apple-touch-icon" sizes="256x256" href="/img/AppImages/ios/256.png">
        <link rel="apple-touch-icon" sizes="512x512" href="/img/AppImages/ios/512.png">
        <link rel="apple-touch-icon" sizes="1024x1024" href="/img/AppImages/ios/1024.png">

        <link href="/img/AppImages/ios/1024.png" sizes="1024x1024" rel="apple-touch-startup-image">
        <link href="/img/AppImages/ios/512.png" sizes="512x512" rel="apple-touch-startup-image">
        <link href="/img/AppImages/ios/256.png" sizes="256x256" rel="apple-touch-startup-image">
        <link href="/img/AppImages/ios/192.png" sizes="192x192" rel="apple-touch-startup-image">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        @fluxAppearance

        <style>
            .poetsen-one-regular {
                font-family: "Poetsen One", sans-serif;
                font-weight: 400;
                font-style: normal;
            }
            .work-sans {
                font-family: "Work Sans", sans-serif;
            }
        </style>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    </head>
    <body class="bg-[#F2F9FB] relative text-[#1b1b18] flex py-6 lg:py-8 items-center lg:justify-center min-h-screen flex-col">
        <div class="absolute top-0 left-0 w-full h-[70vh] -z-10">
            <img src="{{ $headerImg }}" class="w-full h-full object-cover" />
            <div class="absolute top-0 left-0 right-0 -bottom-[1px] bg-gradient-to-t from-[#F2F9FB] via-transparent to-transparent"></div>
        </div>

        <header class="w-full lg:max-w-[952px] max-w-[335px] text-sm mb-6">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}">
                    <img src="/img/logo.svg" />
                </a>

                <a href="#" class="relative">
                    <img src="/img/cart.svg" />
                    <span class="bg-[#FBBB0E] rounded-full py-1 px-2.5 absolute -right-3 top-0 text-[#004972] work-sans font-semibold">0</span>
                </a>
            </div>
        </header>

        <div class="w-full lg:max-w-[952px] max-w-[335px] transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
            <main class="flex w-full flex-col">
                {{ $slot }}
            </main>
        </div>

        <footer class="w-full lg:max-w-[952px] max-w-[335px] pt-20">
            <div class="flex items-center justify-center gap-10">
                <img src="/img/footerlogo.svg" />
                <p class="text-[#004972] work-sans font-medium text-sm w-[328px]">
                    Discover Croatia's stunning coastline with our wide range of water activities. <span class="text-[#FBBB0E]">Choose your experience!</span>
                </p>
            </div>

            <div class="pt-16 flex items-center justify-center gap-4">
                <img src="/img/payment-icons/image-1.svg" />
                <img src="/img/payment-icons/image-2.svg" />
                <img src="/img/payment-icons/image-3.svg" />
                <img src="/img/payment-icons/image-4.svg" />
                <img src="/img/payment-icons/image-5.svg" />
                <img src="/img/payment-icons/image-6.svg" />
                <img src="/img/payment-icons/image-7.svg" />
                <img src="/img/payment-icons/image-8.svg" />
                <img src="/img/payment-icons/image-9.svg" />
                <img src="/img/payment-icons/image-10.svg" />
            </div>

            <hr class="bg-[#E3E3E3] mt-20 mb-5 border-none h-[1px]">
            <div class="flex items-center justify-between w-full">
                <p class="text-[#004972] font-medium work-sans text-sm">All right reserved ©2025 Booking fleet</p>
                <p class="text-[#004972] font-medium work-sans text-sm">Created by: PROSPEKT</p>
            </div>
        </footer>

        @vite(['resources/js/app.js'])

        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://npmcdn.com/flatpickr/dist/l10n/en.js"></script>

        @fluxScripts
    </body>
</html>
