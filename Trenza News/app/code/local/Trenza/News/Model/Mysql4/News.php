<?php

class Trenza_News_Model_Mysql4_News extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the slider_id refers to the key field in your database table.
        $this->_init('news/news', 'news_id');
    }
}
