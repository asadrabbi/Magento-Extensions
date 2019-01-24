<?php

class Trenza_Notification_Block_Adminhtml_Notification_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('notification_form', array('legend'=>Mage::helper('notification')->__('General information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('notification')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));
     
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('notification')->__('Content'),
          'title'     => Mage::helper('notification')->__('Content'),
          'style'     => 'width:280px; height:150px;',
          'wysiwyg'   => false,
          'required'  => false,
      ));
      
      $data = array();
	  $out = '';
	  if ( Mage::getSingleton('adminhtml/session')->getNotificationData() )
		{
			$data = Mage::getSingleton('adminhtml/session')->getNotificationData();
		} elseif ( Mage::registry('notification_data') ) {
			$data = Mage::registry('notification_data')->getData();
		}

	  if ( !empty($data['filename']) ) {
		  $url = Mage::getBaseUrl('media') .'notification/' . $data['filename'];
          $out = '<br/><center><a href="' . $url . '" target="_blank" id="imageurl">';
		  $out .= "<img src=" . $url . " width='250px' />";
		  $out .= '</a></center>';
	  }

      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('notification')->__('Image File'),
          'required'  => false,
          'name'      => 'filename',
          'note' => 'Image used for this silde '.$out,
	  ));
      
      $fieldset->addField('link', 'text', array(
          'label'     => Mage::helper('notification')->__('Link'),
          'name'      => 'link',
      ));
		
      $fieldset->addField('platform', 'select', array(
          'label'     => Mage::helper('notification')->__('Platform'),
          'name'      => 'platform',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('notification')->__('Web'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('notification')->__('SMS'),
              ),

              array(
                  'value'     => 3,
                  'label'     => Mage::helper('notification')->__('Both'),
              ),
          ),
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getNotificationData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getNotificationData());
          Mage::getSingleton('adminhtml/session')->setNotificationData(null);
      } elseif ( Mage::registry('notification_data') ) {
          $form->setValues(Mage::registry('notification_data')->getData());
      }
      return parent::_prepareForm();
  }
}
