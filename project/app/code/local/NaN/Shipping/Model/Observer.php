<?php

/**
 * Class NaN_Shipping_Model_Observer
 */

/**
 * Class NaN_Shipping_Model_Observer
 * Observer for save action on
 */
class NaN_Shipping_Model_Observer extends Mage_Core_Model_Abstract
{
    /**
     * saveShippingMethod
     * @param Varien_Event_Observer $event_Observer
     */
    public function saveShippingMethod(Varien_Event_Observer $event_Observer)
    {
        /** @var Mage_Core_Controller_Request_Http $request */
        $request = $event_Observer->getRequest();
        /** @var Mage_Sales_Model_Quote $quote */
        $quote = $event_Observer->getQuote();
        $shippingTime = $request->getPost('shipping_time', false);
        //if shipping_method not setted or shipping_time not selected discard this event
        if (!$request->getPost('shipping_method', false) || !$shippingTime) {
            return;
        }
        //if the shipping_method selected don't have enabled the time choose
        if (!Mage::getStoreConfig('carriers/' . ($quote->getShippingAddress()->getShippingRateByCode($request->getPost('shipping_method'))->getCarrier()) . '/input_time')) {
            return;
        }
        Mage::getSingleton('core/session')->setShippingTime($shippingTime);
        Mage::log('Saved session content the shipping time: ' . Mage::getSingleton('core/session')->getShippingTime());
    }

    /**
     * saveOrderWithShippingTime
     * @param Varien_Event_Observer $event_Observer
     */
    public function saveOrderWithShippingTime(Varien_Event_Observer $event_Observer)
    {
        /** @var Mage_Core_Model_Session $session */
        $session = Mage::getSingleton('core/session');
        if ($session->getShippingTime() == null) {
            return;
        }
        /** @var Mage_Sales_Model_Order $order */
        $order = $event_Observer->getOrder();
        $dateShipping = Mage::getModel('nan_shipping/shipping');
        $dateShipping->setOrderId($order->getId());
        $dateShipping->setDateValue($session->getShippingTime());
        $dateShipping->save();
        $session->unsShippingTime();
    }

    /**
     * updateOnMultiShipping
     * @param Varien_Event_Observer $event_Observer
     */
    public function updateOnMultiShipping(Varien_Event_Observer $event_Observer)
    {
        if (!Mage::getStoreConfig('shipping/option/checkout_multiple')) {
            return;
        }
        Mage::getSingleton('core/session')->addError(Mage::helper('nan_shipping')->__('The NaN Shipping is now deactivate because it not support the multishipping method. Sorry Man.'));
        Mage::getModel('core/config')->saveConfig('carriers/nan_shipping/active', 0);
    }
}

