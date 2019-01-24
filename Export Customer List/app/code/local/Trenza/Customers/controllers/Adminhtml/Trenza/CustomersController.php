<?php

class Trenza_Customers_Adminhtml_Trenza_CustomersController extends Mage_Adminhtml_Controller_Action
{

    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('report')
            ->_addContent(
                $this->getLayout()
                ->createBlock('trenza_customers/adminhtml_customer')
                ->setTemplate('trenza/customer.phtml'))
            ->_title($this->__('Customer List'));
        return $this;
    }

   	public function indexAction() {
		
        
        $type = Mage::app()->getRequest()->getParam('type');

        $this->exportAction($type);
        
        $this->_initAction()
			->renderLayout();
        
	}
            
    protected function exportAction($type)
    {
                               
        $collection = mage::getModel('customer/customer')->getCollection()
                            ->addAttributeToSelect('firstname')
                            ->addAttributeToSelect('lastname')
                            ->addAttributeToSelect('phone')
                            ->addAttributeToSelect('email');
                            
        if($type==1){ 
            $_customersData[] = array(
                    'Name',
                    'Phone Number',
                );
            foreach($collection as $customer):
                $name = $customer->getFirstname() .' '.$customer->getLastname();
                $_customersData[] = array(
                    $name,
                    $customer->getPhone(),
                );
            endforeach;
            
            $_customersCsvData = $_customersData;
            
            $filename = 'phone.csv';
        
            $this->exportCsvAction($_customersCsvData, $filename);
        }
        
        if($type==2){ 
            $_customersData[] = array(
                    'Name',
                    'Email',
                );
            foreach($collection as $customer):
               $name = $customer->getFirstname() .' '.$customer->getLastname();
                $_customersData[] = array(
                    $name,
                    $customer->getEmail(),
                );
            endforeach;
                        
            $_customersCsvData = $_customersData;
            $filename = 'email.csv';
        
            $this->exportCsvAction($_customersCsvData, $filename);
        }

    }
    
    protected function exportCsvAction($_customers, $filename){
        
        $csv = new Varien_File_Csv();
        $path_to_save = Mage::getBaseDir('var'). DS . $filename;
        $csv->saveData($path_to_save, $_customers);

        if(file_exists($path_to_save))
        {
          header('Content-Disposition: attachment; filename='. $filename);  
          readfile($path_to_save); 
          exit;
        }
    }     

}