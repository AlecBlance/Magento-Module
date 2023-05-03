<?php

namespace Learning\Warranty\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Learning\Warranty\Model\RecordsFactory;

class Edit extends Action
{
    private $pageFactory;

    protected $recordsFactory;

    private $coreRegistry;

    public function __construct(
        Context $context,
        PageFactory $rawFactory,
        RecordsFactory $recordsFactory,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->pageFactory = $rawFactory;
        $this->recordsFactory = $recordsFactory;
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    public function execute(): Page
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->setActiveMenu('Magento_sales::warranty');
        $rowId = (int)$this->getRequest()->getParam('id');
        $rowData = '';

        if ($rowId) {
            $rowData = $this->recordsFactory->create()->load($rowId);
            if (!$rowData->getId()) {
                $this->messageManager->addError(__('row data no longer exist.'));
                $this->_redirect('warranty/index/index');
            }
        }
        $this->coreRegistry->register('row_data', $rowData);
        $title = $rowId ? __('Edit Warranty ') : __('Add Warranty');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

    protected function isAllowed()
    {
        return $this->_authorization->isAllowed('Magento_Sales::warranty');
    }
}
