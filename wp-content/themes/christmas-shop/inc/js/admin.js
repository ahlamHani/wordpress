jQuery(document).ready(function($) {
    "use strict";

    //FontAwesome Icon Control JS
    $('body').on('click', '.christmas-shop-icon-list li', function(){
        var icon_class = $(this).find('i').attr('class');
        $(this).addClass('icon-active').siblings().removeClass('icon-active');
        $(this).parent('.christmas-shop-icon-list').prev('.christmas-shop-selected-icon').children('i').attr('class','').addClass(icon_class);
        $(this).parent('.christmas-shop-icon-list').next('input').val(icon_class).trigger('change');
    });

    $('body').on('click', '.christmas-shop-selected-icon', function(){
        $(this).next().slideToggle();
    });

});
