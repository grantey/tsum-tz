<?php

class Product extends ActiveRecord\Model
{	
	static $table_name = 'product';
	static $primary_key = 'id';

	static $belongs_to = [
		[
			'warehouse'
		]
	];
}