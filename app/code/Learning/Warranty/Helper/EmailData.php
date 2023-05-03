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
    )
    {
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        $this->inlineTranslation = $state;
        parent::__construct($context);
    }

    public function sendEmail($data)
    {
        // this is an example and you can change template id,fromEmail,toEmail,etc as per your need.
        $templateId = 'customer_confirmation'; // template id
        $fromEmail = 'blancealec1@gmail.com';  // sender Email id
        $fromName = 'Admin';             // sender Name
        $toEmail =  $data['email']; // receiver email id

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
        // this is an example and you can change template id,fromEmail,toEmail,etc as per your need.
        $templateId = 'admin_notification'; // template id
        $fromEmail = 'blancealec1@gmail.com';  // sender Email id
        $fromName = 'Notifier';             // sender Name
        $toEmail =  'blancealec1@gmail.com'; // receiver email id

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