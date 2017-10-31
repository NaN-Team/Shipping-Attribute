<?php
/**
 * Nan Shipping
 */

/**
 * Nan Shipping Model Data
 *
 * Category Model.
 *
 * @author Nan Team <nan.dev.team@gmail.com>
 * @version 0.1.0
 * @package shipping
 */

class NaN_Shipping_Model_Resource_DateShipping extends Mage_Core_Model_Resource_Db_Abstract {

    /**
     * _construct
     */
    public function _construct(){ //Construct di Variant
        $this->_init("nan_shipping/nan_date_shipping", "date_shipping_id");
    }
}