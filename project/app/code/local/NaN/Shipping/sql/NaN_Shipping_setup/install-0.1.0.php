<?php
/**
 * Nan_Shipping
 */

/**
 * Installer 0.1.0
 * MySQL installer.
 * @author NaN Team <nan.team.dev@gmail.com>
 * @version 0.1.0
 * @package shipment
 */

/** @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;
$installer->startSetup();

$tableNanDateShipping = $installer->getConnection()->newTable($installer->getTable("nan_shipping/nan_date_shipping"));

$tableNanDateShipping->addColumn(
    "date_shipping_id",
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    null,
    array("primary" => true, "identity" => true, "nullable" => false),
    "ID"
)->addColumn(
    "order_id",
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    null,
    array("nullable" => false),
    "Order Id Fk"
)->addColumn(
    "date_value",
    Varien_Db_Ddl_Table::TYPE_TEXT,
    64,
    array("nullable" => false),
    "Date Value"
)->addForeignKey(
    $installer->getFkName('nan_shipping/nan_date_shipping', 'order_id', 'sales/order', 'entity_id'),
    'order_id',
    $installer->getTable('sales/order'),
    'entity_id',
    Varien_Db_Ddl_Table::ACTION_SET_NULL,
    Varien_Db_Ddl_Table::ACTION_SET_NULL
);

$installer->getConnection()->createTable($tableNanDateShipping);

$installer->endSetup();