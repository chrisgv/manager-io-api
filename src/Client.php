<?php

namespace ManagerIO;

class Client {
	
	//Base URL of where manager.io is
	private $host;
	private $username;
	private $password;
	private $businessKey;
	
	//ManagerIO generates this keys, it doesn't change
	private $defautlKeys = [
		'Customer' => 'ec37c11e-2b67-49c6-8a58-6eccb7dd75ee'
	];
	
	public function __construct($host,$username,$password,$businessKey) {
		$this->host = $host;
		$this->username = $username;
		$this->password = $password;
		$this->businessKey = $businessKey;
	}
	
	
	public function add() {

	}
	
	public function edit() {
		
	}
	
	public function delete() {
		
	}
	
}