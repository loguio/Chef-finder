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


// Declare the slider component with options and generate the slide buttons based on the icons array
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
                '<div class="sidebarIcon" title="' + icons[index][1] + '" style="-webkit-mask: url(./build/images/layout/sidebar/' + icons[index][0] + '.svg) no-repeat center / contain; mask: url(./build/images/layout/sidebar/' + icons[index][0] + '.svg) no-repeat center / contain;"></div>' +
                '</div>';
        },
    },
});


// Manage the containers/pages sizes by calculating the navbar and social icons sizes
let navbarHeight = $("#navbar").outerHeight(true);
let socialIconsHeight = $("#socialIcons").outerHeight(true);
let swpPagination = $(".swiper-pagination").outerWidth(true);


$(".swiper-pagination, .swpSlideContainer, .formContainer, .boxOrder").css({
    "height": "calc(100% - " + navbarHeight + "px)",
    "padding-bottom": Math.round(socialIconsHeight) + "px"
});

$(".formContainer").css({"margin-top": navbarHeight + "px"});

$("#swpCookingTypesContainer, #swpPresentationContainer, .boxOrderDetailsContainer, #swpChiefsContainer").css({
    "width": "calc(94% - " + swpPagination + "px)"
});


// Position the absolute images by considering the sidebar and social icons sizes
$(".cakeFountain, .womanChiefImg").css({
    "margin-right": swpPagination + "px",
    "margin-bottom": socialIconsHeight + "px"
});


// Get the slide to go to (from buttons), and change the current slide to the desired one with a fade animation
$(".mainBtn[data-slide-to]").click(function () {
    let goToSlide = $(this).data("slide-to");
    $(".swiper-pagination").fadeTo(200, 1);
    swiper.slideTo(goToSlide, 350);
});


// Manage the switch of steps for multi-content screens on the homepage
$(".mainBtn.switchStep").click(function () {
    $(".firstStep, .secondStep").toggleClass('d-none').css({"animation" : 'fadeBlock 350ms ease-in-out both'});
});


// Toggle active state for cards (text, color, and radio buttons)
$(".choiceCard").click(function () {
    $(this).closest('.choiceCardsList').find('.choiceCard').removeClass("active");
    $(this).addClass("active");
});


// Toggle active state for list items
$(".listItem").click(function () {
    $(this).closest('.overflowedList').find('.listItem').removeClass("active");
    $(this).addClass("active");
});


// Hide and show meal details based on the click of items in the list
$(".boxList .listItem").click(function () {
    let box = $(this).data("box");
    $(this).closest('.swpSlideContainer').find('.boxOrderItem').addClass("d-none");
    $(this).closest('.swpSlideContainer').find('.boxOrderItem[data-recette-order="' + box + '"]').removeClass("d-none").css({"animation" : 'fadeBlock 250ms ease-in-out both'});
});


// Filter the boxes based on the selected cooking types
$(".mealTypeList .listItem").click(function () {
    let mealType = $(this).data("meal-type");
    let swpWrapper = $(this).closest('.swiper-wrapper');
    let mealsList = swpWrapper.find('.boxList .listItem');
    let cookingTypeMeals = swpWrapper.find('.boxList .listItem[data-meal-type="' + mealType + '"]');
    mealsList.addClass("d-none").removeClass("d-flex");
    cookingTypeMeals.addClass("d-flex").removeClass("d-none").css({"animation" : 'fadeBlock 250ms ease-in-out both'});
    mealsList.removeClass("active");
    cookingTypeMeals.not('.d-none').first().addClass("active");
    swpWrapper.find('.boxOrderItem').addClass("d-none");
    let activeMeal = swpWrapper.find('.boxList .listItem.active').data("box");
    swpWrapper.find('.boxOrderItem[data-recette-order="' + activeMeal + '"]').removeClass("d-none");
});


// Add a fade animation on slide change
swiper.on('slideChange', function () {
    $(".swiper-pagination").fadeTo(200, 1);
});


// Tweak the default scroll-wheel behaviour on overflowed list (to avoid conflict with the mousewheel control from SwiperJS)
let overflowList = $(".overflowedList");
$(overflowList).mouseenter(function () {
    swiper.mousewheel.disable()
});

// Revert to the default slider scroll behaviour when the user cursor leave the list
$(overflowList).mouseleave(function () {
    swiper.mousewheel.enable()
});


// Manage the dynamic box order numbers (price, quantity, total)
$(".choiceCard .orderIncrementBtn").click(function () {
    let incrType = $(this).data("incr-type");
    let quantityTxt = $(this).closest('.choiceCard.active').find('.orderQuantity');
    let priceTxt = $(this).closest('.choiceCard.active').find('.orderPrice');
    let ordRecapQuant = $(this).closest('.boxOrderDetailsContainer').find('.ordRecapQuantity');
    let ordRecapPrice = $(this).closest('.boxOrderDetailsContainer').find('.ordRecapPrice');
    let ordPriceTotal = $(this).closest('.boxOrderDetailsContainer').find('.orderPriceTotal');
    let quantity = parseInt(quantityTxt.text());
    if (incrType === "+" && quantity < 10) {
        quantityTxt.text(quantity + 1);
    } else if (incrType === "-" && quantity > 1) {
        quantityTxt.text(quantity - 1);
    }
    ordRecapQuant.text(quantityTxt.text());
    ordRecapPrice.text(priceTxt.text());
    ordPriceTotal.text(quantityTxt.text() * priceTxt.text());

});


// Manage the eye icon in login/register forms (toggle to reveal/hide the pwd)
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


// Debug to work en slides and auto scroll to the desired one
swiper.slideTo(4, 350);


