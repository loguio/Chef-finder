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

$("#swpCookingTypesContainer, #swpPresentationContainer, .boxOrderDetailsContainer, #swpChiefsContainer, #swpSummaryContainer, #swpPaymentContainer, #swpConfirmContainer").css({
    "width": "calc(94% - " + swpPagination + "px)"
});


// Position the absolute images by considering the sidebar and social icons sizes
$(".cakeFountain, .womanChiefImg").css({
    "margin-right": swpPagination + "px",
    "margin-bottom": socialIconsHeight + "px"
});


// Get the slide to go to (from buttons), and change the current slide to the desired one with a fade animation
$(".mainBtn[data-slide-to]").not('.disabled').click(function () {
    let goToSlide = $(this).data("slide-to");
    $(".swiper-pagination").fadeTo(200, 1);
    swiper.slideTo(goToSlide, 350);
});


// Manage the "Validate Order" btn and confirmation screen
$(".validateOrderBtn").click(function () {
    if (!$("#swpConfirmContainer .confirmWaiting").hasClass("d-none")) {
        if (!$(this).hasClass("disabled")) {
            $("#swpConfirmContainer .confirmWaiting, #swpConfirmContainer .confirmCompleted").toggleClass("d-none").toggleClass("d-flex");
            let goToSlide = $(this).data("slide-to");
            $(".swiper-pagination").fadeTo(200, 1);
            swiper.slideTo(goToSlide, 350);
            setTimeout(function () {
                $("#hiddenOrderForm").submit();
            }, 1750);
        }
    }
});


// Manage the switch of steps for multi-content screens on the homepage
$(".mainBtn.switchStep").click(function () {
    $(this).closest('.swpSlideContainer').find(".firstStep, .secondStep")
        .toggleClass('d-none')
        .css({"animation": 'fadeBlock 350ms ease-in-out both'});
});


// Toggle active state for cards (text, color, and radio buttons)
$(".choiceCard").click(function () {
    $(this).closest('.choiceCardsList').find('.choiceCard').removeClass("active");
    $(this).addClass("active");
});


// Toggle active state for payment methods
$(".paymentModel").click(function () {
    $(this).closest('#swpPaymentContainer').find('.paymentModel').removeClass("active");
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
    swpWrapper.find('#swpRecipesContainer .boxOrderItem').addClass("d-none");
    let activeMeal = swpWrapper.find('.boxList .listItem.active').data("box");
    swpWrapper.find('#swpRecipesContainer .boxOrderItem[data-recette-order="' + activeMeal + '"]').removeClass("d-none");
});


// Change chosen chief in recap based on chiefs carousel
$("#chiefCarouselIndicators a").click(function () {
    let indicators = $("#chiefCarouselIndicators a");
    setTimeout(function () {
        let swpWrapper = indicators.closest('.swiper-wrapper');
        let activeChief = indicators.closest('#swpChiefsContainer').find('.carousel-item.active').data("chief");
        let activeChiefId = indicators.closest('#swpChiefsContainer').find('.carousel-item.active').data("chief-id");
        swpWrapper.find('.recapChief').addClass("d-none").removeClass("d-flex");
        swpWrapper.find('.recapChief[data-chief="' + activeChief + '"]').addClass("d-flex").removeClass("d-none");
        $('#hiddenChiefId').val(activeChiefId);
    }, 605);
});


