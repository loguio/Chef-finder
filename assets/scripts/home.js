import {Swiper} from "swiper";

let icons = ["hand", "network", "cutlery", "meal", "chief", "calendar", "orders", "tickets", "tick"];

let swiper = new Swiper(".mySwiper", {
    direction: "vertical",
    slidesPerView: 1,
    mousewheel: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        renderBullet: function (index, className) {
            return '<div class="m-2 my-3 ' + className + '">' +
                '<div class="sidebarIcon" style="-webkit-mask: url(./build/images/' + icons[index] + '.svg) no-repeat center / contain; mask: url(./build/images/' + icons[index] + '.svg) no-repeat center / contain;"></div>' +
                '</div>';
        },
    },
});