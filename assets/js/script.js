$(document).ready(function() {

    $(".decrease-me").click(function(event) {
        event.preventDefault();
        $("h1, h2, p").animate({
            "font-size": "-=4px"
        });
    });

    $(".reset-me").click(function(event) {
        event.preventDefault();
        $("h1").animate({
            "font-size": "36px"
        });
        $("h2").animate({
            "font-size": "24px"
        });
        $("p").animate({
            "font-size": "14px",
            "line-height": "20px"
        });

    });

    $(".increase-me").click(function(event) {
        event.preventDefault();
        $("h1, h2, p").animate({
            "font-size": "+=4px"
        });

    });

    $(".hamburger-menu.open").click(function(){
        $("#myNav").animate({"height":"100vh"}, 100);
        $(".close .hamburger--slider").addClass("is-active");

    });

    $(".hamburger-menu.close").click(function(){
        $("#myNav").animate({"height":"0px"}, 100);
    });

});
