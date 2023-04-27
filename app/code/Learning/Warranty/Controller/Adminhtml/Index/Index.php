<?php

namespace Learning\Warranty\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{

    protected $_resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) 
    {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Magento_Sales::warranty');
        $resultPage->getConfig()->getTitle()->prepend(__('Warranty'));

        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magento_Sales::warranty');
    }
}
