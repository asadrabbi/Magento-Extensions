<?php
class Trenza_News_Block_Adminhtml_News_Grid_Renderer_Image2 extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $val = Mage::helper('news');
        $value = $row->getData($this->getColumn()->getIndex());
            return '<img src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'news/'.$value.'"  width="80" />';
    }
}