<?php

namespace Learning\Warranty\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Sales extends AbstractDb
{

    protected function _construct()
    {
        $this->_init('sales_order_item', 'item_id');
    }
}
