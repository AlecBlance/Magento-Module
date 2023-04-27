<?php
namespace Learning\Warranty\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{

    protected $_resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
    ) {
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct(
            $context
        );
    }

    public function execute()
    {
       $resultPage = $this->_resultPageFactory->create();
       $resultPage->addHandle('warranty_index_index'); //loads the layout of module_custom_customlayout.xml file with its name
       return $resultPage;
    }
}
