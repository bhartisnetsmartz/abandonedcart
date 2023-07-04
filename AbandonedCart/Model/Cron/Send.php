<?php
namespace Ntz\AbandonedCart\Model\Cron;

use Ntz\AbandonedCart\Helper\Data;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Ntz\AbandonedCart\Model\AbandonedFactory;
use Magento\Framework\App\ResourceConnection;
class Send
{
    protected $dataHelper;
    protected $abandonedFactory;
    protected $resourceConnection;
    protected $dateTime;

    public function __construct(
        
        Data $dataHelper,
        AbandonedFactory $abandonedFactory,
        ResourceConnection $resourceConnection,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime
    ) {
        
        $this->dataHelper = $dataHelper;
        $this->abandonedFactory = $abandonedFactory;
        $this->resourceConnection = $resourceConnection;
        $this->dateTime = $dateTime;
    }

    public function execute()
    {
        $currentDateTime = $this->dateTime->gmtDate();
        $connection = $this->resourceConnection->getConnection();
        $query = "SELECT updated_at FROM `email_abandoned_cart` ";
        $result1 = $connection->fetchAll($query);
        foreach ($result1 as $id) 
        {
            // print_r($result1);
        }
        
        // Inject the DateTime class
        $currentDateTime = $this->getCurrentDateTime();
        // echo "Current Date and Time: " . $currentDateTime;

        $abandonedCartsSend = $this->abandonedCartsSend();
    }

    public function getCurrentDateTime()
    {
        $currentDateTime = $this->dateTime->gmtDate(); // Get current GMT date and time
        return $currentDateTime;
    }

    public function abandonedCartsSend()
    {
        // for abandoned cart 1
        $enable1 = $this->dataHelper->getIsEnabled1();
        $sendAfter1 = $this->dataHelper->getSendAfter1();
        // echo $sendAfter1;
        $sender1 = $this->dataHelper->getSender1();
        $emailtmp1 = $this->dataHelper->getTemplate1();
        $coupon1 = $this->dataHelper->getCoupon1();
        // for abandoned cart 2
        $enable2 = $this->dataHelper->getIsEnabled2();
        $sendAfter2 = $this->dataHelper->getSendAfter2();
        // echo $sendAfter2;
        $sender2 = $this->dataHelper->getSender2();
        $emailtmp2 = $this->dataHelper->getTemplate2();
        $coupon2 = $this->dataHelper->getCoupon2();
        // for abandoned cart 3
        $enable3 = $this->dataHelper->getIsEnabled3();
        $sendAfter3 = $this->dataHelper->getSendAfter3();
        // echo $sendAfter3;
        $sender3 = $this->dataHelper->getSender3();
        $emailtmp3 = $this->dataHelper->getTemplate3();
        $coupon3 = $this->dataHelper->getCoupon3();
        // for abandoned cart 4
        $enable4 = $this->dataHelper->getIsEnabled4();
        $sendAfter4 = $this->dataHelper->getSendAfter4();
        // echo $sendAfter4;
        $sender4 = $this->dataHelper->getSender4();
        $emailtmp4 = $this->dataHelper->getTemplate4();
        $coupon4 = $this->dataHelper->getCoupon4();
    
    }

}
