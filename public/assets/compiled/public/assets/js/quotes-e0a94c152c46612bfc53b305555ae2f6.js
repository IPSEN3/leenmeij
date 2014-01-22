jQuery(document).ready(function($) {

   

    // quotes scroll
    var scrollSpeed = 80;
    var current = 0;
    var direction = 'h';

    function bgscroll()
    {
        current -= 1;
        $('#quotes').css("backgroundPosition", (direction == 'h') ? current+"px 0" : "0 " + current+"px");
    }
    setInterval(bgscroll, scrollSpeed);

    // quotes fade
    $('#quote > li').hide();
    $('#quote > li').fadeLoop({ fadeIn: 1000, stay: 5000, fadeOut: 500 });

});