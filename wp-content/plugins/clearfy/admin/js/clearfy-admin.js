(function( $ ) {
    'use strict';

    $(function() {


        var plugin_name = 'clearfy';


        $('.js-wpshop-instruction-expand').click(function(){
            $('.js-wpshop-instruction-body').slideToggle();
        });


        /**
         * Tabs
         */
        if (readCookie("tab-" + plugin_name) != null) {
            var tab_id = readCookie("tab-" + plugin_name);
            var $tab = $('.js-' + plugin_name + ' #' + tab_id);

            if ($tab.length) {
                $('.js-wpshop-tab-wrapper a').removeClass('wpshop-tab-active');
                $('.js-' + plugin_name + ' #tab-' + tab_id + '').addClass('wpshop-tab-active');

                jQuery('.js-wpshop-tab-item').removeClass('active');
                jQuery("#" + tab_id).addClass('active');
            }
        }

        $('.js-' + plugin_name).on('click', '.js-wpshop-tab-wrapper a', function () {
            jQuery('.js-wpshop-tab-wrapper').find('a').removeClass('wpshop-tab-active');
            jQuery(this).addClass('wpshop-tab-active');

            createCookie("tab-" + plugin_name, jQuery(this).attr("id").replace("tab-", ""));

            jQuery('.js-wpshop-tab-item').removeClass('active');
            jQuery("#" + jQuery(this).attr("id").replace("tab-", "")).addClass('active');

            return false;
        });

        /**
         * Tabs
         */
        /*if (readCookie("clearfy-tab") != null) {
            var tab_id = readCookie("clearfy-tab");
            var $tab = $('#' + tab_id);

            if ($tab.length) {
                $('.js-tab-wrapper a').removeClass('nav-tab-active');
                $('#' + tab_id + '-tab').addClass('nav-tab-active');

                $('.js-tab-item').removeClass('active');
                $tab.addClass('active');
            }
        }

        jQuery('.js-tab-wrapper a').click(function () {
            jQuery('.js-tab-wrapper').find('a').removeClass('nav-tab-active');
            jQuery(this).addClass('nav-tab-active');

            createCookie("clearfy-tab", jQuery(this).attr("id").replace("-tab", ""));

            jQuery('.js-tab-item').removeClass('active');
            jQuery("#" + jQuery(this).attr("id").replace("-tab", "")).addClass('active');
        });*/

        /**
         * Top buttons
         */
        jQuery('.js-clearfy-recommend').click(function(){
            jQuery('.js-clearfy-form').find(':checkbox').prop('checked', false);
            jQuery('.clearfy-recommend').parents('label').find('input').prop('checked', true);
        });

        jQuery('.js-clearfy-enable').click(function(){
            jQuery('.js-clearfy-form').find(':checkbox').prop('checked', true);
        });

        jQuery('.js-clearfy-disable').click(function(){
            jQuery('.js-clearfy-form').find(':checkbox').prop('checked', false);
        });

    });

})( jQuery );

function createCookie(name, value, days) {
    var expires;

    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = encodeURIComponent(name) + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}
