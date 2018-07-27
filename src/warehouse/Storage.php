<?php

namespace App\Warehouse;

use App\Warehouse\Interfaces\IStorage;

class Storage implements IStorage {

	/**
	 * Authorization constructor
	 */
	public function __construct() {

		$config = require $_SERVER['DOCUMENT_ROOT'] . '/config/main.php';
		$db = $config['db'];

		$connections = [
    		'development' => "mysql://{$db['user']}:{$db['password']}@{$db['host']}/{$db['name']}",
    		'production' => "mysql://{$db['user']}:{$db['password']}@{$db['host']}/{$db['name']}"		
		];

		$cfg = \ActiveRecord\Config::instance();
 		$cfg->set_model_directory($_SERVER['DOCUMENT_ROOT'] . '/src/models');
	    $cfg->set_connections($connections);
		$cfg->set_default_connection('development');
	}

	/**
	 * Get warehouse information
	 * @access public
	 * @param string $owner warehouse owner
	 * @return array
	 */
	public function getWarehouseInfo(string $owner): array {
		$warehouse = \Warehouse::find_by_owner($owner)->to_array();		

		return $warehouse;
	}	

	/**
	 * Get products list
	 * @access public
	 * @param string $owner warehouse owner
	 * @return array
	 */
	public function getProductList(string $owner): array {		
		$warehouse = \Warehouse::find_by_owner($owner);

		$products_arr = [];

		$products = $warehouse->product;
		foreach ($products as $product) {
			$products_arr[] = $product->to_array();	
		}

		return $products_arr;
	}

	/**
	 * Get products count
	 * @access public
	 * @param int $product_id product uid
	 * @return int
	 */
	public function getProductAmount($product_id): int {
		$product = \Product::first(['id' => $product_id]);

		return $product->amount;
	}

	/**
	 * Product shipment
	 * @access public
	 * @param int $product_id product uid
	 * @param int $amount product amount
	 * @return bool
	 */
	public function decreaseProductAmount($product_id, $amount = 0): bool {
		
		$product = \Product::first(['id' => $product_id]);

		if (empty($product) || $product->amount < $amount) {
			return false;
		} 
			
		$product->amount -= $amount;
		$result = $product->save();
		
		return $result; 		
	}
	
	/**
	 * Product receiving
	 * @access public
	 * @param int $product_id product uid
	 * @param int $amount product amount
	 * @return bool
	 */
	public function increaseProductAmount($product_id, $amount = 0): bool {
		
		$product = \Product::first(['id' => $product_id]);

		if (empty($product)) {
			return false;
		} 
			
		$product->amount += $amount;
		$result = $product->save();
		
		return $result; 		
	}
}