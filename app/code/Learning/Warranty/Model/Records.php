<?php

namespace Learning\Warranty\Model;

use \Magento\Framework\Model\AbstractModel;
use \Magento\Framework\DataObject\IdentityInterface;
use \Learning\Warranty\Api\Data\RecordsInterface;

class Records extends AbstractModel implements RecordsInterface, IdentityInterface
{
    
    const CACHE_TAG = 'learning_warranty_records';

    protected function _construct()
    {
        $this->_init('Learning\Warranty\Model\ResourceModel\Records');
    }

    public function getSku() 
    {
        return $this->getData(self::SKU);
    }

    public function getOrderId()
    {
        return $this->getData(self::ORDER_ID);
    }

    public function getItemId()
    {
        return $this->getData(self::WARRANTY_ID);
    }

    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    public function getInfo()
    {
        return $this->getData(self::INFO);
    }

    public function getName()
    {
        return $this->getData(self::NAME);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getItemId()];
    }

    public function setNotified() 
    {
        return $this->setData(self::NOTIFIED, "1");
    }

}
