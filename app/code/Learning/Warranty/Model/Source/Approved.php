<?php

namespace Learning\Warranty\Model\Source;

use Magento\Framework\Option\ArrayInterface;

class Approved implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => __('Pending')],
            ['value' => 1, 'label' => __('Validated')],
            ['value' => 2, 'label' => __('Denied')]
        ];
    }
}
