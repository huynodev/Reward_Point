<?php

namespace Dev\Checkout\Plugin\Quote\Address;

class ImportShippingRatePlugin
{
    /**
     * Set the PointRate value on the result object after importing the shipping rate
     *
     * @param mixed $subject - The subject object, typically the instance calling the method being intercepted
     * @param mixed $result - The original result returned by the intercepted method
     * @param mixed $rate - The rate object containing the shipping rate information
     * @return mixed - The modified result object to be returned after the interception
     */
    public function afterImportShippingRate($subject, $result, $rate)
    {
        // Check if the $rate object is an instance of \Magento\Quote\Model\Quote\Address\RateResult\Method
        if ($rate instanceof \Magento\Quote\Model\Quote\Address\RateResult\Method) {

            // Set the PointRate value from the $rate object to the $result object
            $result->setPointRate(
                $rate->getPointRate()
            );
        }
        return $result;
    }
}
