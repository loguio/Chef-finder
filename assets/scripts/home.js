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
    allowTouchMove: false,
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


$(".swiper-pagination, .swpSlideContainer, .formContainer").css({
    "height": "calc(100% - " + navbarHeight + "px)",
    "padding-bottom": Math.round(socialIconsHeight) + "px"
});

$(".formContainer").css({"margin-top": navbarHeight + "px"});

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
    $(this).addClass("active");
    $(activeRadio).addClass("active");
});

swiper.on('slideChange', function () {
    $(".swiper-pagination").fadeTo(200, 1);
});


let pwdInputEyeWidth = $(".pwdInputEye").outerWidth(true);

$(".pwdInput").css({
    "width": "calc(100% - " + pwdInputEyeWidth + "px)",
});

$(function () {
    $('[data-toggle="password"]').each(function () {
        let input = $(this);
        let eye_btn = $(this).parent().find('.input-group-text');
        eye_btn.css('cursor', 'pointer').addClass('input-password-hide');
        eye_btn.on('click', function () {
            if (eye_btn.hasClass('input-password-hide')) {
                eye_btn.removeClass('input-password-hide').addClass('input-password-show');
                eye_btn.find('.fa').removeClass('fa-eye').addClass('fa-eye-slash')
                input.attr('type', 'text');
            } else {
                eye_btn.removeClass('input-password-show').addClass('input-password-hide');
                eye_btn.find('.fa').removeClass('fa-eye-slash').addClass('fa-eye')
                input.attr('type', 'password');
            }
        });
    });
});



