<?php

namespace Learning\Warranty\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use Learning\Warranty\Api\Data\SalesInterface;

class Sales extends AbstractModel implements SalesInterface, IdentityInterface
{
    const CACHE_TAG = 'learning_warranty_sales';

    protected function _construct()
    {
        $this->_init('Learning\Warranty\Model\ResourceModel\Sales');
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
        return $this->getData(self::ITEM_ID);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getItemId()];
    }
}
