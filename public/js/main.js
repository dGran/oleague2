progressively.init();
var user_icon = $('#btn-user-menu figure img').attr('src');
var user_close_icon = $('#btn-user-close').attr('src');

$( document ).ready(function() {
    var mediaquery = window.matchMedia("(max-width: 768px)");
    function handleOrientationChange(mediaquery) {
        if (!mediaquery.matches) {
            $("#menu").css('display', 'none');
            $(".hamburger").removeClass('active');
        }
    }
    handleOrientationChange(mediaquery);
    mediaquery.addListener(handleOrientationChange);

    $('[data-toggle="tooltip"]').tooltip();
});

$('body').on('click touchstart', function() {
    if ( $("#user-menu").css('display') == 'block' ) {
        $('#btn-user-menu').trigger("click");
    }
    if ( $("#menu").css('display') == 'block' ) {
        $('.hamburger').trigger("click");
    }
});

$('#user-menu, #menu, .hamburger, #btn-user-menu').on('click touchstart', function(event){
    event.stopPropagation();
});

$('.hamburger').click(function() {
    if ( $("#user-menu").css('display') == 'block' ) {
        $('#btn-user-menu').trigger("click");
    }

    if ( $("#menu").css('display') == 'none' ){
        $("#menu").removeClass('animated bounceOutLeft');
        $("#menu").addClass('animated bounceInLeft');
        $("#menu").fadeIn();
        $('.hamburger').addClass('active');
    } else {
        $("#menu").fadeOut();
        $("#menu").removeClass('animated bounceInLeft');
        $("#menu").addClass('animated bounceOutLeft');
        $('.hamburger').removeClass('active');
    }
});

$('#btn-user-menu').click(function() {
    if ( $("#menu").css('display') == 'block' ) {
        $('.hamburger').trigger("click");
    }

    if ( $("#user-menu").css('display') == 'none' ){
        $("#user-menu").removeClass('animated bounceOutRight');
        $("#user-menu").addClass('animated bounceInRight');
        // $('#btn-user-menu figure img').addClass('menu-close');
        $('#btn-user-menu figure img').attr('src', user_close_icon);
        // $('#btn-user-menu figure img').css('height', '22px');
        $("#user-menu").fadeIn();
    } else {
        // $('#btn-user-menu figure img').removeClass('menu-close');
        $('#btn-user-menu figure img').attr('src', user_icon);
        // $('#btn-user-menu figure img').css('height', '100%');
        $("#user-menu").fadeOut();
        $("#user-menu").removeClass('animated bounceInRight');
        $("#user-menu").addClass('animated bounceOutRight');
    }
});

// margin bottom of bottom fixed when is visible
if ( $(".bottom-fixed").css('display') == 'block' ) {
    var margin = 8 + $('.bottom-fixed').height();
    $('.footer').css({'margin-bottom': margin + 'px'});
};

//general utils functions
function disabledActionsButtons() {
    $('a').addClass('disabled');
    $('button').attr("disabled", "disabled");
}
function enabledActionsButtons() {
    $('a').removeClass('disabled');
    $('button').attr("disabled", false);
}