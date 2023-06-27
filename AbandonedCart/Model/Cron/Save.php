<?php
namespace Ntz\AbandonedCart\Model\Cron;

use Ntz\AbandonedCart\Model\AbandonedFactory;
use Magento\Quote\Model\ResourceModel\Quote\CollectionFactory as QuoteCollectionFactory;

class Save
{
    protected $quoteCollectionFactory;
    protected $abandonedFactory;
    
    public function __construct(QuoteCollectionFactory $quoteCollectionFactory, 
     AbandonedFactory $abandonedFactory)
    {
        $this->quoteCollectionFactory = $quoteCollectionFactory;
        $this->abandonedFactory = $abandonedFactory;
    }
    
    public function abandonedCartsSave()
    {
        $quoteCollection = $this->quoteCollectionFactory->create();
        $quoteCollection->addFieldToFilter('is_active', 1);
        
        foreach ($quoteCollection as $quote) {
            $quoteData = $quote->getData();
            // print_r($quoteData);
            $this->saveToCustomTable($quoteData);
        }
    }
    private function saveToCustomTable($quoteData)
    {
        $abandonedCart = $this->abandonedFactory->create();
        $abandonedCart->setData($quoteData)->save();
        // print_r($abandonedCart->getData());
    }

}
