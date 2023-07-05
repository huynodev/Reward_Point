<?php

namespace Dev\Checkout\Api\Data;

interface ShippingMethodExtensionInterface
{
    /**
     * @return float
     */
    public function getPointRate();

    /**
     * @param float $ratio
     * @return void
     */
    public function setPointRate($ratio);
}
