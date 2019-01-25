<?php
class Trenza_News_Block_News extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getNews()     
     { 
        if (!$this->hasData('news')) {
            $this->setData('news', Mage::registry('news'));
        }
        return $this->getData('news');
        
    }
	
	public function getNewsCollection() {
		$collection = Mage::getModel('news/news')->getCollection()
			->addFieldToFilter('status',1);
        
        $collection->getSelect()->order('position');           
		/*
        $current_store = Mage::app()->getStore()->getId();
		$sliders = array();
		foreach ($collection as $news) {
            $stores = explode(',',$news->getStoreId());
			if (in_array(0,$stores) || in_array($current_store,$stores))
				$newss[] = $news;
		}*/
		return $collection;
	}
	
	public function isShowDescription(){
		return (int)Mage::getStoreConfig('news/general/show_description');
	}
	
	public function getListStyle(){
		return (int)Mage::getStoreConfig('news/general/list_style');
	}
    /* If a Block is Called
    public function getSingleNews(){
            
        $id = $this->getRequest()->getParam('id');
        $collection = Mage::getModel('news/news')->load($id);
        
        return $collection;
    }
    */
}
