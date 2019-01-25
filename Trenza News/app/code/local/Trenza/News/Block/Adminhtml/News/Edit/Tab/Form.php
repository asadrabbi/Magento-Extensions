<?php

class Trenza_News_Block_Adminhtml_News_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('news_form', array('legend'=>Mage::helper('news')->__('General information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('news')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));
		
      $fieldset->addField('position', 'text', array(
          'label'     => Mage::helper('news')->__('Position'),
          'required'  => false,
          'name'      => 'position',
      )); 
      
      $data = array();
	  $out = '';
	  if ( Mage::getSingleton('adminhtml/session')->getNewsData() )
		{
			$data = Mage::getSingleton('adminhtml/session')->getNewsData();
		} elseif ( Mage::registry('news_data') ) {
			$data = Mage::registry('news_data')->getData();
		}
        
        if ( !empty($data['filename']) ) {
		  $url = Mage::getBaseUrl('media') .'news/' . $data['filename'];
          $out = '<br/><center><a href="' . $url . '" target="_blank" id="imageurl">';
		  $out .= "<img src=" . $url . " width='250px' />";
		  $out .= '</a></center>';
	  }

      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('news')->__('Image File'),
          'required'  => false,
          'name'      => 'filename',
          'note' => 'Image used for this news '.$out,
	  ));

      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('news')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('news')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('news')->__('Disabled'),
              ),
          ),
      ));
   
      if (!Mage::app()->isSingleStoreMode()) {
        $fieldset->addField('store_id', 'multiselect', array(
              'name'      => 'stores[]',
              'label'     => Mage::helper('cms')->__('Store View'),
              'title'     => Mage::helper('cms')->__('Store View'),
              'required'  => true,
              'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
          ));
      }
      else {
        $fieldset->addField('store_id', 'hidden', array(
            'name'      => 'stores[]',
            'value'     => Mage::app()->getStore(true)->getId()
        ));
      }
	  
	$wysiwyg_config = Mage::getSingleton('cms/wysiwyg_config')->getConfig(
    array(
       'add_widgets' => false,
       'add_variables' => false,
       'add_images' => false,
       'files_browser_window_url'=> $this->getBaseUrl() . 'admin/cms_wysiwyg_images/index/',
            ));
      $fieldset->addField('content', 'editor', 
	  array(
          'name'      => 'content',
          'label'     => Mage::helper('news')->__('Content'),
          'title'     => Mage::helper('news')->__('Content'),
          'style'     => 'width:300px; height:200px;',
          'wysiwyg'   => false,
          'required'  => false,
          'config'    => $wysiwyg_config,
      ));
	  
      if ( Mage::getSingleton('adminhtml/session')->getnewsData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getnewsData());
          Mage::getSingleton('adminhtml/session')->setnewsData(null);
      } elseif ( Mage::registry('news_data') ) {
          $form->setValues(Mage::registry('news_data')->getData());
      }

      return parent::_prepareForm();
  }
      protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }

  
}
