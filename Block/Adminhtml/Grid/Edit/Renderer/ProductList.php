<?php

namespace Sunarc\Visualcatalog\Block\Adminhtml\Grid\Edit\Renderer;

/**
 * CustomFormField Customformfield field renderer
 */
class ProductList extends \Magento\Framework\Data\Form\Element\AbstractElement
{
    /**
     * Get the after element html.
     *
     * @return mixed
     */
    public function getElementHtml()
    {
        // here you can write your code.
        $customDiv = '<div style="width:600px;height:200px;margin:10px 0;border:2px solid #000" id="customdiv"><h1 style="margin-top: 12%;margin-left:40%;">Custom Div</h1></div>';
        return $customDiv;

    }
}