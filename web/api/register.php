<?php

$config = require '../../config/main.php';
require_once '../../vendor/autoload.php';

use PHPAuth\Config as PHPAuthConfig;
use PHPAuth\Auth as PHPAuth;

$dbh = new PDO("mysql:host={$config['db']['host']};dbname={$config['db']['name']}", $config['db']['user'], $config['db']['password']);

$authConfig = new PHPAuthConfig($dbh);
$auth = new PHPAuth($dbh, $authConfig);

/**
register
Description:
Handles the registration of a new user.

Parameters:

$email (string): User's email address
$password (string): User's password
$repeatpassword (string): User's password confirmation
$params (array): additional params to set in users table (attr_name => value), default Array()
$captcha_response (string): captcha code if needed, default NULL
$use_email_activation (boolean): enable/disable email activation, default NULL

Returns:

$return (array)
error (boolean): Informs whether an error was encountered or not
message (string): User-friendly error / success message

*/
/*
$result = $auth->register('grtony@gmail.com', '1111', '1111');
print_r($result).'<br>';

$result = $auth->register('grantey@gmail.com', '1111', '1111');
print_r($result).'<br>';
*/