<?php
namespace Ntz\AbandonedCart\Model;

class Abandoned extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Abandoned constructor.
     *
     * @param \Magento\Framework\Model\Context                             $context            context
     * @param \Magento\Framework\Registry                                  $registry           registry
     * @param ResourceModel\Abandoned\CollectionFactory                    $abandoned          abandoned
     * @param \Magento\Framework\Stdlib\DateTime                           $dateTime           dateTime
     * @param array                                                        $data               data
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource           resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null           $resourceCollection resourceCollection
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        public \Ntz\AbandonedCart\Model\ResourceModel\Abandoned\CollectionFactory $abandonedCollectionFactory,
        public \Magento\Framework\Stdlib\DateTime $dateTime,
        array $data = [],
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null
    ) {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data
        );
    }

    /**
     * Constructor.
     *
     * @return null
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init(\Ntz\AbandonedCart\Model\ResourceModel\Abandoned::class);
    }

    /**
     * Prepare data to be saved to database.
     *
     * @return $this
     */
    public function beforeSave()
    {
        parent::beforeSave();
        if ($this->isObjectNew()) {
            $this->setCreatedAt($this->dateTime->formatDate(true));
        }
        $this->setUpdatedAt($this->dateTime->formatDate(true));

        return $this;
    }

    /**
     * LoadByQuoteId
     *
     * @param int $quoteId quoteId
     *
     * @return mixed
     */
    public function loadByQuoteId($quoteId, $storeId)
    {
        $collection = $this->abandonedCollectionFactory->create()
            ->addFieldToFilter('quote_id', $quoteId)
            ->addFieldToFilter('store_id', $storeId)
            ->setPageSize(1);

        return $collection->getFirstItem();
    }
}