<?php

namespace App\Warehouse;

abstract class Product {

    /**
     * @access protected
     * @var int unique id
     */
    protected $uid;

	/**
     * @access private
     * @var string product name
     */
    private $name;

    /**
     * @access private
     * @var int product price
     */
    private $price;

    /**
     * @access private
     * @var int product category
     */
    private $category;

    /**
     * Product constructor
     * @param string $name
     * @param int $price
     * @param int $category
     */
    public function __construct($name, $price, $category)
    {
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
    }

    /**
     * Set product property
     */
	public function __set($name, $value) {
    	if (method_exists($this, $name)) {
      		$this->{$name}($value);
    	}
    	else {
      		$this->$name = $value;
		}
	}

	/**
	 * Get product property
	 */
  	public function __get($name) {
		if (method_exists($this, $name)) {
      		return $this->{$name}();
    	}
		elseif (property_exists($this,$name)) {
			return $this->$name;
    	}
		return null;
	}
}