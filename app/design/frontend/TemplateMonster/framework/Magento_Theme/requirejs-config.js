/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    map: {
        '*': {
            "theme": 'js/theme',
            "selectize":    "js/selectize"
        }
    },
    paths: {
        "carouselInit":     'js/carouselInit',
        "blockCollapse":    'js/sidebarCollapse',
        "animateNumber":    'js/jquery.animateNumber.min',
        "rdnavbar":         'Magento_Theme/js/jquery.rd-navbar',
        "owlcarousel":      'Magento_Theme/js/owl.carousel',
        "customSelect":     "Magento_Theme/js/select2"
    },
    shim: {
        "rdnavbar":         ["jquery"],
        "owlcarousel":      ["jquery"],
        "animateNumber":    ["jquery"]
    },
    deps: [
        "jquery",
        "jquery/jquery.mobile.custom",
        "mage/common",
        "mage/dataPost",
        "mage/bootstrap"
    ]
};