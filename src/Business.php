<?php

namespace ManagerIO;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\TooManyRedirectsException;

class Business {
	/** @var array Generated IDs of categories */
	private $defaultKeys = [
		'Customer' => 'ec37c11e-2b67-49c6-8a58-6eccb7dd75ee'
	];
	
	/**
	* @param string $host        https://domain.com/api/
	* @param string $username    Username in managerIO
	* @param string $password    Password in managerIO
	* @param string $businessKey XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
	*/
	public function __construct($host,$username,$password,$businessKey) {
		
		$this->client = new GuzzleClient([
			'base_uri' => $host.$businessKey.'/',
			'auth' => [$username,$password]
		]);
		
	}
	
	/**
	* @param string $id XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
	*
	* @return json
	*/
	public function view($id) {
		try{
			
			$response = $this->client->request('GET',$id.'.json');
			
			//Returns data in JSON format
			return (string)$response->getBody();
		
		} catch(ClientException $e) {
			//Client error "Status code : Reason phrase"
			echo $this->exceptionMessage($e);
			
		} catch(ConnectException $e) {
			echo 'Connection cannot be established.';
			
		} catch(ServerException $e) {
			//Server error "Status code : Reason phrase"
			echo $this->exceptionMessage($e);
			
		}
	}
	
	/**
	* @param object $object
	*/
	public function add($object) {
		try {
			
			/** @var string Gets the class name withour namespace */
			$classname = (new \ReflectionClass($object))->getShortName();
			$response = $this->client->request('POST',$this->defaultKeys[$classname],[
				'json' => $object->get()
			]);
		
		} catch(ClientException $e) {
			//Client error "Status code : Reason phrase"
			echo $this->exceptionMessage($e);
			
		} catch(ConnectException $e) {
			echo 'Connection cannot be established.';
			
		} catch(ServerException $e) {
			//Server error "Status code : Reason phrase"
			echo $this->exceptionMessage($e);
			
		}
	}
	
	
	/**
	* @param string $id     XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
	* @param object $object
	*/
	public function edit($id,$object) {
		try {
			
			$response = $this->client->request('PUT',$id,[
				'json' => $object->get()
			]);
		
		} catch(ClientException $e) {
			//Client error "Status code : Reason phrase"
			echo $this->exceptionMessage($e);
			
		} catch(ConnectException $e) {
			//Connection cannot be established
			echo 'Connection cannot be established.';
			
		} catch(ServerException $e) {
			//Server error "Status code : Reason phrase"
			echo $this->exceptionMessage($e);
			
		}
	}
	
	/**
	* @param string $id XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
	*/
	public function delete($id) {
		try {
			
			$response = $this->client->request('DELETE',$id.'.json');
		
		} catch(ClientException $e) {
			//Client error "Status code : Reason phrase"
			echo $this->exceptionMessage($e);
			
		} catch(ConnectException $e) {
			//Connection cannot be established
			echo 'Connection cannot be established.';
			
		} catch(ServerException $e) {
			//Server error "Status code : Reason phrase"
			echo $this->exceptionMessage($e);
			
		}
	}
	
	/**
	* Helper for the exception message 
	*
	* @param GuzzleHttp\Exception\ClientException | GuzzleHttp\Exception\ClientException $exception
	*
	* @return string
	*/
	private function exceptionMessage($e) {
		return $e->getResponse()->getStatusCode() .' '. $e->getResponse()->getReasonPhrase();
	}
	
}