<?php

/**
 * Class NaN_Shipping_Model_adminhtml_enabledControl
 */

/**
 * Class NaN_Shipping_Model_adminhtml_enabledControl
 * @author  NaN Team
 * @version 0.1.0
 * @package Shipping
 */
class NaN_Shipping_Model_adminhtml_enabledControl extends Mage_Core_Model_Config_Data
{
    public function _afterSave()
    {
        if (!Mage::getStoreConfig('shipping/option/checkout_multiple')) {
            return parent::_afterSave();
        }
        Mage::getSingleton('core/session')->addError(Mage::helper('nan_shipping')->__('The module can\'t be activated if the multishipping is activated. Sorry Man.'));
        Mage::getModel('core/config')->saveConfig('carriers/nan_shipping/active', 0);
        return parent::_afterSave();
    }
}

