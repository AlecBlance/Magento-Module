<?php

namespace Learning\Warranty\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Records extends AbstractDb
{

    protected function _construct()
    {
        $this->_init('warranty_records', 'warranty_id');
    }
}
