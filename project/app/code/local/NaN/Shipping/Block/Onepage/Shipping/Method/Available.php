<?php

/**
 * Class NaN_Shipping_Block_Onepage_Shipping_Method_Available
 */

/**
 * Class NaN_Shipping_Block_Onepage_Shipping_Method_Available
 * @author NaN Team
 * @version 0.1.0
 * @package Shipping
 */
class NaN_Shipping_Block_Onepage_Shipping_Method_Available extends Mage_Checkout_Block_Onepage_Abstract
{
    /** From Mage_Checkout_Block_Onepage_Shipping_Method_Available */
    protected $_rates;
    protected $_address;

    public function getShippingRates()
    {

        if (empty($this->_rates)) {
            $this->getAddress()->collectShippingRates()->save();

            $groups = $this->getAddress()->getGroupedAllShippingRates();
            /*
            if (!empty($groups)) {
                $ratesFilter = new Varien_Filter_Object_Grid();
                $ratesFilter->addFilter(Mage::app()->getStore()->getPriceFilter(), 'price');

                foreach ($groups as $code => $groupItems) {
                    $groups[$code] = $ratesFilter->filter($groupItems);
                }
            }
            */

            return $this->_rates = $groups;
        }

        return $this->_rates;
    }

    public function getAddress()
    {
        if (empty($this->_address)) {
            $this->_address = $this->getQuote()->getShippingAddress();
        }
        return $this->_address;
    }

    public function getCarrierName($carrierCode)
    {
        if ($name = Mage::getStoreConfig('carriers/'.$carrierCode.'/title')) {
            return $name;
        }
        return $carrierCode;
    }

    public function getAddressShippingMethod()
    {
        return $this->getAddress()->getShippingMethod();
    }

    public function getShippingPrice($price, $flag)
    {
        return $this->getQuote()->getStore()->convertPrice(Mage::helper('tax')->getShippingPrice($price, $flag, $this->getAddress()), true);
    }

    /** End from Mage_Checkout_Block_Onepage_Shipping_Method_Available */

    /**
     * loadTimeInput
     * @param $carrierCode
     * @return bool
     */
    public function loadTimeInput($carrierCode)
    {
        $haveTime = Mage::getStoreConfig('carriers/' . $carrierCode . '/input_time');
        if (!$haveTime) {
            return false;
        }
        //if the carrier have the date time input enabled
        return true;
    }
}
