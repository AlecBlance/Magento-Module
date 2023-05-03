<?php

namespace Learning\Warranty\Api\Data;

interface SalesInterface
{
    private const ITEM_ID             = 'item_id';
    private const ORDER_ID            = 'order_id';
    private const SKU                 = 'sku';

    public function getSku();

    public function getOrderId();

    public function getItemId();
}
