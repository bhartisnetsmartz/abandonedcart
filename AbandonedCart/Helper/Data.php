<?php
namespace Ntz\AbandonedCart\Helper;
 
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Data extends AbstractHelper
{
    // for abandoned cart 1
    const XML_PATH_ABANDONED_CUSTOMER_ENABLED_1 = 'ntz_abandoned_cart/general/enabled_1';
    const XML_PATH_ABANDONED_CUSTOMER_INTERVAL_1 = 'ntz_abandoned_cart/general/send_after_1';
    const XML_PATH_ABANDONED_CUSTOMER_SENDER_1 = 'ntz_abandoned_cart/general/sender_1';
    const XML_PATH_ABANDONED_CUSTOMER_TEMPLATE_1 = 'ntz_abandoned_cart/general/template1';
    const XML_PATH_ABANDONED_CUSTOMER_COUPON_1 = 'ntz_abandoned_cart/general/has_coupon1';
    // for abandoned cart 2
    const XML_PATH_ABANDONED_CUSTOMER_ENABLED_2 = 'ntz_abandoned_cart/general/enabled_2';
    const XML_PATH_ABANDONED_CUSTOMER_INTERVAL_2 = 'ntz_abandoned_cart/general/send_after_2';
    const XML_PATH_ABANDONED_CUSTOMER_SENDER_2 = 'ntz_abandoned_cart/general/sender_2';
    const XML_PATH_ABANDONED_CUSTOMER_TEMPLATE_2 = 'ntz_abandoned_cart/general/template2';
    const XML_PATH_ABANDONED_CUSTOMER_COUPON_2 = 'ntz_abandoned_cart/general/has_coupon2';
    // for abandoned cart 3
    const XML_PATH_ABANDONED_CUSTOMER_ENABLED_3 = 'ntz_abandoned_cart/general/enabled_3';
    const XML_PATH_ABANDONED_CUSTOMER_INTERVAL_3 = 'ntz_abandoned_cart/general/send_after_3';
    const XML_PATH_ABANDONED_CUSTOMER_SENDER_3 = 'ntz_abandoned_cart/general/sender_3';
    const XML_PATH_ABANDONED_CUSTOMER_TEMPLATE_3 = 'ntz_abandoned_cart/general/template3';
    const XML_PATH_ABANDONED_CUSTOMER_COUPON_3 = 'ntz_abandoned_cart/general/has_coupon';
    // for abandoned cart 4
    const XML_PATH_ABANDONED_CUSTOMER_ENABLED_4 = 'ntz_abandoned_cart/general/enabled_4';
    const XML_PATH_ABANDONED_CUSTOMER_INTERVAL_4 = 'ntz_abandoned_cart/general/send_after_4';
    const XML_PATH_ABANDONED_CUSTOMER_SENDER_4 = 'ntz_abandoned_cart/general/sender_4';
    const XML_PATH_ABANDONED_CUSTOMER_TEMPLATE_4 = 'ntz_abandoned_cart/general/template4';
    const XML_PATH_ABANDONED_CUSTOMER_COUPON_4 = 'ntz_abandoned_cart/general/has_coupon4';


    protected $scopeConfig;

    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context);
        $this->scopeConfig = $scopeConfig;
    }

    // for abandoned cart 1
    public function getIsEnabled1()
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ABANDONED_CUSTOMER_ENABLED_1);
    }

    public function getSendAfter1()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ABANDONED_CUSTOMER_INTERVAL_1);
    }

    public function getSender1()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ABANDONED_CUSTOMER_SENDER_1);
    }

    public function getTemplate1()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ABANDONED_CUSTOMER_TEMPLATE_1);
    }

    public function getCoupon1()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ABANDONED_CUSTOMER_COUPON_1);
    }

    // for abandoned cart 2
    public function getIsEnabled2()
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ABANDONED_CUSTOMER_ENABLED_2);
    }

    public function getSendAfter2()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ABANDONED_CUSTOMER_INTERVAL_2);
    }

    public function getSender2()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ABANDONED_CUSTOMER_SENDER_2);
    }

    public function getTemplate2()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ABANDONED_CUSTOMER_TEMPLATE_2);
    }

    public function getCoupon2()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ABANDONED_CUSTOMER_COUPON_2);
    }

    // for abandoned cart 3
    public function getIsEnabled3()
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ABANDONED_CUSTOMER_ENABLED_3);
    }

    public function getSendAfter3()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ABANDONED_CUSTOMER_INTERVAL_3);
    }

    public function getSender3()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ABANDONED_CUSTOMER_SENDER_3);
    }

    public function getTemplate3()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ABANDONED_CUSTOMER_TEMPLATE_3);
    }

    public function getCoupon3()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ABANDONED_CUSTOMER_COUPON_3);
    }

    // for abandoned cart 4
    public function getIsEnabled4()
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ABANDONED_CUSTOMER_ENABLED_4);
    }

    public function getSendAfter4()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ABANDONED_CUSTOMER_INTERVAL_4);
    }

    public function getSender4()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ABANDONED_CUSTOMER_SENDER_4);
    }

    public function getTemplate4()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ABANDONED_CUSTOMER_TEMPLATE_4);
    }

    public function getCoupon4()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ABANDONED_CUSTOMER_COUPON_4);
    }

}
