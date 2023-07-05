<?php

namespace Dev\Checkout\Plugin\Admin\Customer;

use Magento\Framework\App\Request\Http;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Controller\Result\RedirectFactory;

class SavePointNumberPlugin
{
    public function __construct(
        Http               $request,
        ResourceConnection $resourceConnection,
        RedirectFactory    $redirectFactory
    )
    {
        $this->request = $request;
        $this->resourceConnection = $resourceConnection;
        $this->redirectFactory = $redirectFactory;
    }

    /**
     * Update customer point
     *
     * @param mixed $subject - The subject object, typically the instance calling the method being intercepted
     * @param mixed $result - The original result returned by the intercepted method
     * @return mixed - The result after performing the additional actions
     */
    public function afterExecute($subject, $result)
    {
        // Get the order ID from the request parameters
        $orderId = $this->request->getParam('order_id');

        // Get the database connection and table names
        $connection = $this->resourceConnection->getConnection();
        $salesOrderTable = $this->resourceConnection->getTableName('sales_order');
        $customerTable = $this->resourceConnection->getTableName('customer_entity');

        // Create a query to fetch customer and order information
        $query = $connection->select()
            ->from(['ce' => $customerTable], ['ce.entity_id as customer_id', 'ce.email', 'ce.point_number as customer_point'])
            ->joinLeft(
                ['so' => $salesOrderTable],
                'ce.entity_id = so.customer_id',
                ['so.entity_id as order_id', 'so.point_number as order_point']
            )
            ->where('so.entity_id = ?', $orderId);

        // Fetch the customer information related to the order
        $customerWhereOrder = $connection->fetchRow($query);

        // Check if customer information is found for the order
        if ($customerWhereOrder) {
            // Retrieve the customer point and order point, set them to 0 if null
            $customerPoint = $customerWhereOrder['customer_point'] != null ? $customerWhereOrder['customer_point'] : 0;
            $orderPoint = $customerWhereOrder['order_point'] != null ? $customerWhereOrder['order_point'] : 0;

            // Calculate the updated point value
            $pointUpdate = $customerPoint + $orderPoint;

            // Update the customer's point number in the database
            $connection->update($customerTable, ['point_number' => $pointUpdate], 'entity_id = ' . $customerWhereOrder['customer_id']);
        }
        return $result;
    }

}
