<?php

namespace Dev\Checkout\Plugin\Admin\Order;

class TotalsAddPoint
{

    protected $dataObject;

    public function __construct(
        \Magento\Framework\DataObject $dataObject
    )
    {
        $this->dataObject = $dataObject;
    }

    /**
     * Perform actions before getting the totals.
     *
     * @param mixed $totals - The totals object
     * @return void
     */
    public function beforeGetTotals($totals)
    {
        // Check if the 'point_number' total is not already set
        if (!$totals->getTotal('point_number')) {
            // Get the order object from the totals
            $order = $totals->getOrder();

            // Create an array with the data for the 'point_number' total
            $totalData = [
                'code' => 'point_number',
                'strong' => false,
                'value' => $order->getPointNumber() != null ? $order->getPointNumber() : 0,
                'label' => __('Point Number'),
                'is_formated' => true,
            ];

            // Set the data in the data object
            $this->dataObject->setData($totalData);

            // Add the 'point_number' total to the totals object
            $totals->addTotal($this->dataObject);
        }
    }

}
