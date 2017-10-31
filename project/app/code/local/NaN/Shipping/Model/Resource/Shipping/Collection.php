<?php

/**
 * Nan Shipping
 */

/**
 * Nan Shipping Model Resource Category Collection
 * Nan Shipping Resource Collection Model.
 * @author  Nan Team <nan.dev.team@gmail.com>
 * @version 0.1.0
 * @package shipping
 */
class NaN_Shipping_Model_Resource_Shipping_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    /**
     * _construct
     */
    public function _construct()
    { //Construct di Variant
        $this->_init("nan_shipping/shipping");
    }
}
