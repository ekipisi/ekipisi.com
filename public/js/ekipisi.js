/* ==========================================================================
Landing kit 2 JS file 
========================================================================== */

$(document).ready(function ($) {

    "use strict";

    $(":input").inputmask();

    //Navigation dots
    $('.slide-dot').on('click', function () {

        var text = $(this).attr('data-feature-text');
        var image = $(this).attr('data-feature');

        $('.showcase-wrap').removeClass('is-active');
        $('.showcase-text-wrapper').addClass('is-hidden');

        $('#' + text).removeClass('is-hidden');
        $('#' + image).addClass('is-active');

        $('.slide-dot.is-active').removeClass('is-active');
        $(this).addClass('is-active');
    })

    //Contact toggler
    $('.tabbed-links li').on('click', function () {

        var target = $(this).attr('data-contact');

        $('.contact-block').addClass('is-hidden');
        $('#' + target).removeClass('is-hidden');

        $('.tabbed-links li.is-active').removeClass('is-active');
        $(this).addClass('is-active');
    })

    // if ($('.switch-pricing-wrapper').length) {
    //     $('.pricing-switcher input').on('change', function () {
    //         $('.plan-price').toggleClass('is-active');
    //     })
    // }

    // //Scroll reveal definitions
    // // Declaring defaults
    // window.sr = ScrollReveal();

    // // Simple reveal
    // sr.reveal('.is-title-reveal', {
    //     origin: 'bottom',
    //     distance: '20px',
    //     duration: 600,
    //     delay: 100,
    //     rotate: {
    //         x: 0,
    //         y: 0,
    //         z: 0
    //     },
    //     opacity: 0,
    //     scale: 1,
    //     easing: 'cubic-bezier(0.215, 0.61, 0.355, 1)',
    //     container: window.document.documentElement,
    //     mobile: true,
    //     reset: false,
    //     useDelay: 'always',
    //     viewFactor: 0.2,

    // });

    // // Left reveal
    // sr.reveal('.is-left-reveal', {
    //     origin: 'left',
    //     distance: '20px',
    //     duration: 500,
    //     delay: 150,
    //     rotate: {
    //         x: 0,
    //         y: 0,
    //         z: 0
    //     },
    //     opacity: 0,
    //     scale: 1,
    //     easing: 'cubic-bezier(0.215, 0.61, 0.355, 1)',
    //     container: window.document.documentElement,
    //     mobile: true,
    //     reset: false,
    //     useDelay: 'always',
    //     viewFactor: 0.4,

    // });

    // // Right reveal
    // sr.reveal('.is-right-reveal', {
    //     origin: 'right',
    //     distance: '20px',
    //     duration: 500,
    //     delay: 150,
    //     rotate: {
    //         x: 0,
    //         y: 0,
    //         z: 0
    //     },
    //     opacity: 0,
    //     scale: 1,
    //     easing: 'cubic-bezier(0.215, 0.61, 0.355, 1)',
    //     container: window.document.documentElement,
    //     mobile: true,
    //     reset: false,
    //     useDelay: 'always',
    //     viewFactor: 0.4,

    // });

    // // Revealing multiple icons
    // sr.reveal('.is-icon-reveal', {
    //     origin: 'bottom',
    //     distance: '20px',
    //     duration: 600,
    //     delay: 100,
    //     rotate: {
    //         x: 0,
    //         y: 0,
    //         z: 0
    //     },
    //     opacity: 0,
    //     scale: 1,
    //     easing: 'cubic-bezier(0.215, 0.61, 0.355, 1)',
    //     container: window.document.documentElement,
    //     mobile: true,
    //     reset: true,
    //     useDelay: 'always',
    //     viewFactor: 0.2,

    // }, 100);

    // // Revealing multiple posts
    // sr.reveal('.is-post-reveal', {
    //     origin: 'bottom',
    //     distance: '20px',
    //     duration: 600,
    //     delay: 100,
    //     rotate: {
    //         x: 0,
    //         y: 0,
    //         z: 0
    //     },
    //     opacity: 0,
    //     scale: 1,
    //     easing: 'cubic-bezier(0.215, 0.61, 0.355, 1)',
    //     container: window.document.documentElement,
    //     mobile: true,
    //     reset: false,
    //     useDelay: 'always',
    //     viewFactor: 0.2,

    // }, 160);

    // // Revealing multiple cards
    // sr.reveal('.is-card-reveal', {
    //     origin: 'bottom',
    //     distance: '20px',
    //     duration: 600,
    //     delay: 100,
    //     rotate: {
    //         x: 0,
    //         y: 0,
    //         z: 0
    //     },
    //     opacity: 0,
    //     scale: 1,
    //     easing: 'cubic-bezier(0.215, 0.61, 0.355, 1)',
    //     container: window.document.documentElement,
    //     mobile: true,
    //     reset: false,
    //     useDelay: 'always',
    //     viewFactor: 0.2,

    // }, 160);

    // // Revealing multiple dots
    // sr.reveal('.is-dot-reveal', {
    //     origin: 'bottom',
    //     distance: '20px',
    //     duration: 600,
    //     delay: 100,
    //     rotate: {
    //         x: 0,
    //         y: 0,
    //         z: 0
    //     },
    //     opacity: 0,
    //     scale: 1,
    //     easing: 'cubic-bezier(0.215, 0.61, 0.355, 1)',
    //     container: window.document.documentElement,
    //     mobile: true,
    //     reset: true,
    //     useDelay: 'always',
    //     viewFactor: 0.2,

    // }, 160);

});

