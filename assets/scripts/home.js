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
            return '<div class="mx-auto ' + className + '">' +
                '<div class="sidebarIcon" style="-webkit-mask: url(./build/images/' + icons[index] + '.svg) no-repeat center / contain; mask: url(./build/images/' + icons[index] + '.svg) no-repeat center / contain;"></div>' +
                '</div>';
        },
    },
});


let swiperPagination = $(".swiper-pagination");
let navbarHeight = $("#navbar").outerHeight(true);
let socialIconsHeight = $("#socialIcons").outerHeight(true);
swiperPagination.css({
    "height": "calc(100% - " + navbarHeight + "px)",
    "padding-bottom": Math.round(socialIconsHeight) + "px"
});




