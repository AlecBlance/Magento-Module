<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Learning\Warranty\Block;

use Magento\Framework\View\Element\Template;

class WarrantyForm extends Template
{
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
        $this->_isScopePrivate = true;
    }

    public function getFormAction()
    {
        return $this->getUrl('warranty/index/post', ['_secure' => true]);
    }
}
