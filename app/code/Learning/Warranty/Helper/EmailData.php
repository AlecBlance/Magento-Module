<?php

namespace Learning\Warranty\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Area;

class EmailData extends AbstractHelper
{
    protected $transportBuilder;
    protected $storeManager;
    protected $inlineTranslation;

    public function __construct(
        Context $context,
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager,
        StateInterface $state
    ) {
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        $this->inlineTranslation = $state;
        parent::__construct($context);
    }

    public function sendEmail($data)
    {
        $templateId = 'customer_confirmation';
        $fromEmail = 'blancealec1@gmail.com';
        $fromName = 'Admin';
        $toEmail =  $data['email'];

        try {
            // template variables pass here
            $templateVars = [
                'name' => $data['name'],
                'sku' => $data['sku'],
                'order_id' => $data['order_id'],
                'info' => $data['info']
            ];

            $storeId = $this->storeManager->getStore()->getId();

            $from = ['email' => $fromEmail, 'name' => $fromName];
            $this->inlineTranslation->suspend();

            $storeScope = ScopeInterface::SCOPE_STORE;
            $templateOptions = [
                'area' => Area::AREA_FRONTEND,
                'store' => $storeId
            ];
            $transport = $this->transportBuilder->setTemplateIdentifier($templateId, $storeScope)
                ->setTemplateOptions($templateOptions)
                ->setTemplateVars($templateVars)
                ->setFrom($from)
                ->addTo($toEmail)
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (\Exception $e) {
            $this->_logger->info($e->getMessage());
        }
    }

    public function notifyAdmin()
    {
        $templateId = 'admin_notification';
        $fromEmail = 'blancealec1@gmail.com';
        $fromName = 'Notifier';
        $toEmail =  'blancealec1@gmail.com';

        try {
            $templateVars = [];

            $storeId = $this->storeManager->getStore()->getId();

            $from = ['email' => $fromEmail, 'name' => $fromName];
            $this->inlineTranslation->suspend();

            $storeScope = ScopeInterface::SCOPE_STORE;
            $templateOptions = [
                'area' => Area::AREA_FRONTEND,
                'store' => $storeId
            ];
            $transport = $this->transportBuilder->setTemplateIdentifier($templateId, $storeScope)
                ->setTemplateOptions($templateOptions)
                ->setTemplateVars($templateVars)
                ->setFrom($from)
                ->addTo($toEmail)
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (\Exception $e) {
            $this->_logger->info($e->getMessage());
        }
    }
}
