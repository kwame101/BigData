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


    $('.showMoreFaq').click(function(){
        if ($(this).closest('.admin-faq').find('.faq-text').is(':hidden')){
            $(this).closest('.admin-faq').find('.faq-text').css({'display': 'block'});
        } else {
            $(this).closest('.admin-faq').find('.faq-text').css({'display': 'none'});
        }
    });


    $('.enquiry-more').click(function(){
        alert('test');
        if ($(this).closest('.enquiry-faq').find('.faq-text').is(':hidden')){
            $(this).closest('.enquiry-faq').find('.faq-text').css({'display': 'block'});
        } else {
            $(this).closest('.enquiry-faq').find('.faq-text').css({'display': 'none'});
        }
    });


    $('.front-faq-more').click(function(){
        if ($(this).closest('.front-faq').find('.faq-text').is(':hidden')){
            $(this).closest('.front-faq').find('.faq-text').css({'display': 'block'});
        } else {
            $(this).closest('.front-faq').find('.faq-text').css({'display': 'none'});
        }
    });


    $('.view-user-profile').click(function(){
        if ($(this).closest('.user_view_container').find('.tryout').is(':hidden')){
            $(this).closest('.user_view_container').find('.tryout').css({'display': 'block'});
        } else {
            $(this).closest('.user_view_container').find('.tryout').css({'display': 'none'});
        }
    });

    $('.topic').click(function(){
        alert(this);
    });

    // $('.admin-enquiry li').click(function(){
    //     if($(this).hasClass('admin-enquiry-li-active')){
    //         $(this).removeClass('admin-enquiry-li-active');
    //     } else {
    //         $(this).addClass('admin-enquiry-li-active')
    //     }
    // });

});
