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

    $('.view-user-profile').click(function(){
        if ($(this).closest('.user_view_container').find('.tryout').is(':hidden')){
            $(this).closest('.user_view_container').find('.tryout').css({'display': 'block'});
            $(this).html('Close User');
            $(this).addClass('view-user-profile-close');
        } else {
            $(this).closest('.user_view_container').find('.tryout').css({'display': 'none'});
            $(this).html('View User');
            $(this).removeClass('view-user-profile-close');
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

  //trigger pre and post events for faqs
$(document).on('click', '.front-faq-more', function(event){
    if ($(this).closest('.front-faq').find('.faq-text').is(':hidden')){
        $(this).closest('.front-faq').find('.faq-text').css({'display': 'block'});
        $(this).removeClass('fa-plus');
        $(this).addClass('fa-minus');

    } else {
        $(this).closest('.front-faq').find('.faq-text').css({'display': 'none'});
        $(this).removeClass('fa-minus');
        $(this).addClass('fa-plus');
    }
});

  //trigger pre and post events for faqs
$(document).on('click', '.faq-title', function(event){
    if ($(this).closest('.front-faq').find('.faq-text').is(':hidden')){
        $(this).closest('.front-faq').find('.faq-text').css({'display': 'block'});
        $(this).closest('.front-faq').find('.front-faq-more').removeClass('fa-plus');
        $(this).closest('.front-faq').find('.front-faq-more').addClass('fa-minus');

    } else {
        $(this).closest('.front-faq').find('.faq-text').css({'display': 'none'});
        $(this).closest('.front-faq').find('.front-faq-more').removeClass('fa-minus');
        $(this).closest('.front-faq').find('.front-faq-more').addClass('fa-plus');
    }
});

//trigger pre and post events for faqs forms
$(document).on('click', '.enquiry-more', function(event){
  if ($(this).closest('.enquiry-faq').find('.faq-text').is(':hidden')){
      $(this).closest('.enquiry-faq').find('.faq-text').css({'display': 'block'});
      $(this).html('-');
  } else {
      $(this).closest('.enquiry-faq').find('.faq-text').css({'display': 'none'});
      $(this).html('+');
  }
});
