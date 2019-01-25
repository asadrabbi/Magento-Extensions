<?php
class Trenza_News_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
		$this->loadLayout();     
		$this->renderLayout();
    }
	
	public function viewAction()
    {
	   /* Without Calling Block */
        $id = $this->getRequest()->getParam('id');
        $newsData = Mage::getModel('news/news')->load($id);
        Mage::register('news_23', $newsData); 
        
        $this->loadLayout();     
        $this->renderLayout();
        
        /* Without XML  or Block
        Get current layout state
       $this->loadLayout();          

       $block = $this->getLayout()->createBlock(
           'Trenza_Banglameds_Block_Alpha',
           'alpha',
           array('template' => 'trenza/alpha.phtml')
       );

       $this->getLayout()->getBlock('root')->setTemplate('page/2columns-left.phtml');
       $this->getLayout()->getBlock('content')->append($block);
       $this->_initLayoutMessages('core/session'); 
       $this->renderLayout();
       */
        
	}
    
    
}
