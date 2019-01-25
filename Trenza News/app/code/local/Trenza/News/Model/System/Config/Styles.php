<?php

class Trenza_News_Model_System_Config_Styles 
{
    public function toOptionArray()
    {
        return array(
            array('value' => 1, 'label'=>Mage::helper('adminhtml')->__('Responsive Slides')),
            array('value' => 2, 'label'=>Mage::helper('adminhtml')->__('Basic FlexSlider')),
        );
    }
}
