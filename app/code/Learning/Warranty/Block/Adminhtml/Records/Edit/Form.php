<?php

namespace Learning\Warranty\Block\Adminhtml\Records\Edit;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;
use Learning\Warranty\Model\Source\Approved;

class Form extends Generic
{

    protected $_systemStore;

    protected $_approved;

    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        Approved $approved,
        array $data = []
    )
    {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_approved = $approved;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(
            ['data' => [
                'id' => 'edit_form',
                'enctype' => 'multipart/form-data',
                'action' => $this->getData('action'),
                'method' => 'post']
            ]
        );
        $form->setHtmlIdPrefix('learning_warranty');
        if ($model) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Warranty Details'),
                'class' => 'fieldset-wide']
            );
            $fieldset->addField('warranty_id', 'hidden', ['name' => 'warranty_id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Warranty Details'),
                'class' => 'fieldset-wide']
            );
        }
        $fieldset->addField(
            'order_id',
            'text',
            [
                'name' => 'order_id',
                'label' => __('Order number'),
                'title' => __('Order number'),
                'class' => 'required-entry',
                'required' => true,
                'disabled' => $model ? true : false,
            ]
        );
        $fieldset->addField(
            'sku',
            'text',
            [
                'name' => 'sku',
                'label' => __('SKU'),
                'title' => __('SKU'),
                'class' => 'required-entry',
                'required' => true,
                'disabled' => $model ? true : false,
            ]
        );
        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name',
                'label' => __('Name'),
                'title' => __('Name'),
                'class' => 'required-entry',
                'required' => true,
                'disabled' => $model ? true : false,
            ]
        );
        $fieldset->addField(
            'email',
            'text',
            [
                'name' => 'email',
                'label' => __('Email'),
                'title' => __('Email'),
                'class' => 'required-entry',
                'required' => true,
                'disabled' => $model ? true : false,
            ]
        );
        $fieldset->addField(
            'info',
            'text',
            [
                'name' => 'info',
                'label' => __('Warranty Info'),
                'title' => __('Warranty Info'),
                'class' => 'required-entry',
                'required' => true,
                'disabled' => $model ? true : false,
            ]
        );
        $fieldset->addField(
            'status',
            'select',
            [
                'name' => 'status',
                'label' => __('Validated'),
                'id' => 'status',
                'title' => __('Validated'),
                'class' => 'required-entry status',
                'values' => $this->_approved->toOptionArray(),
                'required' => true,
            ]
        );
        $form->setValues($model ? $model->getData() : '');
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}