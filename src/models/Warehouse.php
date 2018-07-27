<?php

class Warehouse extends ActiveRecord\Model
{	
	static $table_name = 'warehouse';
	static $primary_key = 'id';

	static $has_many = [
		[
			'product'
		]
	];
}