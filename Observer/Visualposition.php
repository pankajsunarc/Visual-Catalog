<?php

namespace Sunarc\Visualcatalog\Observer;

use \Magento\Framework\Event\Observer;
use \Magento\Framework\Event\ObserverInterface;

class Visualposition implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $_product = $observer->getProduct();
        $_productId = $_product->getId();

        $categories = $_product->getCategoryIds();

        foreach ($categories as $categoryId) {
            $category = $objectManager->create('Magento\Catalog\Model\Category')->load($categoryId);
            $productPositions = $category->getProductsPosition();
            $lastPositions = max($productPositions);
            if (count(array_keys($productPositions, $productPositions[$_productId])) > 1) {
                $productPositions[$_productId] = $lastPositions+1;
                $category->setPostedProducts($productPositions);
                $category->save();
            }
        }
    }
}
