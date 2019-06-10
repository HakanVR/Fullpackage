define([
    "jquery",
    "matchMedia",
    "menu"
], function ($, mediaCheck) {
    "use strict";

    $.widget('TemplateMonster.megamenu', $.mage.menu, {

        _create: function() {
            var megamenu = $('.tm-megamenu', this.element);

            this._super();
            this._toggleClass(megamenu);
            this._setWidthMegamenu(megamenu);
        },

        _setOption: function( key, value ) {
            this._super( "_setOption", key, value );
        },

        _open: function( submenu ) {
            this._super( submenu );

            if (submenu.is(this.options.differentPositionMenus)) {
                var position = $.extend({
                    of: this.active
                }, this.options.differentPosition );
                submenu.position( position );
            }
        },

        _toggleClass: function( selector ) {
            var ownClass = 'megamenu-wrapper';
            mediaCheck({
                media: '(max-width: 767px)',
                entry: function () { 
                    selector.removeClass(ownClass);
                },
                exit: function ()  {
                    if( !selector.hasClass(ownClass) ) {
                        selector.addClass(ownClass);
                    }
                }
            });
        },

        _setWidthMegamenu: function( selector ) {
            if(selector.hasClass('in-sidebar')){
                $(window).on('resize.menu', function(){
                    var pageWidth = $('.columns').innerWidth();
                    var sidebarWidth = $('.sidebar .navigation').innerWidth();
                    console.log(sidebarWidth);
                    selector.css('min-width', pageWidth - sidebarWidth);
                }).trigger('resize.menu');
            }
        }

    });

    return $.TemplateMonster.megamenu;
});