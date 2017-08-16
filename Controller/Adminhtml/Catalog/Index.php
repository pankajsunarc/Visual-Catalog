<?php

namespace Sunarc\Visualcatalog\Controller\Adminhtml\Catalog;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action;


use Magento\Framework\App\ResponseInterface;

class Index extends Action
{

    private $resultPageFactory;
    private $orderFactory;

    /**
     * Edit constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->orderFactory = $orderFactory;
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Catalog Positions'));
        $resultPage->addBreadcrumb(__('Manage Catalog Categories'), __('Manage Catalog Positions'));
        return $resultPage;
    }//end execute()
}//end class
