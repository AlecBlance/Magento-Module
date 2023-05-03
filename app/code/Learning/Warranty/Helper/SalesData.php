<?php

namespace Learning\Warranty\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Learning\Warranty\Model\ResourceModel\Sales\CollectionFactory as SalesCollectionFactory;


class SalesData extends AbstractHelper
{

    protected $_salesCollectionFactory = null;

    public function __construct(
        SalesCollectionFactory $salesCollectionFactory
    )
    {
        $this->_salesCollectionFactory  = $salesCollectionFactory;
    }


    public function getAllWarranty()
    {
        $salesCollection = $this->_salesCollectionFactory ->create();
        $salesCollection->addFieldToSelect('*')->load();
        return $salesCollection->getItems();
    }

    public function isOrderPresent($order_id) 
    {
        $salesCollection = $this->_salesCollectionFactory ->create();
        $salesCollection->addFieldToFilter('order_id', ['eq' => $order_id]);
        return $salesCollection->count();
    }

    public function isSkuPresent($sku, $order_id) 
    {
        $salesCollection = $this->_salesCollectionFactory ->create();
        $salesCollection->addFieldToFilter('sku', ['eq' => $sku])
                        ->addFieldToFilter('order_id', ['eq' => $order_id]);
        return $salesCollection->count();
    }

}
