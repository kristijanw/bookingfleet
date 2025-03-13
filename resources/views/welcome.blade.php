<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Booking Fleet</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

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
    </head>
    <body class="bg-[#F2F9FB] relative text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <img src="/img/bgheader.jpg" class="absolute w-full top-0 -z-10" />

        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6">
            <img src="/img/logo.svg" />
        </header>
        <div class="w-full lg:max-w-4xl max-w-[335px] transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
            <main class="flex w-full flex-col">
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
                    <div class="bg-[#F2F9FBBF] text-[#004972] font-normal poetsen-one-regular flex items-center gap-2 py-5 px-8 rounded-xl">
                        <img src="/img/other.svg" class="w-6" />
                        <p>View all</p>
                    </div>
                    <div class="bg-[#F2F9FBBF] text-[#004972] font-normal poetsen-one-regular flex items-center gap-2 py-5 px-8 rounded-xl">
                        <img src="/img/other.svg" class="w-6" />
                        <p>View all</p>
                    </div>
                    <div class="bg-[#F2F9FBBF] text-[#004972] font-normal poetsen-one-regular flex items-center gap-2 py-5 px-8 rounded-xl">
                        <img src="/img/other.svg" class="w-6" />
                        <p>View all</p>
                    </div>
                    <div class="bg-[#F2F9FBBF] text-[#004972] font-normal poetsen-one-regular flex items-center gap-2 py-5 px-8 rounded-xl">
                        <img src="/img/other.svg" class="w-6" />
                        <p>View all</p>
                    </div>
                    <div class="bg-[#F2F9FBBF] text-[#004972] font-normal poetsen-one-regular flex items-center gap-2 py-5 px-8 rounded-xl">
                        <img src="/img/other.svg" class="w-6" />
                        <p>View all</p>
                    </div>
                    <div class="bg-[#F2F9FBBF] text-[#004972] font-normal poetsen-one-regular flex items-center gap-2 py-5 px-8 rounded-xl">
                        <img src="/img/other.svg" class="w-6" />
                        <p>View all</p>
                    </div>
                </div>

                <div class="pt-10 grid grid-cols-2 gap-10">
                    <div class="bg-red-500 rounded-xl h-[485px] py-6 px-5 relative" style="background: linear-gradient(180deg, rgba(0, 39, 62, 0) 55.26%, rgba(0, 39, 62, 0.8) 89.07%), url('/img/test.jpg'); background-size: cover; background-position: center;">
                        <div class="flex flex-col items-start justify-between h-full">
                            <span class="bg-[#F2F9FB] py-2 px-4 text-[#004972] text-sm font-bold work-sans rounded-4xl">Boat excursion</span>

                            <div>
                                <p class="text-[#FBBB0E] font-semibold italic text-base work-sans">Experience</p>
                                <p class="text-white font-semibold text-3xl poetsen-one-regular">Private boat tour</p>
                                <hr class="bg-[#F2F9FB] w-12 my-2">
                                <p class="work-sans text-sm font-medium text-white">Departure: <span class="text-[#FBBB0E]">Rovinj</span></p>
                            </div>

                            <div class="absolute bottom-5 -right-5 rounded-xl p-3.5 flex flex-col items-start gap-0 text-[#004972] poetsen-one-regular text-base" style="background: linear-gradient(105.06deg, #FBBB0E 34.41%, #F2A20E 100.37%);">
                                <span>From</span>
                                <span class="text-4xl">50<sup>€</sup></span>
                                <span>per person</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-red-500 rounded-xl h-[485px] py-6 px-5 relative" style="background: linear-gradient(180deg, rgba(0, 39, 62, 0) 55.26%, rgba(0, 39, 62, 0.8) 89.07%), url('/img/test.jpg'); background-size: cover; background-position: center;">
                        <div class="flex flex-col items-start justify-between h-full">
                            <span class="bg-[#F2F9FB] py-2 px-4 text-[#004972] text-sm font-bold work-sans rounded-4xl">Boat excursion</span>

                            <div>
                                <p class="text-[#FBBB0E] font-semibold italic text-base work-sans">Experience</p>
                                <p class="text-white font-semibold text-3xl poetsen-one-regular">Private boat tour</p>
                                <hr class="bg-[#F2F9FB] w-12 my-2">
                                <p class="work-sans text-sm font-medium text-white">Departure: <span class="text-[#FBBB0E]">Rovinj</span></p>
                            </div>

                            <div class="absolute bottom-5 -right-5 rounded-xl p-3.5 flex flex-col items-start gap-0 text-[#004972] poetsen-one-regular text-base" style="background: linear-gradient(105.06deg, #FBBB0E 34.41%, #F2A20E 100.37%);">
                                <span>From</span>
                                <span class="text-4xl">50<sup>€</sup></span>
                                <span>per person</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-10 grid grid-cols-3 gap-8">
                    <div class="bg-red-500 rounded-xl h-[485px] py-6 px-5 relative" style="background: linear-gradient(180deg, rgba(0, 39, 62, 0) 55.26%, rgba(0, 39, 62, 0.8) 89.07%), url('/img/test1.jpg'); background-size: cover; background-position: center;">
                        <div class="flex flex-col items-start justify-between h-full">
                            <span class="bg-[#F2F9FB] py-2 px-4 text-[#004972] text-sm font-bold work-sans rounded-4xl">Boat excursion</span>

                            <div class="max-w-[70%]">
                                <p class="text-[#FBBB0E] font-semibold italic text-base work-sans">Experience</p>
                                <p class="text-white font-semibold text-3xl poetsen-one-regular">Private boat tour</p>
                                <hr class="bg-[#F2F9FB] w-12 my-2">
                                <p class="work-sans text-sm font-medium text-white">Departure: <span class="text-[#FBBB0E]">Rovinj</span></p>
                            </div>

                            <div class="absolute bottom-5 -right-5 rounded-xl p-3.5 flex flex-col items-start gap-0 text-[#004972] poetsen-one-regular text-base" style="background: linear-gradient(105.06deg, #FBBB0E 34.41%, #F2A20E 100.37%);">
                                <span>From</span>
                                <span class="text-4xl">50<sup>€</sup></span>
                                <span>per person</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-red-500 rounded-xl h-[485px] py-6 px-5 relative" style="background: linear-gradient(180deg, rgba(0, 39, 62, 0) 55.26%, rgba(0, 39, 62, 0.8) 89.07%), url('/img/test1.jpg'); background-size: cover; background-position: center;">
                        <div class="flex flex-col items-start justify-between h-full">
                            <span class="bg-[#F2F9FB] py-2 px-4 text-[#004972] text-sm font-bold work-sans rounded-4xl">Boat excursion</span>

                            <div class="max-w-[70%]">
                                <p class="text-[#FBBB0E] font-semibold italic text-base work-sans">Experience</p>
                                <p class="text-white font-semibold text-3xl poetsen-one-regular">Private boat tour</p>
                                <hr class="bg-[#F2F9FB] w-12 my-2">
                                <p class="work-sans text-sm font-medium text-white">Departure: <span class="text-[#FBBB0E]">Rovinj</span></p>
                            </div>

                            <div class="absolute bottom-5 -right-5 rounded-xl p-3.5 flex flex-col items-start gap-0 text-[#004972] poetsen-one-regular text-base" style="background: linear-gradient(105.06deg, #FBBB0E 34.41%, #F2A20E 100.37%);">
                                <span>From</span>
                                <span class="text-4xl">50<sup>€</sup></span>
                                <span>per person</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-red-500 rounded-xl h-[485px] py-6 px-5 relative" style="background: linear-gradient(180deg, rgba(0, 39, 62, 0) 55.26%, rgba(0, 39, 62, 0.8) 89.07%), url('/img/test1.jpg'); background-size: cover; background-position: center;">
                        <div class="flex flex-col items-start justify-between h-full">
                            <span class="bg-[#F2F9FB] py-2 px-4 text-[#004972] text-sm font-bold work-sans rounded-4xl">Boat excursion</span>

                            <div class="max-w-[70%]">
                                <p class="text-[#FBBB0E] font-semibold italic text-base work-sans">Experience</p>
                                <p class="text-white font-semibold text-3xl poetsen-one-regular">Private boat tour</p>
                                <hr class="bg-[#F2F9FB] w-12 my-2">
                                <p class="work-sans text-sm font-medium text-white">Departure: <span class="text-[#FBBB0E]">Rovinj</span></p>
                            </div>

                            <div class="absolute bottom-5 -right-5 rounded-xl p-3.5 flex flex-col items-start gap-0 text-[#004972] poetsen-one-regular text-base" style="background: linear-gradient(105.06deg, #FBBB0E 34.41%, #F2A20E 100.37%);">
                                <span>From</span>
                                <span class="text-4xl">50<sup>€</sup></span>
                                <span>per person</span>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <footer class="pt-20">
            <div class="flex items-center justify-center gap-10">
                <img src="/img/footerlogo.svg" />
                <p class="text-[#004972] work-sans font-bold text-sm w-[328px]">
                    Discover Croatia's stunning coastline with our wide range of water activities. <span class="text-[#FBBB0E]">Choose your experience!</span>
                </p>
            </div>

            <div class="pt-16 flex items-center gap-4">
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
                <p class="text-[#004972] font-bold work-sans text-sm">All right reserved ©2025 Booking fleet</p>
                <p class="text-[#004972] font-bold work-sans text-sm">Created by: <span class="text-[#01A6CD]">PROSPEKT</span></p>
            </div>
        </footer>
    </body>
</html>
