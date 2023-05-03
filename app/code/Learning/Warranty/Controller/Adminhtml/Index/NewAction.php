<?php

namespace Learning\Warranty\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Learning\Warranty\Model\RecordsFactory;

class NewAction extends Action
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
        $resultPage->setActiveMenu('Magento_Sales::warranty');
        $title = __('Add Warranty');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

    protected function isAllowed()
    {
        return $this->_authorization->isAllowed('Magento_Sales::warranty');
    }
}
