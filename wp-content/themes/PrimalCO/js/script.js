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

for (var i = -1, l = menuTabs.length; ++i !== l; menuTabsArray[i] = menuTabs[i]);
for (var i = -1, l = divTabs.length; ++i !== l; divTabsArray[i] = divTabs[i]);
for (var i = -1, l = characters.length; ++i !== l; charArray[i] = characters[i]);
for (var i = -1, l = charInfo.length; ++i !== l; charInfoArray[i] = charInfo[i]);

function fixNotice() {
    
    if($('.registration-notice').length > 0 && $('.form-wrapper.register').length > 0) {
        $('.registration-notice').prependTo('.form-wrapper.register');
    } else if(counter < 20) {
        setTimeout(fixNotice, 200);
        counter++;
    }
};

fixNotice();

function fixMessage() {
    if ($('.message').length > 0) {
        $('.message').prependTo('.main-content-container');
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

charArray.forEach(function (char) {
    $(char).click(function () {
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

