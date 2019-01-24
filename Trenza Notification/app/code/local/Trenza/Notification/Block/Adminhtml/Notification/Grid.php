<?php

class Trenza_Notification_Block_Adminhtml_Notification_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('notificationGrid');
      $this->setDefaultSort('notification_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('notification/notification')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('notification_id', array(
          'header'    => Mage::helper('notification')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'notification_id',
      ));

      $this->addColumn('title', array(
          'header'    => Mage::helper('notification')->__('Title'),
          'align'     =>'left',
          'index'     => 'title',
          'width'     => '300px',
      ));
      
       $this->addColumn('content', array(
          'header'    => Mage::helper('notification')->__('Content'),
          'align'     =>'left',
          'index'     => 'content',
      ));
              
    $this->addColumn('filename', array(
          'header'    => Mage::helper('notification')->__('Image'),
          'align'     =>'left',
          'width'     => '200px',
          'index'     => 'filename',
          'filter'    => false,
		  'renderer' => 'notification/adminhtml_notification_grid_renderer_image'
      ));
      
      
      $this->addColumn('platform', array(
          'header'    => Mage::helper('notification')->__('Platform'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'platform',
          'type'      => 'options',
          'options'   => array(
              1 => 'Web',
              2 => 'SMS',
              3 => 'Both'
          ),
      ));


        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('notification')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('notification')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('notification_id');
        $this->getMassactionBlock()->setFormFieldName('notification');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('notification')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('notification')->__('Are you sure?')
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}
