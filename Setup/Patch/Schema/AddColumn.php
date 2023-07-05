<?php

namespace Dev\Checkout\Setup\Patch\Schema;

use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class AddColumn implements SchemaPatchInterface
{
    /**
     * @var SchemaSetupInterface
     */
    private $schemaSetup;

    /**
     * EnableSegmentation constructor.
     *
     * @param SchemaSetupInterface $schemaSetup
     */
    public function __construct(
        SchemaSetupInterface $schemaSetup
    )
    {
        $this->schemaSetup = $schemaSetup;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $setup = $this->schemaSetup;
        $setup->startSetup();

        $connection = $setup->getConnection();
        $saleOrderTable = $setup->getTable('sales_order');

        $quoteTable = $setup->getTable('quote');
        $quoteShippingRateTable = $setup->getTable('quote_shipping_rate');
        $customerEntityTable = $setup->getTable('customer_entity');


        if (!$connection->tableColumnExists($saleOrderTable, 'point_number')) {
            $setup->getConnection()->addColumn(
                $saleOrderTable,
                'point_number',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'nullable' => true,
                    'length' => 64,
                    'comment' => 'Point Number'
                ]
            );
        }
        if (!$connection->tableColumnExists($quoteTable, 'point_number')) {
            $setup->getConnection()->addColumn(
                $quoteTable,
                'point_number',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'nullable' => true,
                    'length' => 64,
                    'comment' => 'Point Number'
                ]
            );
        }
        if (!$connection->tableColumnExists($customerEntityTable, 'point_number')) {
            $setup->getConnection()->addColumn(
                $customerEntityTable,
                'point_number',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'nullable' => true,
                    'length' => 64,
                    'comment' => 'Point Number'
                ]
            );
        }

        if (!$connection->tableColumnExists($quoteShippingRateTable, 'point_rate')) {
            $setup->getConnection()->addColumn(
                $quoteShippingRateTable,
                'point_rate',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'nullable' => true,
                    'length' => 64,
                    'comment' => 'Point Rate'
                ]
            );
        }
        $setup->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public
    static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public
    function getAliases()
    {
        return [];
    }
}
