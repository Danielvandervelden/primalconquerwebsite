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
var counter = 0;
var navBar = document.getElementById("navbar");
let sticky = navBar.getBoundingClientRect().top;
let body = $('body');
let logo = $('.primalco-logo');

for (var i = -1, l = menuTabs.length; ++i !== l; menuTabsArray[i] = menuTabs[i]);
for (var i = -1, l = divTabs.length; ++i !== l; divTabsArray[i] = divTabs[i]);
for (var i = -1, l = characters.length; ++i !== l; charArray[i] = characters[i]);
for (var i = -1, l = charInfo.length; ++i !== l; charInfoArray[i] = charInfo[i]);

window.onscroll = throttle(stickyMenu, 20); // Sticky menu scroll eventlistener with throttle.

$(document).ready(function() {
    if (top.location.pathname !== '/') {
        $("html, body").animate({
            scrollTop: "830px"
        });
    }
});

function stickyMenu() {
    sticky = navBar.getBoundingClientRect().top;
    if (window.pageYOffset > 50) {

        $(navBar).addClass("sticky from-top");
        $(logo).addClass("sticky-fix");

    } else if (window.pageYOffset < 50) {
        $(navBar).removeClass("sticky from-top");
        $(logo).removeClass("sticky-fix");
    }
}

function fixMessage() {
    if ($('.message').length > 0) {
        $('.message').appendTo('.header-container');
    } else if (counter < 20) {
        setTimeout(fixMessage, 200);
        counter++;
    }
}

fixMessage();


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