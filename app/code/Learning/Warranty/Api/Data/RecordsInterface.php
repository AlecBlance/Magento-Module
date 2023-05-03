<?php

namespace Learning\Warranty\Api\Data;

interface RecordsInterface
{
    private const WARRANTY_ID         = 'warranty_id';
    private const ORDER_ID            = 'order_id';
    private const SKU                 = 'sku';
    private const EMAIL               = 'email';
    private const NAME                = 'name';
    private const INFO                = 'info';
    private const NOTIFIED            = 'notified';


    public function getSku();

    public function getOrderId();

    public function getItemId();

    public function getEmail();

    public function getInfo();

    public function getName();

    public function getIdentities();

    public function setNotified();
}
