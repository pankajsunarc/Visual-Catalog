<?php

namespace Sunarc\Visualcatalog\Block\Adminhtml;

class Products extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    protected $_productFactory;

    protected $_productRepositoryFactory;
    protected $_storeManager;

    protected $_category;
    protected $_pageSize = 10;
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Magento\Catalog\Model\ProductFactory $productFactory
     * @param \Magento\Framework\Registry $coreRegistry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Catalog\Api\ProductRepositoryInterfaceFactory $productRepositoryFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        array $data = []
    )
    {
        $this->_productFactory = $productFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->_productRepositoryFactory = $productRepositoryFactory;
        $this->_storeManager = $storeManager;
        $this->_categoryFactory = $categoryFactory;
        parent::__construct($context, $backendHelper, $data);
    }


    protected function _prepareLayout()
    {

        parent::_prepareLayout();
        if ($this->_getProductCollection()) {
            // create pager block for collection
            $pager = $this->getLayout()->createBlock('Magento\Theme\Block\Html\Pager','my.custom.pager');

            $pager->setAvailableLimit(array(10=>10,20=>20,30=>30,50=>50,100=>100))->setShowPerPage(true)->setCollection(
                $this->_getProductCollection()
            );
            $pager->setTemplate('Sunarc_Visualcatalog::pager.phtml');
            $this->setChild('pager', $pager);// set pager block in layout
        }

        $this->getToolbar()->addChild(
            'back_button',
            'Magento\Backend\Block\Widget\Button',
            [
                'label' => __('Back'),
                'onclick' => "window.location.href = '" . $this->getUrl('*/*') . "'",
                'class' => 'action-back'
            ]
        );

        $this->getToolbar()->addChild(
            'save',
            'Magento\Backend\Block\Widget\Button',
            ['id' => 'save',
                'label' => __('Save'),
                'class' => 'save primary',
                'onclick' => "submitPositionForm('" . $this->getFormAction() . "')"
            ]
        );
        return $this;

    }


    /**
     * @return array|null
     */
    public function getCategory()
    {
        return $this->_coreRegistry->registry('category');
    }


    /**
     * Retrieve loaded category collection
     *
     * @return AbstractCollection
     */
    public function getLoadedProductCollection()
    {
        return $this->_getProductCollection();
    }


    public function getCurrentCategory()
    {
        $category = $this->_objectManager->get('Magento\Framework\Registry')->registry('current_category');
        return $category;
    }

    /**
     * Retrieve loaded category collection
     *
     * @return AbstractCollection
     */
    private function _getProductCollection()
    {

        $categoryId = $this->getRequest()->getParam('id');
        $category = $this->_categoryFactory->create()->load($categoryId);

        $this->_productCollection = $this->_categoryFactory->create()->load($categoryId)->getProductCollection()
        ->addAttributeToSelect('*');
        $this->_productCollection->getSelect()->order(array(new \Zend_Db_Expr("CASE WHEN `cat_index_position` = '0' THEN 9999 ELSE 1 END"), 'cat_index_position ASC'));
       // $this->_productCollection->getSelect()->order(new \Zend_Db_Expr("CASE WHEN `cat_index_position` = '0' THEN 9999 ELSE 1 END"));

        //get values of current page
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        //get values of current limit
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : $this->_pageSize;

        //$this->_productCollection = $category->getProductCollection()
           // ->addAttributeToSelect('*')->setOrder('cat_index_position','ASC');

        $storeId = (int)$this->getRequest()->getParam('store', 0);
        if ($storeId > 0) {
            $this->_productCollection->addStoreFilter($storeId);
        }

        $this->_productCollection->setPageSize($pageSize);
        $this->_productCollection->setCurPage($page);

        return $this->_productCollection;
    }

    public function getImageData($_product)
    {
        $product = $this->_productRepositoryFactory->create()->getById($_product->getId());
        return $this->_storeManager->getStore()->getBaseUrl() . 'pub/media/catalog/product/' . $product->getData('thumbnail');
    }

    /*
     * Get catalog price with format
     */
    public function getPriceFormat($price)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of Object Manager
        $priceHelper = $objectManager->create('Magento\Framework\Pricing\Helper\Data'); // Instance of Pricing Helper
        return $formattedPrice = $priceHelper->currency($price, true, false);
    }


    /**
     * Retrieve list toolbar HTML
     *
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }


    public function getFormAction()
    {
        $id = $this->getRequest()->getParam('id');
        return $this->getUrl('*/*/save', ['_current' => false, 'id' => $id, '_query' => false]);

    }


}