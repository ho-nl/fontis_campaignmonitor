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
 
class Fontis_Campaignmonitor_Model_Api
{
    protected $_client = null;

    public function getClient() {
        if ($this->_client === null) {
            try {
                $this->_client = new SoapClient("http://api.createsend.com/api/api.asmx?wsdl", array("trace" => true));
            } catch(Exception $e) {
                Mage::throwException(Mage::helper('campaignmonitor')->__("Error connecting to CampaignMonitor server: %s",$e->getMessage()));
            }
        }
        return $this->_client;
    }

    public function getApiKey() {

    }

    public function syncSubscriber($subscriber) {
        try {
            $apiKey = trim(Mage::getStoreConfig('newsletter/campaignmonitor/api_key'));
            $listID = trim(Mage::getStoreConfig('newsletter/campaignmonitor/list_id'));


            foreach ($subscribersIds as $subscriberId) {
                $subscriber = Mage::getModel('newsletter/subscriber')->load($subscriberId);
                $email = $subscriber->getEmail();
                Mage::log("Fontis_CampaignMonitor: Unsubscribing: $email");
                try {
                    $result = $client->Unsubscribe(array(
                            "ApiKey" => $apiKey,
                            "ListID" => $listID,
                            "Email" => $email));
                } catch (Exception $e) {
                    Mage::log("Fontis_CampaignMonitor: Error in CampaignMonitor SOAP call: ".$e->getMessage());
                }
            }
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }
}