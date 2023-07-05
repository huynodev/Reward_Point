<?php

namespace Dev\Checkout\Observer;

use Magento\Framework\Event\ObserverInterface;

class AddPointToOrderObserver implements ObserverInterface
{
    /**
     * Execute the observer logic.
     *
     * @param \Magento\Framework\Event\Observer $observer - The observer object
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        // Get the quote object from the observer
        $quote = $observer->getQuote();

        // Get the point number from the quote
        $pointNumber = $quote->getPointNumber();

        // If point number is not set, return without further processing
        if (!$pointNumber) {
            return $this;
        }

        // Save the point number in the sales_order table
        $order = $observer->getOrder();
        $order->setData('point_number', $pointNumber);

        return $this;
    }

}
