/*
|------------------------------------------------------------
| All the Javascript for the website, weeeeeee.
|------------------------------------------------------------
*/

var $ = jQuery;


$(document).ready(function() {
    jQuery(".owl-carousel").owlCarousel({
        responsiveClass: true,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        responsive : {
            0:
            {
                items:1,
                nav:false
            },
            320:
            {
                items:2,
                nav:false
            },
            500: 
            {
                items: 3,
                nav: false
            },
            700: 
            {
                items: 4,
                nav: false
            },
            1000:
            {
                items:5,
                nav:false,
                loop:true
            }
        },
        items: 5,
    });

})

function throttle(fn, threshhold, scope) {
    threshhold || (threshhold = 250);
    var last,
        deferTimer;
    return function() {
        var context = scope || this;

        var now = +new Date,
            args = arguments;
        if (last && now < last + threshhold) {
            // hold on to it
            clearTimeout(deferTimer);
            deferTimer = setTimeout(function() {
                last = now;
                fn.apply(context, args);
            }, threshhold);
        } else {
            last = now;
            fn.apply(context, args);
        }
    };
}

