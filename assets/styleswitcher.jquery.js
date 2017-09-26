jQuery.fn.styleSwitcher = function(){
    $(this).click(function(){
        loadStyleSheet(this);
        return false;
    });
    function loadStyleSheet(obj) {
        $('body').append('<div id="overlay" />');
        $('body').css({height:'100%'});
        $('#overlay')
            .css({
                display: 'none',
                position: 'absolute',
                top:0,
                left: 0,
                width: '100vw',
                height: '100vh',
                zIndex: 1000,
                background: 'black'
            })
            .fadeIn(100,function(){
                $.get( obj.href+'&js',function(data){
                    $('#stylesheet').attr('href','<?php echo base_url(); ?>/assets/' + data + '.css');
                    cssDummy.check(function(){
                        $('#overlay').fadeOut(500,function(){
                            $(this).remove();
                        });
                    });
                });
            });
    }
    var cssDummy = {
        init: function(){
            $('<div id="dummy-element" style="display:none" />').appendTo('body');
        },
        check: function(callback) {
            if ($('#dummy-element').width()==2) callback();
            else setTimeout(function(){cssDummy.check(callback)}, 200);
        }
    }
    cssDummy.init();
}