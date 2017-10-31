<?php
/**
 * Nan Shipping
 */

/**
 * News Revenge Model Data
 * Nan Shipping Model.
 * @author  Nan Team <nan.dev.team@gmail.com>
 * @version 0.1.0
 * @package shipping
 */
class NaN_Shipping_Model_Shipping extends Mage_Core_Model_Abstract
{

    /**
     * _construct
     */
    public function _construct()
    {
        $this->_init("nan_shipping/shipping");
    }
}
