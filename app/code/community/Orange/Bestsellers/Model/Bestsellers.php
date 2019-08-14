<?php
class Orange_Bestsellers_Model_Bestsellers extends Mage_Core_Model_Abstract
{
	function getStoreData($item)
	{
		return Mage::getStoreConfig('orange_bestsellers/settings/' . $item);
	}
	public function showTitle()
	{
		return $this->getStoreData('show_title');
	}
	public function getTitle()
	{
		return $this->getStoreData('block_title');
	}
	public function isActive()
	{
		return $this->getStoreData('enable');
	}
	public function addToCart()
	{
		return $this->getStoreData('addtocart');
	}
	public function data()
	{
		$_limit = $this->getStoreData('display_products');
		if($_limit < 1)
			$_limit = 0;
		$_productCollection = Mage::getResourceModel('reports/product_collection')
			->addAttributeToFilter('visibility', array('neq' => 1))
			->addAttributeToSelect('*')
			->addOrderedQty()
			->setOrder('ordered_qty','desc')
			->setPageSize($_limit);
		return $_productCollection;
	}
}
