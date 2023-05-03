<?php

namespace Learning\Warranty\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Learning\Warranty\Model\RecordsFactory as RecordsFactory;
use Learning\Warranty\Model\ResourceModel\Records\CollectionFactory as RecordsCollectionFactory;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;


class WarrantyData extends AbstractHelper
{

    protected $_recordsFactory = null;
    protected $_recordsCollectionFactory = null;
    protected $date;
    protected $validated = null;

    public function __construct(
        RecordsFactory $recordsFactory,
        RecordsCollectionFactory $recordsCollectionFactory,
        TimezoneInterface $date
    )
    {
        $this->date = $date;
        $this->_recordsFactory  = $recordsFactory;
        $this->_recordsCollectionFactory  = $recordsCollectionFactory;
    }

    public function getAllRecords()
    {
        $recordsCollection = $this->_recordsFactory ->create();
        $recordsCollection->addFieldToSelect('*')->load();
        return $recordsCollection->getItems();
    }

    public function setRecord($record) 
    {
        $recordsCollection = $this->_recordsFactory ->create();
        $result = $recordsCollection->setData($record);
        $result->save();
    }

    public function isUnvalidatedPresent() 
    {
        $recordsCollection = $this->_recordsCollectionFactory ->create();
        $date = $this->date->date()->modify('-1 day')->format('Y-m-d H:i:s');
        $recordsCollection->addFieldToFilter('status', ['eq' => '0'])
                        ->addFieldToFilter('created_at', ['lteq' => $date])
                        ->addFieldToFilter('notified', ['eq' => '0']);
        $this->unvalidated = $recordsCollection->getItems();
        return $recordsCollection->count();
    }

    public function setNotified() 
    {
        foreach($this->unvalidated as $record) {
            $record->setNotified();
            $record->save();
        }
    }

    public function getUnvalidated() 
    {
        return $this->unvalidated;
    }

}
