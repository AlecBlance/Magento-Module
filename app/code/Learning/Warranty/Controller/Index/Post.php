<?php

namespace Learning\Warranty\Controller\Index;

use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\DataObject;
use Learning\Warranty\Helper\SalesData;
use Learning\Warranty\Helper\WarrantyData;
use Learning\Warranty\Helper\EmailData;

class Post extends \Magento\Framework\App\Action\Action implements HttpPostActionInterface
{
    private $dataPersistor;
    private $context;
    private $helper;
    private $logger;

    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        LoggerInterface $logger = null,
        SalesData $salesHelper,
        WarrantyData $warrantyHelper,
        EmailData $emailHelper
    ) {
        parent::__construct($context);
        $this->salesHelper = $salesHelper;
        $this->emailHelper = $emailHelper;
        $this->warrantyHelper = $warrantyHelper;
        $this->context = $context;
        $this->dataPersistor = $dataPersistor;
        $this->logger = $logger ?: ObjectManager::getInstance()->get(LoggerInterface::class);
    }

    public function execute()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }
        try {
            $this->validatedParams();
            $data = $this->getRequest()->getParams();
            $this->messageManager->addSuccessMessage(
                __('Submitted')
            );
            $this->emailHelper->sendEmail($data);
            $this->warrantyHelper->setRecord($this->getRequest()->getParams());
            $this->dataPersistor->clear('warranty');
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $this->dataPersistor->set('warranty', $this->getRequest()->getParams());
        }
        return $this->resultRedirectFactory->create()->setPath('warranty/index/index');
    }

    private function validatedParams()
    {
        $request = $this->getRequest();

        if (trim($request->getParam('name', '')) === '') {
            throw new LocalizedException(__('Enter the Name and try again.'));
        }
        if (\strpos($request->getParam('email', ''), '@') === false) {
            throw new LocalizedException(__('The email address is invalid. Verify the email address and try again.'));
        }
        if (trim($request->getParam('order_id', '')) === '') {
            throw new LocalizedException(__('Enter the order number and try again.'));
        }
        if (trim($request->getParam('sku', '')) === '') {
            throw new LocalizedException(__('Enter the sku and try again.'));
        }
        if (trim($request->getParam('info', '')) === '') {
            throw new LocalizedException(__('Enter the warranty information and try again.'));
        }
        if (!$this->salesHelper->isOrderPresent($request->getParam('order_id'))) {
            throw new LocalizedException(__('Order number cannot be found. Please try again.'));
        }
        if (!$this->salesHelper->isSkuPresent($request->getParam('sku'), $request->getParam('order_id'))) {
            throw new LocalizedException(__('Product cannot be found in this order. Please try again.'));
        }
        return $request->getParams();
    }
}
