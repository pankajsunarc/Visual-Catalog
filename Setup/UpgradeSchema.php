<?php

namespace Sunarc\Visualcatalog\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $tableName = $setup->getTable('catalog_category_product');
//        if (version_compare($context->getVersion(), '2.0.0') < 0) {
//            // Changes here.
//        }
//
//        if (version_compare($context->getVersion(), '2.0.1', '<')) {
//            // Changes here.
//        }
        if (version_compare($context->getVersion(), "1.0.0", "<")) {
            //Your upgrade script
        }

        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            if ($setup->getConnection()->isTableExists($tableName) == true) {
                $connection = $setup->getConnection();
                $sql = "Select DISTINCT category_id FROM " . $tableName;
                $result = $connection->fetchAll($sql);
                foreach ($result as $res){
                    $query1 = "SET @pos := 0; ";
                    $query2 = "UPDATE catalog_category_product SET position = ( SELECT @pos := @pos + 1 ) where category_id='".$res['category_id']."' ORDER BY position DESC";

                    $connection->query($query1);
                    $connection->query($query2);

                    // $connection->query("UPDATE $tableName SET `order` = $total-($i:=$i+1)+1 where category_id='".$res['category_id']."'");
                }
            }
        }


        $setup->endSetup();

    }
}