<?php
/**
 * Fontis_Campaignmonitor
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the H&O Commercial License
 * that is bundled with this package in the file LICENSE_HO.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.h-o.nl/license
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@h-o.com so we can send you a copy immediately.
 *
 * @category    Fontis
 * @package     Fontis_Campaignmonitor
 * @copyright   Copyright © 2013 H&O (http://www.h-o.nl/)
 * @license     H&O Commercial License (http://www.h-o.nl/license)
 * @author      Paul Hachmang – H&O <info@h-o.nl>
 *
 * 
 */
class Fontis_CampaignMonitor_Adminhtml_CampaignmonitorController extends Mage_Adminhtml_Controller_Action
{
    function syncAction() {
        /** @var Fontis_Campaignmonitor_Model_Api $api */
        $api = Mage::getModel('campaignmonitor/api');

        /** @var Mage_Newsletter_Model_Resource_Subscriber_Collection $subscriberCollection */
        $subscriberCollection = Mage::getModel('newsletter/subscriber')->getCollection();
        foreach($subscriberCollection as $subscriber) {
            /** @var $subscriber Mage_Newsletter_Model_Subscriber */
            $api->syncSubscriber($subscriber);
        }

        Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('campaignmonitor')->__('Synced %s subscribers',$subscriberCollection->count()));
    }
}