$.fn.extend({
    animateCss: function (animationName, callback) {
        var animationEnd = (function (el) {
            var animations = {
                animation: 'animationend',
                OAnimation: 'oAnimationEnd',
                MozAnimation: 'mozAnimationEnd',
                WebkitAnimation: 'webkitAnimationEnd',
            };

            for (var t in animations) {
                if (el.style[t] !== undefined) {
                    return animations[t];
                }
            }
        })(document.createElement('div'));

        this.addClass('animated ' + animationName).one(animationEnd, function () {
            $(this).removeClass('animated ' + animationName);

            if (typeof callback === 'function') callback();
        });

        return this;
    },
});

var options = {
    accessibility: true,
    prevNextButtons: true,
    pageDots: false,
    setGallerySize: true,
    autoPlay: true,
    autoPlay: 2500,
    adaptiveHeight: true
};

var carousel = document.querySelector('[data-carousel]');
if (carousel) {
    var flkty = new Flickity(carousel, options);
}

var checkTcNum = function (value) {
    value = value.toString();
    var isEleven = /^[0-9]{11}$/.test(value);
    var totalX = 0;
    for (var i = 0; i < 10; i++) {
        totalX += Number(value.substr(i, 1));
    }
    var isRuleX = totalX % 10 == value.substr(10, 1);
    var totalY1 = 0;
    var totalY2 = 0;
    for (var i = 0; i < 10; i += 2) {
        totalY1 += Number(value.substr(i, 1));
    }
    for (var i = 1; i < 10; i += 2) {
        totalY2 += Number(value.substr(i, 1));
    }
    var isRuleY = ((totalY1 * 7) - totalY2) % 10 == value.substr(9, 0);
    return isEleven && isRuleX && isRuleY;
};
window.checkTcNum = checkTcNum;
$.validator.addMethod(
    'tckimlikno',
    function (value, element) {
        var no = value.split('');
        var i, total1 = 0,
            total2 = 0,
            total3 = parseInt(no[0]);
        for (i = 0; i < 10; i++) {
            total1 = total1 + parseInt(no[i]);
        }
        for (i = 1; i < 9; i = i + 2) {
            total2 = total2 + parseInt(no[i]);
            total3 = total3 + parseInt(no[i + 1]);
        }
        return this.optional(element) || !(!/^[1-9][0-9]{10}$/.test(value) || (total1 % 10 != no[10]) || (total3 * 7 - total2) % 10 != no[9]);
    },
    "Geçersiz TC Kimlik No. Algoritma doğrulanmadı lütfen kontrol edin."
);

$(".validate").validate({
    showErrors: function () {
        if (this.settings.highlight) {
            for (var i = 0; this.errorList[i]; ++i) {
                this.settings.highlight.call(this, this.errorList[i].element,
                    this.settings.errorClass, this.settings.validClass);
            }
        }
        if (this.settings.unhighlight) {
            for (var i = 0, elements = this.validElements(); elements[i]; ++i) {
                this.settings.unhighlight.call(this, elements[i],
                    this.settings.errorClass, this.settings.validClass);
            }
        }
    },
    errorClass: "is-danger",
    validClass: "is-success"
});

$(".validate-with-message").validate({
    errorClass: "is-danger color-red is-size-7",
    inputClass: "",
    validClass: "is-success",
    errorElement: "small",
    highlight: function (element, errorClass, validClass) {
        $(element).parents("div.field").addClass("has-error").removeClass(validClass);
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).parents(".error").removeClass("has-error").addClass(validClass);
    }
});

$(".btn-service").click(function () {
    var name = $(this).attr("id").replace("btn-", "");
    $(".btn-service").parent("li").removeClass("is-active");
    $(this).parent("li").addClass("is-active");
    $(".container-service").hide();
    $("#container-" + name).show();
});

$(".btn-reply").click(function () {
    var reply_container = $("#reply");
    if ($(reply_container).css('display') == 'none') {
        reply_container.show();
    } else {
        reply_container.hide();
    }
});

$(".external").click(function (e) {
    e.preventDefault();
    window.open(this.href);
});

// if ($('#drag-left').length) {
//     setTimeout(function() {
//         $('#drag-left').fadeOut('fast');
//     }, 6000);
// }

function handleGaClick(category, name) {
    ga('send', 'event', category, 'Click', name);
}