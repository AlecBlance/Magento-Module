<?php
namespace Learning\Warranty\Model\ResourceModel\Sales;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected function _construct()
    {
        $this->_init(\Learning\Warranty\Model\Sales::class, \Learning\Warranty\Model\ResourceModel\Sales::class);
    }
}
