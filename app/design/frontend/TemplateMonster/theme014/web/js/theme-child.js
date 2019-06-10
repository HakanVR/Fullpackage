define([
    'jquery',
    'jquery/ui',
    'theme'
], function ($) {
    'use strict';

    $.widget('TemplateMonster.themeChild', $.TemplateMonster.theme, {

        options: {},
        home_carusel_new: function () {
            $(".block-new-products .product-items").owlCarousel({
                items: 4,
                autoPlay: 1400000,
                stopOnHover: true,
                pagination: false,
                transitionStyle: false,
                navigation: true
            });

        },
        title_wrap: function () {
            var class_title = $('.block-title strong, .page-title .base');
            $(class_title).each(function () {
                var str = $(this).html();
                var pos = str.lastIndexOf(' ');
                if(pos > 0){
                    str = str.substr(0, pos) + ' <b>' + str.substr(pos + 1) + '</b>';
                    $(this).html(str);
                }
            });
        },


        cursor_search: function () {
            $('.rd-navbar-search-toggle').on("click", function () {
                setTimeout(function() {
                    $('.rd-navbar-search #search').focus();
                }, 200);
            });
        },
        _homePageCarousel: function () {
            $('.man-carousel').carouselInit({
                items : 8,
                itemsDesktop : [1199,4],
                itemsDesktopSmall : [980,3],
                itemsTablet: [768,2],
                itemsTabletSmall: false,
                itemsMobile : [479,1]
            });
        },
        _create: function () {
            this._super();
            this.home_carusel_new();
            this.title_wrap();
            this.cursor_search();
            this._homePageCarousel();
            $('body', 'html').on('click', function (event) {
                var filter = $(event.target).parents("div.filter-options");
                console.log(filter);
                console.log(filter.length);
                if(!filter.length){
                    $('#narrow-by-list').accordion("disable").accordion("enable");
                }
            });
        }
    });
    return $.TemplateMonster.themeChild;

});