<?php

/**
 * Class NaN_Shipping_Model_Source_Options
 */

/**
 * Class NaN_Shipping_Model_Source_Options
 */

class NaN_Shipping_Model_Source_Options
{

    public function toOptionArray()
    {
        return array(
            'm' => Mage::helper('nan_shipping')->__('Morning'),
            'a' => Mage::helper('nan_shipping')->__('Afternoon'),
            'e' => Mage::helper('nan_shipping')->__('Evening'),
        );
    }
}

