<?php
/**
 * Show collection of on-sale products
 *
 * @category    Ash
 * @package     Ash_Onsale
 * @copyright   Copyright (c) 2013 August Ash, Inc. (http://www.augustash.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author      August Ash Team <core@augustash.com>
 */

/**
 * Product list
 *
 * @category   Ash
 * @package    Ash_Onsale
 */
class Ash_Onsale_Block_Product_List extends Mage_Catalog_Block_Product_List
{
    /**
     * Retrieve loaded category collection
     *
     * @return Mage_Eav_Model_Entity_Collection_Abstract
     */
    protected function _getProductCollection()
    {
        $collection = parent::_getProductCollection();

        /*
         * Collections using Product Flat index require different processing.
         */
        if (Mage::getStoreConfigFlag('catalog/frontend/flat_catalog_product')) {
            $collection
                ->getSelect()
                ->where(new Zend_Db_Expr('price_index.final_price < price_index.price'));
        } else {
            $today = date('Y-m-d', time());
            $collection
                ->addAttributeToFilter('special_price', array('is' => new Zend_Db_Expr('not null')))
                ->addAttributeToFilter('special_from_date', array(
                    'or' => array(
                        0 => array('date' => true, 'to' => $today),
                        1 => array('is' => new Zend_Db_Expr('null')),
                    )), 'left')
                ->addAttributeToFilter('special_to_date', array(
                    'or' => array(
                        0 => array('date' => true, 'from' => $today),
                        1 => array('is' => new Zend_Db_Expr('null')),
                    )), 'left');
        }

        return $collection;
    }
}
