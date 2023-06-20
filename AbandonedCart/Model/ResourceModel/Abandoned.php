<?php
namespace Ntz\AbandonedCart\Model\ResourceModel;

class Abandoned extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource.
     *
     * @return null
     */
    public function _construct()
    {
        $this->_init('email_abandoned_cart', 'id');
    }

    /**
     * Construct
     *
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context context
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }
}
