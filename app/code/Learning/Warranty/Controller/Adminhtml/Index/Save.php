<?php

namespace Learning\Warranty\Controller\Adminhtml\Index;

use Learning\Warranty\Model\RecordsFactory;

class Save extends \Magento\Backend\App\Action
{
    protected $recordsFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        RecordsFactory $recordsFactory
    ) {
        $this->recordsFactory = $recordsFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $reviewId = isset($data['warranty_id']) ? $data['warranty_id'] : '';
        if (!$data) {
            $this->_redirect('warranty/index/index');
        }
        try {
            $rowData = $this->recordsFactory->create()->load($reviewId);
            if (!$rowData->getId() && $reviewId) {
                $this->messageManager->addError(__('row data no longer exist.'));
                $this->_redirect('warranty/index/index');
            }
            $rowData->setData($data);
            $rowData->save();
            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('warranty/index/index');
    }

    protected function isAllowed()
    {
        return $this->_authorization->isAllowed('Magento_Sales::warranty');
    }
}
