<?php

require_once '../../vendor/autoload.php';

use App\Warehouse\Authorization;
use App\Warehouse\Storage;
use App\Warehouse\WarehouseController;

$auth = new Authorization();
$storage = new Storage();

$get = file_get_contents('php://input');
$controller = new WarehouseController($auth, $storage);
$controller->process($get);

