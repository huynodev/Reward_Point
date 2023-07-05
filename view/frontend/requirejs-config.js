var config = {
    "map": {
        "*": {
            // override save-processor use saveShippingInformation  save donate amount in extension_attribute
            'Magento_Checkout/js/model/shipping-save-processor/default': 'Dev_Checkout/js/model/shipping-save-processor/default-override',
        }
    },
};
