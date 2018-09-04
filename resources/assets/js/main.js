$(function() {
    setTimeout(function() {
        $(".autohide").fadeTo(1000, 500).slideUp(500, function(){
            $(".autohide").slideUp(500);
        });
    }, 2000);

    $('.search-clear').on("click", function() {
        $('.search-input').val('');
    });
    $('.search-input').keydown(function(e){
        if (e.keyCode == 27) {
            $(this).val('');
        }
    });
    $(".search-input").focus(function(){
        $(this).select();
    });
});

$("#btn-menu").click(function(){
    if ($(".sidebar-mobile").is(':visible')) {
        $(this).children('i').removeClass('fa-times');
        $(this).children('i').addClass('fa-bars');
        $('.sidebar-mobile').hide();
    } else {
        $(this).children('i').removeClass('fa-bars');
        $(this).children('i').addClass('fa-times');
        $('.sidebar-mobile').show();
    }
});