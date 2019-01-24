<?php
class Trenza_Notification_Block_Notification extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getNotification()     
     { 
        if (!$this->hasData('notification')) {
            $this->setData('notification', Mage::registry('notification'));
        }
        return $this->getData('notification');
        
    }
	
	public function getNotificationCollection() {
		$collection = Mage::getModel('notification/notification')->getCollection();
        
		$sliders = array();
		foreach ($collection as $slider) {
		  $sliders[] = $slider;
        }
		return $sliders;
	}
}
