/*
|------------------------------------------------------------
| All the Javascript for the website, weeeeeee.
|------------------------------------------------------------
*/

var $ = jQuery;
var menuTabs = $('.tab-container .menu-tab');
var menuTabsArray = [];
var divTabs = $('.tab-container .tab');
var divTabsArray = [];
var characters = $('.left-div-tabcontainer li');
var charArray = [];
var charInfo = $('.right-div-tabcontainer .char-info');
var charInfoArray = [];


for (var i = -1, l = menuTabs.length; ++i !== l; menuTabsArray[i] = menuTabs[i]);
for (var i = -1, l = divTabs.length; ++i !== l; divTabsArray[i] = divTabs[i]);
for (var i = -1, l = characters.length; ++i !== l; charArray[i] = characters[i]);
for (var i = -1, l = charInfo.length; ++i !== l; charInfoArray[i] = charInfo[i]);


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
                nav:false,
                loop: true
            },
            320:
            {
                items:2,
                nav:false,
                loop:true
            },
            500: 
            {
                items: 3,
                nav: false,
                loop: true
            },
            700: 
            {
                items: 4,
                nav: false,
                loop: true
            },
            1000:
            {
                items:5,
                nav:false,
                loop:true
            }
        },
    });

})

menuTabsArray.forEach(function(tab) {
    $(tab).click(function() {
        var index = $(this).index();

        $(divTabsArray[0]).removeClass('active-tab');
        $(divTabsArray[1]).removeClass('active-tab');
        $(divTabsArray[2]).removeClass('active-tab');

        $(menuTabsArray[0]).removeClass('active');
        $(menuTabsArray[1]).removeClass('active');
        $(menuTabsArray[2]).removeClass('active');

        $(divTabsArray[index]).addClass('active-tab');
        $(menuTabsArray[index]).addClass('active');
    })
});

charArray.forEach(function(char) {
    $(char).click(function() {
        var index = $(this).index();

        $(charArray[0]).removeClass('active');
        $(charArray[1]).removeClass('active');
        $(charArray[2]).removeClass('active');
        $(charArray[3]).removeClass('active');
        $(charArray[4]).removeClass('active');
        $(charArray[5]).removeClass('active');
        $(charArray[6]).removeClass('active');
        $(charArray[7]).removeClass('active');

        $(charInfoArray[0]).removeClass('display');
        $(charInfoArray[1]).removeClass('display');
        $(charInfoArray[2]).removeClass('display');
        $(charInfoArray[3]).removeClass('display');
        $(charInfoArray[4]).removeClass('display');
        $(charInfoArray[5]).removeClass('display');
        $(charInfoArray[6]).removeClass('display');
        $(charInfoArray[7]).removeClass('display');

        $(charInfoArray[index]).addClass('display');
        $(charArray[index]).addClass('active');
    })
});

$(document).ready(function() {
    if($('.message').length > 0) {
        setTimeout(function() {
            $('.message').removeClass('from-top');
            $('.message').addClass('move-up no-opacity');

            setTimeout(function() {
                $('.message').remove();
            }, 200)
        }, 5000)
    }
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

