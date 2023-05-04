<?php

namespace Learning\Warranty\Block\Adminhtml\Records;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    protected $_coreRegistry = null;

    public function __construct(
        Context $context,
        Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
        $this->_objectId = 'warranty_id';
        $this->_blockGroup = 'Learning_Warranty';
        $this->_controller = 'adminhtml_records';
        parent::_construct();
        if ($this->_isAllowedAction('Magento_Sales::warranty')) {
            $this->buttonList->update('save', 'label', __('Save'));
        } else {
            $this->buttonList->remove('save');
        }
        $this->buttonList->remove('reset');
    }

    public function getHeaderText()
    {
        return __('Edit Warranty');
    }

    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    public function getFormActionUrl()
    {
        if ($this->hasFormActionUrl()) {
            return $this->getData('form_action_url');
        }
        return $this->getUrl('*/*/save');
    }
}
