<?php

namespace Dev\Checkout\Plugin\Cart;

class ShippingMethodConverterPlugin
{
    public function __construct(
        \Magento\Quote\Api\Data\ShippingMethodInterfaceFactory $shippingMethodDataFactory,
    )
    {
        $this->shippingMethodDataFactory = $shippingMethodDataFactory;
    }


    /**
     * Update the data object after converting it from a model.
     *
     * @param mixed $subject - The subject object, typically the instance calling the method being intercepted
     * @param mixed $result - The original result returned by the intercepted method
     * @param mixed $rate - The rate object containing the shipping rate information
     * @return mixed - The modified result object to be returned after the interception
     */
    public function afterModelToDataObject($subject, $result, $rate)
    {
        // Create an instance of the shipping method data factory
        $extensionAttributes = $this->shippingMethodDataFactory->create()->getExtensionAttributes();

        // Check if the point rate is not set in the extension attributes
        if (!$extensionAttributes->getPointRate()) {

            // Get the point rate from the rate model, if available, otherwise set it to 0
            $pointRate = $rate->getPointRate() != null ? $rate->getPointRate() : 0;

            // Set the point rate in the extension attributes
            $extensionAttributes->setPointRate($pointRate);
        }

        // Set the modified extension attributes in the result object
        $result->setExtensionAttributes(
            $extensionAttributes
        );
        return $result;
    }


}
