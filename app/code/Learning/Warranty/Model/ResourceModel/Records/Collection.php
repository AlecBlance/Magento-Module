<?php
namespace Learning\Warranty\Model\ResourceModel\Records;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected function _construct()
    {
        $this->_init(\Learning\Warranty\Model\Records::class, \Learning\Warranty\Model\ResourceModel\Records::class);
    }
}
