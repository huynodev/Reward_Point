define([
    'jquery',
    'underscore',
    'Magento_Checkout/js/view/summary/abstract-total',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/shipping-service',
    'Magento_Checkout/js/model/shipping-rate-processor/new-address',
    'Magento_Checkout/js/model/shipping-rate-processor/customer-address',
    'Magento_Checkout/js/model/shipping-rate-registry'
], function ($, _, Component, quote, shippingService, newAddressProcessor, customerAddressProcessor, rateRegistry) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Dev_Checkout/summary/point'
        },
        quoteIsVirtual: quote.isVirtual(),
        totals: quote.getTotals(),

        isCalculated: function () {
            return this.totals() && this.isFullMode() && quote.shippingMethod() != null; //eslint-disable-line eqeqeq
        },

        getPointRate: function () {
            var shippingMethod = quote.shippingMethod();
            return shippingMethod.extension_attributes.point_rate;
        },

        getValue: function () {
            var grandTotal, point;
            if (!this.isCalculated()) {
                return this.notCalculatedMessage;
            }
            grandTotal = this.totals()['grand_total'];
            point = grandTotal * this.getPointRate() / 100;
            return Math.round(point);
        }
    });
});
