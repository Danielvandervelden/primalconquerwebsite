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

    setTimeout(function() {

        var closeButton = document.getElementsByClassName('fa-window-close');
        var background_popup = document.querySelector('.faded-black-bg.notice');

        $(background_popup).click(function () {
            $('.notice').addClass('no-opacity');
             setTimeout(function() { $('.notice').remove(); }, 300)
        })
         $(closeButton).click(function() {
             $('.notice').removeClass('full-opacity');
             $('.notice').addClass('no-opacity');
             setTimeout(function() { $('.notice').remove(); }, 300)
         })
    }, 500)

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

    //Active menu item

    var page  = {
        "account":  {
            "selector": ".menu .account"
        },
        "server": {
            "selector": ".menu .server"
        },
        "news": {
            "selector": ".menu .server"
        },
        "changelog": {
            "selector": ".menu .server"
        },
        "downloads": {
            "selector": ".menu .server"
        },
        "rules": {
            "selector": ".menu .server"
        },
        "support": {
            "selector": ".menu .support"
        },
        "profile": {
            "selector": ".menu .profile"
        }
    }

    for(var key in page) {
                if (window.location.href.indexOf(key) > -1) {
                    
                    var obj = page[key];

                    for(var prop in obj) {
                        if(!jQuery(obj[prop]).hasClass("active-menu-item")) {
                            console.log(obj);
                        jQuery(obj[prop]).addClass("active-menu-item");
                        }
                    }
                }
            }

                if ($('.active-menu-item').length === 0) {
                    $('.menu .home').addClass('active-menu-item');
                }

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
    function print_console()
		{
			var logo_style = [
			    'background-color: #000'
			    , 'border: 1px solid #030303'
			    , 'color: #fff'
			    , 'display: inline-block'
			    , 'text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.4)'
			    , 'line-height: 40px'
			    , 'text-align: center'
			    , 'font-weight: bold'
			    , 'padding: 10px 30px'
			    , 'font-size: 16px'
			    , 'border-radius: 2px'
			].join(';');

			var test = [
			     'font-size: 8px'
			     , 'line-height: 8px'
			].join(';');

			console.log("\n"+'%c Primal Conquer', logo_style);

             console.log("Hi, thanks for taking a look here! It was specifically made for Primal Conquer and every single line of code is written by me. Tech used: Wordpress, MYSQL, PHP, Javascript & jQuery and Sass. Let us know if you find any major flaws.")
		}

		print_console()
})

//#############################################################
// Oh well, why not add some animations when scrolling to a
// certain point...
//#############################################################

// grab all the why-us blocks
let whyUsBlocks = document.getElementsByClassName('why-us-block');
// add an event listener on the window
$(window).scroll(throttle(showWhyUsBlocks));

function showWhyUsBlocks() {
    // check whether the user scrolled past 200px from the top
    if($(window).scrollTop() > 200) {
        // if so every even block comes in from the left, and uneven from the left
        for(var i = 0; i<whyUsBlocks.length; i++) {
            if(isEven(i)) {
                $(whyUsBlocks[i]).removeClass('hidden');
                $(whyUsBlocks[i]).addClass('from-left');
            } else {
                $(whyUsBlocks[i]).removeClass('hidden');
                $(whyUsBlocks[i]).addClass('from-right');
            }
        }
        // and let's remove the event listener since we don't need it anymore. SAVE PERFORMANCEEEEEE
        $(window).unbind('scroll');
    }

}

// Going to clone the complete menu inside of the mobile menu. Don't wanna remake it :)
$('nav.menu').clone().appendTo('.mobile-menu-content');

let allMenuItems = $('#mobile-menu .menu .main-menu-item');

$('.open-menu').click(function() {
    $('.mobile-menu-content').addClass('menu-active');
    $('html').addClass('no-scroll');
})

$('.close-menu').click(function() {
    $('.mobile-menu-content').removeClass('menu-active');
    $('html').removeClass('no-scroll');
})

$.each(allMenuItems, function(menuItem) {
    if($(this).children('.inner-menu').length > 0) {
        $(this).click(function(e) {
            $(this).find('.inner-menu').slideToggle();
            $(this).toggleClass('active');
        })
    }
})

function isEven(n) {
    n = Number(n);
    return n === 0 || !!(n && !(n%2));
    }

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