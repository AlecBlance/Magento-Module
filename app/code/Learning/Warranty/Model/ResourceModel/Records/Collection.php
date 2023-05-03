<?php
namespace Learning\Warranty\Model\ResourceModel\Records;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Learning\Warranty\Model\Records as RecordsModel;
use Learning\Warranty\Model\ResourceModel\Records as RecordsResource;

class Collection extends AbstractCollection
{

    protected function _construct()
    {
        $this->_init(RecordsModel::class, RecordsResource::class);
    }
}
