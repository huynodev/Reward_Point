<?php

namespace Dev\Checkout\Model\Cart;

use Dev\Checkout\Api\Data\ShippingMethodExtensionInterface;

class ShippingMethodExtension implements ShippingMethodExtensionInterface
{
    /**
     * @var float
     */
    private $pointRate;

    /**
     * @return float
     */
    public function getPointRate()
    {
        return $this->pointRate;
    }

    /**
     * @param float $ratio
     * @return void
     */
    public function setPointRate($ratio)
    {
        $this->pointRate = $ratio;
    }
}
