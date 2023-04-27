<?php

namespace Learning\Warranty\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;
use \Learning\Warranty\Model\RecordsFactory as RecordsCollectionFactory;


class WarrantyData extends AbstractHelper
{

    protected $_recordsCollectionFactory = null;

    public function __construct(
        RecordsCollectionFactory $recordsCollectionFactory
    )
    {
        $this->_recordsCollectionFactory  = $recordsCollectionFactory;
    }

    public function getAllRecords()
    {
        $recordsCollection = $this->_recordsCollectionFactory ->create();
        $recordsCollection->addFieldToSelect('*')->load();
        return $recordsCollection->getItems();
    }

    public function setRecord($record) 
    {
        $recordsCollection = $this->_recordsCollectionFactory ->create();
        $result = $recordsCollection->setData($record);
        $result->save();
        return;
    }

}
