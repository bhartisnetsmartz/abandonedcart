<?php
namespace Ntz\AbandonedCart\Model\Cron;

use DateInterval;

class Save
{
    private const STANDARD_ABANDONED_CART_INTERVAL = 'PT5M';
    //customer
    const XML_PATH_ABANDONED_CUSTOMER_ENABLED_1 = 'ntz_abandoned_cart/general/enabled_1';

    const XML_PATH_ABANDONED_CUSTOMER_ENABLED_2 = 'ntz_abandoned_cart/general/enabled_2';

    const XML_PATH_ABANDONED_CUSTOMER_ENABLED_3 = 'ntz_abandoned_cart/general/enabled_3';

    const XML_PATH_ABANDONED_CUSTOMER_ENABLED_4 = 'ntz_abandoned_cart/general/enabled_4';

    const XML_PATH_ABANDONED_CUSTOMER_INTERVAL_1 = 'ntz_abandoned_cart/general/send_after_1';

    const XML_PATH_ABANDONED_CUSTOMER_INTERVAL_2 = 'ntz_abandoned_cart/general/send_after_2';

    const XML_PATH_ABANDONED_CUSTOMER_INTERVAL_3 = 'ntz_abandoned_cart/general/send_after_3';

    const XML_PATH_ABANDONED_CUSTOMER_INTERVAL_4 = 'ntz_abandoned_cart/general/send_after_4';

    const XML_PATH_ABANDONED_CUSTOMER_TEMPLATE_1 = 'ntz_abandoned_cart/general/template1';

    const XML_PATH_ABANDONED_CUSTOMER_TEMPLATE_2 = 'ntz_abandoned_cart/general/template2';

    const XML_PATH_ABANDONED_CUSTOMER_TEMPLATE_3 = 'ntz_abandoned_cart/general/template3';

    const XML_PATH_ABANDONED_CUSTOMER_TEMPLATE_4 = 'ntz_abandoned_cart/general/template4';

    public $totalCustomers = 0;

    public $totalGuests = 0;

    public function __construct(
        public \Ntz\AbandonedCart\Model\AbandonedFactory $abandonedFactory,
        public \Ntz\AbandonedCart\Model\ResourceModel\Abandoned\CollectionFactory $abandonedCollectionFactory,
        public \Ntz\AbandonedCart\Model\ResourceModel\Abandoned $abandonedResource,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        public \Magento\Quote\Model\ResourceModel\Quote\CollectionFactory $quoteCollectionFactory,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
        public \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        public \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        public \Magento\Framework\View\Element\Template $frameworkTemplate
    ) {
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
        $this->timeZone = $timezone;          
    }
    /**
     * CRON FOR ABANDONED CARTS Save.
     *
     * @return null
     */
    public function abandonedCartsSave()
    {
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/abandonedCart.log');
          $logger = new \Zend_Log();
          $logger->addWriter($writer);
        $result = 0;
        $abandonedNum = 1;

        //$stores = $this->getStores();

        $storeId = $this->storeManager->getStore()->getId();

        $sendAfter = $this->getSendAfterIntervalForCustomerLogged($storeId, $abandonedNum);
        $fromTime = new \DateTime('now', new \DateTimezone('UTC'));
        $logger->info($sendAfter);
        $logger->info($fromTime);
        $fromTime->sub($sendAfter);
        $toTime = clone $fromTime;
        $fromTime->sub(new DateInterval(self::STANDARD_ABANDONED_CART_INTERVAL));

        //format time
        $fromDate = $fromTime->format('Y-m-d H:i:s');
        $toDate = $toTime->format('Y-m-d H:i:s');

        //active quotes
        $quoteCollection = $this->getStoreQuotes($fromDate, $toDate, false, $storeId);

        if ($quoteCollection->getSize()) {
            $logger->info('Customer 1 Abandoned Cart: ' . $fromDate . ' - ' . $toDate);
        }

        foreach ($quoteCollection as $quote) {
            $quoteId = $quote->getId();
            $storeId = $quote->getStoreId();
            $items = $quote->getAllItems();
            $email = $quote->getCustomerEmail();
            $itemIds = $this->getQuoteItemIds($items);

            $abandonedModel = $this->abandonedFactory->create()->loadByQuoteId($quoteId, $storeId);

            // if ($this->abandonedCartAlreadyExists($abandonedModel) && $this->shouldNotSendAbandonedCartAgain($abandonedModel, $quote)) {
            //     if ($this->shouldDeleteAbandonedCart($quote)) {
            //         $this->deleteAbandonedCart($abandonedModel);
            //     }
            //     continue;
            // }

            //create abandoned cart
            $this->createAbandonedCart($abandonedModel, $quote, $itemIds);
            //$template = $this->getABANDONEDCustomerTemplate($abandonedNum, $storeId);

            //send campaign; check if valid to be sent
            // if ($this->isABANDONEDCustomerEnabled(self::CUSTOMER_LOST_BASKET_ONE, $storeId)) {
            //     $this->sendEmailCampaign($email, $quote, self::CUSTOMER_LOST_BASKET_ONE, $template);
            // }

            $this->totalCustomers++;
            $result = $this->totalCustomers;
        }

        return $result;
    }

    /**
     * Get all stores.
     *
     * @param bool|false $default default
     *
     * @return \Magento\Store\Api\Data\StoreInterface[]
     */
    public function getStores($default = false)
    {
        return $this->storeManager->getStores($default);
    }

    /**
     * CreateAbandonedCart
     *
     * @param string $abandonedModel abandonedModel
     * @param string $quote          quote
     * @param int    $itemIds        itemIds
     *
     * @return mixed
    */
    public function createAbandonedCart($abandonedModel, $quote, $itemIds)
    {
        $abandonedModel->setQuoteId($quote->getId())
            ->setStoreId($quote->getStoreId())
            ->setCustomerId($quote->getCustomerId())
            ->setEmail($quote->getCustomerEmail())
            ->setQuoteUpdatedAt($quote->getUpdatedAt())
            ->setAbandonedCartNumber(1)
            ->setItemsCount($quote->getItemsCount())
            ->setItemsIds(implode(',', $itemIds))
            ->save();
    }

    /**
     * GetQuoteItemIds
     *
     * @param string $allItemsIds allItemsIds
     *
     * @return array
     */
    public function getQuoteItemIds($allItemsIds)
    {
        $itemIds = [];
        foreach ($allItemsIds as $item) {
            $itemIds[] = $item->getProductId();
        }

        return $itemIds;
    }

    /**
     * GetSendAfterIntervalForCustomer
     *
     * @param int $storeId storeId
     * @param int $num     num
     *
     * @return \DateInterval
     */
    public function getSendAfterIntervalForCustomerLogged($storeId, $num): DateInterval
    {
        $timeInterval = $this->getAbandonedSendAfterForCustomer($num, $storeId);
        // if ($num == 1) {
        //     $interval = \DateInterval::createFromDateString($timeInterval . ' minutes');
        // } else {
        //     $interval = \DateInterval::createFromDateString($timeInterval . ' hours');
        // }

        // return $interval;

        return $num == 1 ?
            new DateInterval(sprintf('PT%sM', $timeInterval)) :
            new DateInterval(sprintf('PT%sH', $timeInterval));
    }

    /**
     * GetABANDONEDSendAfterForCustomer
     *
     * @param int $num     num
     * @param int $storeId storeId
     *
     * @return bool
     */
    public function getAbandonedSendAfterForCustomer($num, $storeId)
    {
        return $this->scopeConfig->getValue(
            constant('self::XML_PATH_ABANDONED_CUSTOMER_INTERVAL_' . $num),
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}