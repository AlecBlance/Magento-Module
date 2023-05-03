<?php

namespace Learning\Warranty\ViewModel;

use Learning\Warranty\Helper\SalesData;

class WarrantyForm implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    protected $helper;

    public function __construct(
        SalesData $helper
    ) {
        $this->helper  = $helper;
    }

    public function getAllWarranty()
    {
        return $this->helper->getAllWarranty();
    }
}
