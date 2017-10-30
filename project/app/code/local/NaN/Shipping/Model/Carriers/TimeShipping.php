<?php

/**
 * Class NaN_Shipping_Model_TimeShipping
 */

/**
 * Class NaN_Shipping_Model_TimeShipping
 * Main Model
 * @author  NaN Team
 * @version 0.1.0
 * @package Shipping
 */
class NaN_Shipping_Model_Carriers_TimeShipping
    extends Mage_Shipping_Model_Carrier_Abstract
    implements Mage_Shipping_Model_Carrier_Interface
{
    /** @var string $_code */
    protected $_code = 'nan_shipping';

    /** @var bool $_isFixed */
    protected $_isFixed = true;

    /**
     * collectRates
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return bool|false|Mage_Core_Model_Abstract|Mage_Shipping_Model_Rate_Result
     */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        if (!$this->getConfigData('active')) {
            return false;
        }

        $result = Mage::getModel('shipping/rate_result');
        $shippingPrice = $this->getFinalPriceWithHandlingFee($this->getConfigData('price'));

        if ($shippingPrice !== false) {
            $method = Mage::getModel('shipping/rate_result_method');

            $method->setCarrier($this->_code);
            $method->setCarrierTitle($this->getConfigData('title'));

            $method->setMethod($this->_code);
            $method->setMethodTitle($this->getConfigData('name'));

            if ($request->getFreeShipping() === true) {
                $shippingPrice = '0.00';
            }

            $method->setPrice($shippingPrice);
            $method->setCost($shippingPrice);

            $result->append($method);
        }

        return $result;
    }

    /**
     * getAllowedMethods
     * @return array
     */
    public function getAllowedMethods()
    {
        return array(
            $this->_code => $this->getConfigData('name'),
        );
    }
}

