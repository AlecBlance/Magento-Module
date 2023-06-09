<?php

namespace Learning\Warranty\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class WarrantyForm extends Template
{
    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_isScopePrivate = true;
    }

    public function getFormAction()
    {
        return $this->getUrl('warranty/index/post', ['_secure' => true]);
    }
}
