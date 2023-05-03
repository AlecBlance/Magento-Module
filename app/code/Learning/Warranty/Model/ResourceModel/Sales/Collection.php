<?php
namespace Learning\Warranty\Model\ResourceModel\Sales;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Learning\Warranty\Model\Sales as SalesModel;
use Learning\Warranty\Model\ResourceModel\Sales as SalesResource;

class Collection extends AbstractCollection
{

    protected function _construct()
    {
        $this->_init(SalesModel::class, SalesResource::class);
    }
}
