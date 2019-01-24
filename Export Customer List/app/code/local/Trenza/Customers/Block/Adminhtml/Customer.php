<?php

class Trenza_Customers_Block_Adminhtml_Customer extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_customer';
    $this->_blockGroup = 'trenza_customers';
    $this->_headerText = Mage::helper('trenza_customers')->__('Customer List');
    
    $this->_addButton('phone', array(
        'label'     => Mage::helper('trenza_customers')->__('Export Phone Number'),
        'onclick'   => "location.href='".$this->getUrl('*/*/index/type/1')."'",
        'class'     => '',
    ));
    
    $this->_addButton('email', array(
        'label'     => Mage::helper('trenza_customers')->__('Export Email'),
        'onclick'   => "location.href='".$this->getUrl('*/*/index/type/2')."'",
        'class'     => '',
    ));
    
    parent::__construct();
    $this->_removeButton('add');
    
  }
}