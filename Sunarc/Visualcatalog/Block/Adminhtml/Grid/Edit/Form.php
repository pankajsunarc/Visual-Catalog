<?php
/**
 * @copyright Copyright (c) 2016 www.magebuzz.com
 */

namespace Sunarc\Visualcatalog\Block\Adminhtml\Grid\Edit;

/**
 * Adminhtml staff edit form
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory ;

    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->resultPageFactory  = $resultPageFactory;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('grid_form');
        $this->setTitle(__('Staff Information'));
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('customfield_');
//        $fieldset = $form->addFieldset(
//            'base_fieldset',
//            ['legend' => __('Custom Form Field'), 'class' => 'fieldset-wide']
//        );

        //$resultPage = $this->resultPageFactory->create();
        //$blockInstance = $resultPage->getLayout()->getBlock('Sunarc\Visualcatalog\Block\Adminhtml\Products');
        //$products = $blockInstance->getLoadedProductCollection();
        //if($products->count() > 0 ){
            //foreach ($products as $product){
                $form->addType('productlist', '\Sunarc\Visualcatalog\Block\Adminhtml\Grid\Edit\Renderer\ProductList');

                $form->addField(
                    'Uploaded File',
                    'productlist',
                    [
                        'name'  => 'productlist',
                        'label' => __('Product List'),
                        'title' => __('Product List'),
                        'test' => 'HEllo'

                    ]
                );
            //}
        //}


        $this->setForm($form);
        return parent::_prepareForm();

//        echo "fsafsa";exit;
//        /** @var \Magebuzz\Staff\Model\Grid $model */
//        $model = $this->_coreRegistry->registry('staff_grid');
//
//        /** @var \Magento\Framework\Data\Form $form */
//        $form = $this->_formFactory->create(
//            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
//        );
//
//        $form->setHtmlIdPrefix('staff_');
//
//        $fieldset = $form->addFieldset(
//            'base_fieldset',
//            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
//        );
//
//        if ($model->getId()) {
//            $fieldset->addField('staff_id', 'hidden', ['name' => 'staff_id']);
//        }
//
//        $fieldset->addField(
//            'staff_name',
//            'text',
//            ['name' => 'staff_name', 'label' => __('Staff Name'), 'title' => __('Staff Name'), 'required' => true]
//        );
//        $fieldset->addField(
//            'staff_email',
//            'text',
//            ['name' => 'staff_email', 'label' => __('Email'), 'title' => __('Email'), 'required' => true]
//        );
//        $fieldset->addField(
//            'status',
//            'select',
//            [
//                'label' => __('Status'),
//                'title' => __('Status'),
//                'name' => 'status',
//                'required' => true,
//                'options' => ['1' => __('Enabled'), '0' => __('Disabled')]
//            ]
//        );
//        $form->setValues($model->getData());
//        $form->setUseContainer(true);
//        $this->setForm($form);
//
//        return parent::_prepareForm();
    }
}