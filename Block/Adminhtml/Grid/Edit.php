<?php
/**
 * @copyright Copyright (c) 2016 www.magebuzz.com
 */

namespace Sunarc\Visualcatalog\Block\Adminhtml\Grid;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize staff grid edit block
     *
     * @return void
     */
    public function _construct()
    {

        $this->_blockGroup = 'Sunarc_Visualcatalog';
        $this->_controller = 'adminhtml_grid';
        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save Staff'));
        $this->buttonList->add(
            'saveandcontinue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                    ],
                ]
            ],
            -100
        );
    }

//    /**
//     * Retrieve text for header element depending on loaded blocklist
//     *
//     * @return \Magento\Framework\Phrase
//     */
//    public function getHeaderText()
//    {
//        return __('New Staff');
//    }
//
//    /**
//     * Getter of url for "Save and Continue" button
//     * tab_id will be replaced by desired by JS later
//     *
//     * @return string
//     */
//    protected function _getSaveAndContinueUrl()
//    {
//        return $this->getUrl('staff/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
//    }
}
