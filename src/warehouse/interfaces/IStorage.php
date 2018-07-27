<?php

namespace App\Warehouse\Interfaces;

interface IStorage {

	/**
	 * Get warehouse information
	 * @param string $owner warehouse owner
	 * @return array
	 */
	public function getWarehouseInfo(string $owner): array;

	/**
	 * Get products list
	 * @param string $owner warehouse owner
	 * @return array
	 */
	public function getProductList(string $owner): array;

	/**
	 * Get products count
	 * @param int $product_id product uid
	 * @return int
	 */
	public function getProductAmount($product_id): int;

	/**
	 * Product shipment
	 * @param int $product_id product uid
	 * @param int $amount product amount
	 * @return bool
	 */
	public function decreaseProductAmount($product_id, $amount = 0): bool;

	/**
	 * Product receiving
	 * @param int $product_id product uid
	 * @param int $amount product amount
	 * @return bool
	 */
	public function increaseProductAmount($product_id, $amount = 0): bool;

}