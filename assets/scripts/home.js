import {Swiper} from "swiper";

let icons = [
    ["hand", "Hello"],
    ["network", "Présentation"],
    ["cutlery", "Choix du type de cuisine"],
    ["meal", "Choix de la recette / Box"],
    ["chief", "Trouve ton chef"],
    ["calendar", "Date et adresse de livraison et du RDV"],
    ["orders", "Récapitulatif"],
    ["tickets", "Mode de paiement"],
    ["tick", "Confirmation"],
];
let socialIcons = ["facebook", "instagram", "linkedin", "youtube"];

let swiper = new Swiper(".mySwiper", {
    direction: "vertical",
    slidesPerView: 1,
    mousewheel: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        renderBullet: function (index, className) {
            return '<div class="mx-auto ' + className + '">' +
                '<div class="sidebarIcon" title="' + icons[index][1] + '" style="-webkit-mask: url(./build/images/' + icons[index][0] + '.svg) no-repeat center / contain; mask: url(./build/images/' + icons[index][0] + '.svg) no-repeat center / contain;"></div>' +
                '</div>';
        },
    },
});


let navbarHeight = $("#navbar").outerHeight(true);
let socialIconsHeight = $("#socialIcons").outerHeight(true);
let swpPagination = $(".swiper-pagination").outerWidth(true);


$(".swiper-pagination, .swpSlideContainer").css({
    "height": "calc(100% - " + navbarHeight + "px)",
    "padding-bottom": Math.round(socialIconsHeight) + "px"
});


$("#swpCookingTypesContainer").css({
    "width": "calc(94% - " + swpPagination + "px)"
});


$(".cakeFountain").css({
    "margin-right": swpPagination + "px",
    "margin-bottom": socialIconsHeight + "px"
});


$(".btnBookChief").click(function () {
    $(".swiper-pagination").fadeTo(200, 1);
    swiper.slideTo(1, 350);
});

$(".choiceCard").click(function () {
    let activeRadio = $(this).find(".choiceRadio");
    $(".choiceCard, .choiceRadio").removeClass("active");
    $(this, activeRadio).addClass("active");
});

swiper.on('slideChange', function () {
    $(".swiper-pagination").fadeTo(200, 1);
});



