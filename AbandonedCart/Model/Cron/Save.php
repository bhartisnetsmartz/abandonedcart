<?php
namespace Ntz\AbandonedCart\Model\Cron;

use Ntz\AbandonedCart\Model\AbandonedFactory;
use Magento\Framework\App\ResourceConnection;
use Magento\Quote\Model\ResourceModel\Quote\CollectionFactory as QuoteCollectionFactory;

class Save
{
    protected $quoteCollectionFactory;
    protected $abandonedFactory;
    protected $resourceConnection;
    
    public function __construct(QuoteCollectionFactory $quoteCollectionFactory, 
    ResourceConnection $resourceConnection,
     AbandonedFactory $abandonedFactory)
    {
        $this->quoteCollectionFactory = $quoteCollectionFactory;
        $this->abandonedFactory = $abandonedFactory;
        $this->resourceConnection = $resourceConnection;
    }
    
    public function abandonedCartsSave()
    {
        $connection = $this->resourceConnection->getConnection();
        $quoteCollection = $this->quoteCollectionFactory->create();
        $quoteCollection->addFieldToFilter('is_active', 1);
        $quoteCollection->addFieldToFilter('customer_email', ['neq' => '']);
        $arr_id=[];
        $query = "SELECT quote_id FROM `email_abandoned_cart` ";
        $result1 = $connection->fetchAll($query);
        foreach ($result1 as $id) 
        {
            
            $arr_id[]=$id['quote_id'];
           
        }
        foreach ($quoteCollection as $quote) {
            $quoteData = $quote->getData();
            //  print_r($quoteData["entity_id"]);
        if(!in_array($quoteData["entity_id"], $arr_id))
        {
             $this->saveToCustomTable($quoteData);
        }  
        }
    }
    private function saveToCustomTable($quoteData)
    {
        $abandonedCart = $this->abandonedFactory->create();
        $abandonedCart->setData($quoteData);//->save();
        $abandonedCart->setData("quote_id",$quoteData["entity_id"]);
        // print_r($abandonedCart->getData());
        $abandonedCart->save();
    }

}
