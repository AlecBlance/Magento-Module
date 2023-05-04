<?php

namespace Learning\Warranty\Cron;

use Learning\Warranty\Helper\WarrantyData;
use Learning\Warranty\Helper\EmailData;
use Magento\Framework\Notification\NotifierInterface as NotifierPool;

class Warranty
{
    protected $warrantyHelper;
    protected $emailHelper;
    protected $notifierPool;

    public function __construct(
        WarrantyData $warrantyHelper,
        EmailData $emailHelper,
        NotifierPool $notifierPool
    ) {
        $this->notifierPool = $notifierPool;
        $this->warrantyHelper = $warrantyHelper;
        $this->emailHelper = $emailHelper;
    }

    public function execute()
    {
        $unvalidated = $this->warrantyHelper->isUnvalidatedPresent();
        if (!$unvalidated) {
            return;
        }
        $this->emailHelper->notifyAdmin();
        $this->warrantyHelper->setNotified();
        return $this;
    }
}
