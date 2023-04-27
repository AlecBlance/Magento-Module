<?php
namespace Learning\Warranty\Api\Data;

interface RecordsInterface
{

    const WARRANTY_ID         = 'warranty_id';
    const ORDER_ID            = 'order_id';
    const SKU                 = 'sku';
    const EMAIL               = 'email';
    const NAME                = 'name';
    const INFO                = 'info';


    public function getSku();

    public function getOrderId();

    public function getItemId();

    public function getEmail();

    public function getInfo();

    public function getName();


}
