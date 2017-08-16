/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

/* eslint-disable no-undef */
// jscs:disable jsDoc
require([
    'jquery',
    'underscore',
    'mage/template',
    'loadingPopup',
    'jquery/ui'
], function (jQuery) {
    'use strict';


    var startIndexNo = jQuery('#start_index').val();
    if (!startIndexNo || startIndexNo == undefined) {
        startIndexNo = 1;
    }
    startIndexNo = parseInt(startIndexNo);
    jQuery("#products").sortable({
        stop: function (e, ui) {
            jQuery.map(jQuery(this).find('li'), function (el) {
                jQuery('#' + el.id).find('input').val(parseInt(jQuery(el).index()) + startIndexNo);
            });
        },
        create: function (event, ui) {
            jQuery.map(jQuery(this).find('li'), function (el) {
                jQuery('#' + el.id).find('input').val(parseInt(jQuery(el).index()) + startIndexNo);
            });
        }
    });

    function submitPositionForm(url)
    {
        if ($('browser_window') && typeof(Windows) != 'undefined') {
            Windows.focus('browser_window');
            return;
        }

        var form = jQuery('#edit_position_form');
        jQuery.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(),
            dataType: 'json',
            showLoader: true
        }).success(function (response) {
            location.reload();
        });

    }

    function changePageLimit()
    {
        location.href = $('limiter').value;
    }


    window.submitPositionForm = submitPositionForm;
    window.changePageLimit = changePageLimit;

});
