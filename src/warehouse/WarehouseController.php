<?php

namespace App\Warehouse;

use App\Warehouse\Authorization;
use App\Warehouse\Storage;

class WarehouseController {

	/**
     * @access private
     * @var object Authorization
     */
	private $auth;
	
	/**
     * @access private
     * @var object Storage
     */
	private $storage;

	/**
	 * @access private
	 * @var array $data	 
	 *
	 */
	private $data;

	/**
	 * WarehouseController constructor
	 * @param Authorization $auth
	 * @param Storage $storage
	 */
	public function __construct(Authorization $auth, Storage $storage) {
		$this->auth = $auth;
		$this->storage = $storage;
	}

	/**
	 * Process api method
	 * @param string $data json
	 */
	public function process (string $data) {

		if (!$this->requestValidate() || !($method = $this->methodValidate())) {
			$this->response(false);
		}

		if (!$this->methodCommon($method) && !$this->auth->access()) {
			$this->response(false);
			return;
		}

		$this->prepareData($data);
	//$method = 'listproduct';
	//file_put_contents('test.txt', serialize($this->data));
		switch ($method) {
			case 'login': $this->userLogin();
			case 'logout': $this->userLogout();
			case 'listproduct': $this->productList();
			case 'amountproduct': $this->productAmount();
			case 'getproduct': $this->productGet();
			case 'putproduct': $this->productPut();
		}
	}

	/**
	 * User login method
	 * @access private
	 */
	private function userLogin() {		
		///For dev only
		switch ($this->data['authData']) {
			case '11 11 111111': {
				$user = 'grantey@gmail.com';
				$password = '1111';
			} break;
			case '1111 1111': {
				$user = 'grtony@gmail.com';
				$password = '1111';
			} break;
			default: {
				$user = 'wronguser';
				$password = 'wrongpassword';
			}
		}

		switch ($this->data['authOwner']) {
			case 'zina': case 'valya': $loginType = 'login'; break;
			case 'robot': $loginType = 'login'; break;
			default: $loginType = 'login';
		}
		///End for dev		

		$result = $this->auth->{$loginType}($user, $password);		

		$status = ($result['error'] ? false : true);

		$this->response($status, [
			'message' => $result['message']
		]);
	}

	/**
	 * User logout method
	 * @access private
	 */
	private function userLogout() {
		$result = $this->auth->logout();

		$this->response($result);
	}

	/**
	 * User get information method
	 * @access private
	 */
	private function userGet() {
		$result = $this->auth->getCurrentUser();

		$status = !empty($result);

		$this->response($status, $result);
	}

	/**
	 * Product list receiving method
	 * @access private
	 */
	private function productList() {
		$result = $this->storage->getProductList($this->data['warehouseOwner']);

		$status = !empty($result);

		$this->response($status, $result);
	}

	/**
	 * Product list receiving method
	 * @access private
	 */
	private function productAmount() {
		$result = $this->storage->getProductAmount($this->data['productId']);

		$status = !empty($result);

		$this->response($status, [
			'message' => $result
		]);
	}	

	/**
	 * Product shipment method
	 * @access private
	 */
	private function productGet() {
		$result = $this->storage->decreaseProductAmount($this->data['productId'], $this->data['amount']);

		$this->response($result);
	}

	/**
	 * Product receiving method
	 * @access private
	 */
	private function productPut() {
		$result = $this->storage->increaseProductAmount($this->data['productId'], $this->data['amount']);

		$this->response($result);
	}

	/**
	 * Prepare input data
	 * @access private
	 * @param string data
	 */
	private function prepareData(string $data) {
		$data_arr = json_decode($data, true);

		foreach ($data_arr as $key => $value) {
			$this->data[$key] = htmlspecialchars($value);
		}
	}

	/**
	 * Send response
	 * @access private
	 * @param bool $status
	 * @param array $data
	 */
	private function response($status, array $data = []) {
		if ($status) {
			header('Content-Type: application/json');        	
		} else {
			header('HTTP/1.1 500 Internal Server Error');
        	header('Content-Type: application/json; charset=UTF-8');        	
		}

		print json_encode($data, JSON_UNESCAPED_UNICODE);

		die();
	}

	/**
	 * Check for method
	 * @access private
	 * @return mixed
	 */
	private function methodValidate() {
		$available_methods = [
			'login',
			'logout',
			'listproduct',
			'amountproduct',
			'getproduct',
			'putproduct',
		];

		$url = $_SERVER['REQUEST_URI'];
		$parts = parse_url($url);

		if (!array_key_exists('query', $parts)) {
			$this->response(false);
		}

		parse_str($parts['query'], $query);			
		
		if (!array_key_exists('method', $query)) {
			$this->response(false);
		}

		$method = $query['method'];		

		return in_array($method, $available_methods) ? $method : false;
	}

	/**
	 * Check for method access
	 * @access private
	 * @param string $method
	 * @return bool
	 */
	private function methodCommon($method) {
		$available_methods = [
			'login',
			'listproduct',
			'putproduct',
		];

		return in_array($method, $available_methods);
	}

	/**
	 * Check for request
	 * @access private
	 * @return bool
	 */
	private function requestValidate() {
		return array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
	}
}