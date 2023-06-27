<?php 
namespace Ntz\AbandonedCart\Controller\Adminhtml\Cart;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
* Class Index
* @package PandaGroup\MyAdminController\Controller\Adminhtml\Blog
*/
class Index extends Action
  {
    protected $resultPageFactory = false;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
    Context $context,
    PageFactory $resultPageFactory
    ) {
    parent::__construct($context);
    $this->resultPageFactory = $resultPageFactory;
  }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
   {
    $resultPage = $this->resultPageFactory->create();
    $resultPage->getConfig()->getTitle()->prepend((__('Abandoned Cart')));

    return $resultPage;
  }
  }
