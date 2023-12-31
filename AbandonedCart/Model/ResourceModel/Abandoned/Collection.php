<?php
namespace Ntz\AbandonedCart\Model\ResourceModel\Abandoned;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * IdFieldName
     *
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Initialize resource collection.
     *
     * @return null
     */
    public function _construct()
    {
        $this->_init(
            \Ntz\AbandonedCart\Model\Abandoned::class,
            \Ntz\AbandonedCart\Model\ResourceModel\Abandoned::class
        );
    }
}
