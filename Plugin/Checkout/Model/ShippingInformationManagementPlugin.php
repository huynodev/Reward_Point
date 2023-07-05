<?php

namespace Dev\Checkout\Plugin\Checkout\Model;

class ShippingInformationManagementPlugin
{
    protected $quoteRepository;

    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
    )
    {
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * Perform actions before saving the address information.
     *
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject - The subject object, typically the instance calling the method being intercepted
     * @param mixed $cartId - The ID of the cart
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation - The shipping information object
     * @return void
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement   $subject,
                                                                $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    )
    {
        // Get the extension attributes from the shipping information
        $extensionAttributes = $addressInformation->getExtensionAttributes();

        // Get the point number from the extension attributes
        $pointNumber = $extensionAttributes->getPointNumber();

        // Get the quote object for the given cart ID
        $quote = $this->quoteRepository->getActive($cartId);

        // Check if the point number is greater than 0
        if ($pointNumber > 0) {
            // Set the point number in the quote
            $quote->setPointNumber($pointNumber);
        }
    }

}
