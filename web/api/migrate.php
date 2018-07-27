<?php

$config = require '../../config/main.php';
require_once '../../vendor/autoload.php';

use App\Migrations\Migration;

$migration = new Migration($config['db']);
$migration->migrate();
