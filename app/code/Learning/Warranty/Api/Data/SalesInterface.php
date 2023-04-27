<?php
namespace Learning\Warranty\Api\Data;

interface SalesInterface
{

    const ITEM_ID             = 'item_id';
    const ORDER_ID            = 'order_id';
    const SKU                 = 'sku';

    public function getSku();

    public function getOrderId();

    public function getItemId();
}
