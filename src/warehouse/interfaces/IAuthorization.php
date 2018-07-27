<?php

namespace App\Warehouse\Interfaces;

interface IAuthorization {

	/**
	 * Get current user
	 * @return array
	 */
	public function getCurrentUser(): array;

	/**
	 * Check user status
	 * @return bool
	 */
	public function access(): bool;

	/**
	 * Login user
	 * @param string $email
	 * @param string $password
	 * @param bool $remember
	 * @return array
	 */
	public function login(string $email, string $password, $remember = false): array;

	/**
	 * Logout user
	 * @param string $hash
	 * @return bool
	 */
	public function logout(): bool;

	/**
	 * Register user
	 * @param string $email
	 * @param string $password
	 * @return array
	 */
	public function registerUser(string $email, string $password): array;

	/**
	 * Get current user
	 * @param string $email
	 * @param string $password
	 * @return array
	 */
	public function addUser(string $email, string $password): array;

	/**
	 * Get random string
	 * @return string
	 */
	public function getIp();

	/**
	 * Get random string
	 * @param int $length
	 * @return string
	 */
	public function getRandomKey($length = 8);

}