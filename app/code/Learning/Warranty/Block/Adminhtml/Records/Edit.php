<?php

namespace Learning\Warranty\Block\Adminhtml\Records;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    protected $coreRegistry = null;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    protected function __construct()
    {
        $this->_objectId = 'warranty_id';
        $this->_blockGroup = 'Learning_Warranty';
        $this->_controller = 'adminhtml_records';
        parent::_construct();
        if ($this->isAllowedAction('Magento_Sales::warranty')) {
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

    protected function isAllowedAction($resourceId)
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
