define([
    'jquery',
    'mage/smart-keyboard-handler',
    'jquery/ui',
    'mage/mage',
    'mage/ie-class-fixer',
    'rdnavbar',
    'carouselInit',
    'blockCollapse',
    'animateNumber',
    'selectize'
], function ($, keyboardHandler, selectize) {
    'use strict';

    $.widget('TemplateMonster.theme', {

        options: {
            rdnavbar: {
                selector: ".rd-navbar",
                params: {
                    stickUpClone: true,
                    stickUpOffset: "100%",
                    responsive: {
                        0: {
                            layout: "rd-navbar-fixed",
                            stickUp: true
                        },
                        768: {
                            layout: "rd-navbar-static",
                            stickUp: true
                        }
                    }
                }
            },
            cartSummaryContainer: {
                selector: ".cart-summary",
                params: {
                    container: "#maincontent"
                }
            },
            relatedCarousel: {
                selector: ".block.related .product-items",
                params: {
                    items: 4
                }
            },
            upsellCarousel: {
                selector: ".block.upsell .product-items",
                params: {
                    items: 4
                }
            },
            crosssellCarousel: {
                selector: ".block.crosssell .product-items",
                params: {
                    items: 4
                }
            },
            animatedCounter: {
                selector: ".skills .number",
                speed: 2000
            },
            testimonialsCarousel: {
                selector: ".owl-testimonials",
                params: {
                    items: 1,
                    itemsDesktop: [1199, 1],
                    itemsDesktopSmall: [979, 1],
                    itemsTablet: [768, 1],
                    itemsMobile: [400, 1],
                    nav: true,
                    navigationText: [],
                    loop: true,
                    dots: false,
                    autoPlay: true,
                    autoplay: 3000,
                    autoplayTimeout: 2000,
                    autoplayHoverPause: true
                }
            },
            messageClear: {
                selector: ".messages"
            },
            customSelect: {
                selector: "#product-options-wrapper .product-custom-option, #product-review-container select",
            }
        },

        _rdNavbar: function () {
            /* Navbar init */
            var rdNavbarData = this.options.rdnavbar;
            var o = $(rdNavbarData.selector);
            if (o.length > 0) {
                o.RDNavbar(rdNavbarData.params);
            }
        },

        _checkoutCollapsible: function () {
            if ($('body').hasClass('checkout-cart-index')) {
                if ($('#co-shipping-method-form .fieldset.rates').length > 0 && $('#co-shipping-method-form .fieldset.rates :checked').length === 0) {
                    $('#block-shipping').on('collapsiblecreate', function () {
                        $('#block-shipping').collapsible('forceActivate');
                    });
                }
            }
        },

        _cartSummaryContainer: function () {
            var cartSummaryData = this.options.cartSummaryContainer;
            $(cartSummaryData.selector).mage('sticky', cartSummaryData.params);
        },

        _keyboardHandlerApply: function () {
            keyboardHandler.apply();
        },

        _sidebarCollapsible: function () {
            /* Sidebar block collapse in mobile */
            var block = $(".sidebar-additional .block");
            if (block.length > 0) {
                block.sidebarCollapse();
            }
        },

        _productsCarousel: function () {
            /* Related init */
            var relatedCarouselData = this.options.relatedCarousel;
            $(relatedCarouselData.selector).carouselInit(relatedCarouselData.params);

            /* Upsell init */
            var upsellCarouselData = this.options.upsellCarousel;
            var items = 4,
                upsellLimit = $('.block.upsell').data('limit'),
                itemsCount = 1;
            if (upsellLimit != 0) {
                $('.block.upsell .product-item').each(function () {
                    if (itemsCount > upsellLimit) {
                        $(this).remove();
                    }
                    itemsCount++;
                });
            }
            var upsellParams = $.extend(true, {}, upsellCarouselData.params, {items: items});
            $(upsellCarouselData.selector).carouselInit(upsellParams);

            /* Crosssell init */
            var crosssellCarouselData = this.options.crosssellCarousel;
            $(crosssellCarouselData.selector).carouselInit(crosssellCarouselData.params);
        },

        _animatedCounter: function () {
            var animatedCounterData = this.options.animatedCounter;
            var number = $(animatedCounterData.selector);
            if (number.length > 0) {
                number.each(function () {
                    var finish = $(this).data('finish');
                    $(this).animateNumber({number: finish}, animatedCounterData.speed);
                })
            }
        },

        _testimonialsCarousel: function () {
            var testimonialsData = this.options.testimonialsCarousel;
            $(testimonialsData.selector).carouselInit(testimonialsData.params);
        },

        _messageClear: function () {
            var messageClearData = this.options.messageClear;
            $(messageClearData.selector).click(function () {
                $('.message', this).hide();
            })
        },

        _customSelect: function () {
            var customSelectData = this.options.customSelect;
            $(customSelectData.selector).selectize();
        },

        _create: function () {
            this._rdNavbar();
            this._checkoutCollapsible();
            this._cartSummaryContainer();
            this._keyboardHandlerApply();
            this._sidebarCollapsible();
            this._productsCarousel();
            this._animatedCounter();
            this._testimonialsCarousel();
            this._messageClear();
            this._customSelect();
        }
    });

    return $.TemplateMonster.theme;

});