<?php
/**
 * Fontis_Campaignmonitor
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com and you will be sent a copy immediately.
 *
 * @category    Fontis
 * @package     Fontis_Campaignmonitor
 * @author      Paul Hachmang – H&O <info@h-o.nl>
 * @copyright   Copyright (c) 2008 Fontis Pty. Ltd. (http://www.fontis.com.au)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Fontis_CampaignMonitor_Block_Adminhtml_System_Config_Button extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        /** @var $fieldConfig Mage_Core_Model_Config_Element */
        $fieldConfig = $element->getFieldConfig();

        $url = $this->getUrl($fieldConfig->button_url);

        $html = $this->getLayout()->createBlock('adminhtml/widget_button')
                    ->setType('button')
                    ->setClass($fieldConfig->button_class)
                    ->setLabel($fieldConfig->button_label)
                    ->setOnClick("setLocation('$url')")
                    ->toHtml();

        return $html;
    }
}
