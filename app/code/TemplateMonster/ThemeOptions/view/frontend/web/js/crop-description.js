/**
 * Copyright © 2015. All rights reserved.
 */

define([
    'jquery',
    'matchMedia',
], function($, mediaCheck){
    "use strict";

    $.widget('TemplateMonster.cropDescription', {

        options: {
            desktop: 0,
            tablet: 0,
            mobile: 0,
        },

        _create: function() {
            var descBlock = this.element,
                descBlockText = descBlock.text();

            if (descBlockText.length > 0) {
                this._checkPlatform(descBlock, descBlockText);
                descBlock.fadeIn("slow");
            } 
        },       

        _checkPlatform: function(descriptionBlock, descriptionText) {
            var desktop = this.options.desktop,
                tablet  = this.options.tablet,
                mobile  = this.options.mobile,
                description = this;

            // Desktop
            mediaCheck({
                media: '(min-width: 1200px)',
                entry: function () {
                    description._crop(desktop, descriptionBlock, descriptionText);
                },
            });

            // Tablet
            mediaCheck({
                media: '(min-width: 768px) and (max-width: 1199px)',
                entry: function () {
                    description._crop(tablet, descriptionBlock, descriptionText);
                },
            });

            // Mobile
            mediaCheck({
                media: '(max-width: 767px)',
                entry: function () {
                    description._crop(mobile, descriptionBlock, descriptionText);
                },
            });
        },

        _crop: function(platform, descriptionBlock, descriptionText) {
            var description = this;

            if (platform != 0) {
                descriptionBlock.text(description._sliceDescription(descriptionText, platform));
            } else {
                descriptionBlock.text(descriptionText);
            }
        },

        _sliceDescription: function(description, symbols) {
            var sliced = description.slice(0, symbols);
            if (sliced.length < description.length) {
                sliced += '...';
            }
            return sliced;
        },
    });

    return $.TemplateMonster.cropDescription;

});
