/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

/* eslint-disable no-undef */
// jscs:disable jsDoc
require([
    'jquery',
    'Magento_Ui/js/modal/confirm',
    'Magento_Ui/js/modal/alert',
    'loadingPopup',
    'mage/backend/floating-header'
], function (jQuery, confirm) {
    'use strict';

    function openProductList(url, isRoot) {
        if ($('browser_window') && typeof(Windows) != 'undefined') {
            Windows.focus('browser_window');
            return;
        }
        var dialogWindow = Dialog.info(null, {
            closable: true,
            resizable: false,
            draggable: true,
            className: 'magento',
            windowClassName: 'popup-window',
            title: 'Manage Catalog Positions',
            top: 50,
            width: 1000,
            height: 1000,
            zIndex: 1000,
            recenterAuto: false,
            hideEffect: Element.hide,
            showEffect: Element.show,
            id: 'browser_window',
            url: url,
            onClose: function (param, el) {
            }
        });
    }

    window.openProductList = openProductList;

});
