<?php

namespace Dev\Checkout\Block\Adminhtml\Order\View;

class PointNumber extends \Magento\Backend\Block\Template
{
    /**
     * Get the order object based on the order ID from the request.
     */
    public function getOrder()
    {
        $orderId = $this->getRequest()->getParam('order_id');
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $order = $objectManager->create('\Magento\Sales\Model\OrderRepository')->get($orderId);
        return $order;
    }
}
