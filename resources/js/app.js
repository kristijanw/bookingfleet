import './bootstrap';

if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw.js', { scope: '/' }).then(function (registration) {
        console.log(`SW registered successfully!`);
    }).catch(function (registrationError) {
        console.log(`SW registration failed`);
    });
}



document.addEventListener("DOMContentLoaded", function () {
    if (typeof Swiper !== "undefined" && !window.swiperInitialized) {
        window.swiperInitialized = true;
        new Swiper(".swiper", {
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    }
});

window.calendarComponent = function(availableDates, excursionId) {
    return {
        availableDates: availableDates,
        excursionId: excursionId,
        initCalendar() {
            let firstAvailableDate = this.availableDates.length > 0 ? this.availableDates[0] : null;

            let fp = flatpickr(this.$refs.calendar, {
                locale: 'en',
                inline: true,
                enable: this.availableDates,
                dateFormat: "Y-m-d",
                onDayCreate: function(dObj, dStr, fp, dayElem) {
                    let date = fp.formatDate(dayElem.dateObj, "Y-m-d");
                    
                    if (availableDates.includes(date)) {
                        dayElem.classList.add('available-date');
                    }
                },
                onChange: (selectedDates, dateStr, instance) => {
                    console.log("Odabrani datum:", dateStr);

                    window.livewire.emit('postaviDatum', dateStr, this.excursionId);

                    // const livewireComponent = this.$el.closest('[wire:id]');
                    // if (livewireComponent) {
                    //     const componentId = livewireComponent.getAttribute('wire:id');
                    //     const component = window.Livewire.find(componentId);

                    //     // Pozivaj metodu u Livewire komponenti
                    //     if (component) {
                    //         component.call('postaviDatum', dateStr, this.excursionId);
                    //     } else {
                    //         console.error('Livewire komponenta nije pronađena.');
                    //     }
                    // }
                }
            });

            if (firstAvailableDate) {
                fp.jumpToDate(firstAvailableDate);
            }
        }
    };
}