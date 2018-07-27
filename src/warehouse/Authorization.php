<?php

namespace App\Warehouse;

use App\Warehouse\Interfaces\IAuthorization;
use PHPAuth\Config as PHPAuthConfig;
use PHPAuth\Auth as PHPAuth;

class Authorization implements IAuthorization {

	/**
     * @access private
     * @var object PHPAuth
     */
	private $auth;

	/**
     * @access private
     * @var object PHPAuthConfig
     */
	private $authConfig;

	/**
	 * Authorization constructor
	 */
	public function __construct() {
		
		$config = require $_SERVER['DOCUMENT_ROOT'] . '/config/main.php';
		$db = $config['db'];

		$dbh = new \PDO("mysql:host={$db['host']};dbname={$db['name']}", $db['user'], $db['password']);

		$this->authConfig = new PHPAuthConfig($dbh);
		$this->auth = new PHPAuth($dbh, $this->authConfig);

	}

	/**
	 * Get current user
	 * @access public 
	 * @return array
	 */
	public function getCurrentUser(): array {
		$result = $this->auth->getCurrentUser();

		return $result;
	}

	/**
	 * Check user status
	 * @access public
	 * @return bool
	 */
	public function access(): bool {
		return $this->auth->isLogged();
	}

	/**
	 * Login user
	 * @access public 
	 * @param string $email
	 * @param string $password
	 * @param bool $remember
	 * @return array
	 */
	public function login(string $email, string $password, $remember = false): array {
		$result = $this->auth->login($email, $password, $remember);

		return $result;
	}

	/**
	 * Logout user
	 * @access public 
	 * @param string $hash
	 * @return bool
	 */
	public function logout(): bool {
		$hash = $this->auth->getCurrentSessionHash();
		$result = $this->auth->logout($hash);

		return $result;
	}	

	/**
	 * Register user
	 * @access public 
	 * @param string $email
	 * @param string $password
	 * @return array
	 */
	public function registerUser(string $email, string $password): array {
		$result = $this->auth->register($email, $password, $password);

		return $result;
	}	

	/**
	 * Get current user
	 * @access public 
	 * @param string $email
	 * @param string $password
	 * @return array
	 */
	public function addUser(string $email, string $password): array {
		$result = $this->auth->addUser($email, $password);

		return $result;
	}	

	/**
	 * Get random string
	 * @access public
	 * @return string
	 */
	public function getIp() {
		$result = $this->auth->getIp();

		return $result;
	}	

	/**
	 * Get random string
	 * @access public
	 * @param int $length
	 * @return string
	 */
	public function getRandomKey($length = 8) {
		$result = $this->auth->getRandomKey($length);

		return $result;
	}

	/**
	 * Get current user hash
	 * @access private
	 * @return string
	 */
	/*
	private function getHash() {
		$uid = $this->auth->getCurrentUID();

		$config = require $_SERVER['DOCUMENT_ROOT'] . '/config/main.php';
		$db = $config['db'];

		$dbh = new \PDO("mysql:host={$db['host']};dbname={$db['name']}", $db['user'], $db['password']);
		$stmt = $dbh->prepare('SELECT hash FROM phpauth_sessions WHERE uid = ?');
		$stmt->execute([$uid]);

		$hash = $stmt->fetch()['hash'];

		return $hash;
	}*/
}