// Change background on forms Slides on homepage
swiper.on('slideChangeTransitionStart', function () {
    let calendarSlide = $("#swpCalendarContainer").parent();
    if (calendarSlide.hasClass("swiper-slide-active")) {
        $("#navbar, #socialIcons, .swiper.mySwiper").addClass("formSlide");
    } else {
        $("#navbar, #socialIcons, .swiper.mySwiper").removeClass("formSlide");
    }
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
$("#swpRecipesContainer .choiceCard .orderIncrementBtn").click(function () {
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


$("#swpRecipesContainer .choiceCard").click(function () {
    let quantityTxt = $(this).find('.orderQuantity');
    let priceTxt = $(this).find('.orderPrice');
    let ordRecapQuant = $(this).closest('.boxOrderDetailsContainer').find('.ordRecapQuantity');
    let ordRecapPrice = $(this).closest('.boxOrderDetailsContainer').find('.ordRecapPrice');
    let ordPriceTotal = $(this).closest('.boxOrderDetailsContainer').find('.orderPriceTotal');
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


// Bind the forms values to recap screen
$(function () {
    $('#swpCalendarContainer #deliveryAddress').on('input', function () {
        $('.recapAddressDelivery').text(this.value).prop('title', this.value);
        $('.validateOrderBtn').attr("data-deliv-address", "filled");
        $('#hiddenDeliveryAddress').val(this.value);
        if (!this.value) {
            $('.recapAddressDelivery').text("Non renseigné").prop('title', "Non renseigné");
            $('.validateOrderBtn').attr("data-deliv-address", "empty");
            $('#hiddenDeliveryAddress').val("vide");
        }
    });

    $('#swpCalendarContainer #appointmentAddress').on('input', function () {
        $('.recapAddressMeeting').text(this.value).prop('title', this.value);
        $('.validateOrderBtn').attr("data-meet-address", "filled");
        $('#hiddenAppointmentAddress').val(this.value);
        if (!this.value) {
            $('.recapAddressMeeting').text("Non renseigné").prop('title', "Non renseigné");
            $('.validateOrderBtn').attr("data-meet-address", "empty");
            $('#hiddenAppointmentAddress').val("vide");
        }
    });

    $('#swpCalendarContainer #orderDate').on('input', function () {
        let date = new Date(this.value);
        date = [String(date.getDate()).padStart(2, '0'), String(date.getMonth() + 1).padStart(2, '0'), date.getFullYear()].join('/');
        $('.recapDate').text(date).prop('title', date);
        $('.validateOrderBtn').attr("data-order-date", "filled");
        $('#hiddenDate').val(date);
        if (!this.value) {
            $('.recapDate').text("Non renseigné");
            $('.validateOrderBtn').attr("data-order-date", "empty");
            $('#hiddenDate').val("vide");
        }
    });

    $('#swpCalendarContainer #orderTime').on('input', function () {
        let time = new Date(this.valueAsDate);
        time = [('0' + time.getUTCHours()).slice(-2), ('0' + time.getUTCMinutes()).slice(-2)].join(':');
        $('.recapTime').text(time).prop('title', time);
        $('.validateOrderBtn').attr("data-order-time", "filled");
        $('#hiddenTime').val(time);
        if (!this.value) {
            $('.recapTime').text("Non renseigné");
            $('.validateOrderBtn').attr("data-order-time", "empty");
            $('#hiddenTime').val("vide");
        }
    });

    $('#swpPaymentContainer #inputCardNumber').on('input', function () {
        $('.validateOrderBtn').attr("data-card-number", "filled");
        if (!this.value) {
            $('.validateOrderBtn').attr("data-card-number", "empty")
        }
    });

    $('#swpPaymentContainer #inputCardExpDate').on('input', function () {
        $('.validateOrderBtn').attr("data-card-exp", "filled");
        if (!this.value) {
            $('.validateOrderBtn').attr("data-card-exp", "empty")
        }
    });

    $('#swpPaymentContainer #inputCardCcv').on('input', function () {
        $('.validateOrderBtn').attr("data-card-cvv", "filled");
        if (!this.value) {
            $('.validateOrderBtn').attr("data-card-cvv", "empty")
        }
    });
})


// Bind the chosen box/meal infos to recap screen
$('#swpRecipesContainer .choiceCard, #swpRecipesContainer .orderIncrementBtn, #swpRecipesContainer .boxList .listItem, #swpCookingTypesContainer .mealTypeList .listItem').click(function () {
    let activeMeal = $('#swpRecipesContainer .boxOrderItem:not(.d-none)');
    let mealName = activeMeal.find('.boxDetailsName').text();
    let mealPicture = activeMeal.find('.boxDetailsImg').attr('src');
    let boxName = activeMeal.find('.choiceCard.active').closest('.w-50').find('.boxOrderTitle').text();
    let boxId = activeMeal.find('.choiceCard.active').closest('.w-50').find('.boxOrderTitle').data("box-id");
    let boxDescription = activeMeal.find('.choiceCard.active .cardText').text();
    let boxQuantity = activeMeal.find('.ordRecapQuantity').text();
    let boxPrice = activeMeal.find('.ordRecapPrice').text();
    let boxTotalPrice = activeMeal.find('.orderPriceTotal').text();

    $('#swpSummaryContainer .boxDetailsName').text(mealName);
    $('#swpSummaryContainer .boxDetailsImg').prop('src', mealPicture).prop('alt', mealName);
    $('#swpSummaryContainer .boxName, #swpPaymentContainer .boxName').text(boxName);
    $('#swpSummaryContainer .boxDescription, #swpPaymentContainer .boxDescription').text(boxDescription);
    $('#swpSummaryContainer .ordRecapQuantity, #swpPaymentContainer .ordRecapQuantity').text(boxQuantity).prop('title', boxQuantity);
    $('#swpSummaryContainer .ordRecapPrice, #swpPaymentContainer .ordRecapPrice').text(boxPrice).prop('title', boxPrice);
    $('#swpSummaryContainer .orderPriceTotal, #swpPaymentContainer .orderPriceTotal').text(boxTotalPrice).prop('title', boxTotalPrice);

    $('#hiddenBoxQuantity').val(boxQuantity);
    $('#hiddenPrice').val(boxTotalPrice);
    $('#hiddenBoxId').val(boxId);
});


//For Card Number formatted input
let cardNum = document.getElementById('inputCardNumber');
cardNum.onkeyup = function () {
    if (this.value === this.lastValue) return;
    let caretPosition = this.selectionStart;
    let sanitizedValue = this.value.replace(/[^0-9]/gi, '');
    let parts = [];
    let i = 0;
    let len = sanitizedValue.length;
    for (; i < len; i += 4) {
        parts.push(sanitizedValue.substring(i, i + 4));
    }
    for (i = caretPosition - 1; i >= 0; i--) {
        let c = this.value[i];
        if (c < '0' || c > '9') {
            caretPosition--;
        }
    }
    caretPosition += Math.floor(caretPosition / 4);
    this.value = this.lastValue = parts.join(' ');
    this.selectionStart = this.selectionEnd = caretPosition;
}

//For Date formatted input
let expDate = document.getElementById('inputCardExpDate');
expDate.onkeyup = function () {
    if (this.value === this.lastValue) return;
    let caretPosition = this.selectionStart;
    let sanitizedValue = this.value.replace(/[^0-9]/gi, '');
    let parts = [];
    let i, len;
    for (i = 0, len = sanitizedValue.length; i < len; i += 2) {
        parts.push(sanitizedValue.substring(i, i + 2));
    }
    for (i = caretPosition - 1; i >= 0; i--) {
        const c = this.value[i];
        if (c < '0' || c > '9') {
            caretPosition--;
        }
    }
    caretPosition += Math.floor(caretPosition / 2);
    this.value = this.lastValue = parts.join('/');
    this.selectionStart = this.selectionEnd = caretPosition;
}


// Check for all forms values to activate order button
$(function () {
    let validateBtn = $('.validateOrderBtn');
    $('.mySwiper input').on('input', function () {
        if (validateBtn.attr("data-deliv-address") === "filled" && validateBtn.attr("data-meet-address") === "filled" && validateBtn.attr("data-order-date") === "filled"
            && validateBtn.attr("data-order-time") === "filled" && validateBtn.attr("data-card-number") === "filled" && validateBtn.attr("data-card-exp") === "filled"
            && validateBtn.attr("data-card-cvv") === "filled" && $('#hiddenCustomerId').attr("value") !== "vide")
        {
            validateBtn.removeClass('disabled');
        } else {
            validateBtn.addClass('disabled');
        }
    });
});


// Debug to work en slides and auto scroll to the desired one
// swiper.slideTo(8, 350);


