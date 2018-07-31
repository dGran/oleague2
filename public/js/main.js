$(document).ready(function() {
    setTimeout(function() {
        $(".autohide").fadeTo(1000, 500).slideUp(500, function(){
            $(".autohide").slideUp(500);
        });
    }, 2000);
});
