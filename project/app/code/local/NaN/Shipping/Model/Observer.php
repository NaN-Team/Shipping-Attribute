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


    public function saveOrderWithShippingTime(Varien_Event_Observer $event_Observer)
    {
        /** @var Mage_Sales_Model_Order $order */
        $order = $event_Observer->getOrder();
        //TODO
    }
}

