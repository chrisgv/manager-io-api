<?php

namespace ManagerIO;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\TooManyRedirectsException;

class Business
{
	/** @var array Generated IDs of categories */
	private $defaultKeys = [
		'Customer' => 'ec37c11e-2b67-49c6-8a58-6eccb7dd75ee'
	];
	
	/** @var string ID of last inserted value */
	private $last;
	
	/**
	* @param string $host        https://domain.com/api/
	* @param string $username    Username in managerIO
	* @param string $password    Password in managerIO
	* @param string $businessId XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
	*/
	public function __construct($host,$username,$password,$businessId)
	{
		
		$this->client = new GuzzleClient([
			'base_uri' => $host.$businessId.'/',
			'auth' => [$username,$password]
		]);
		
	}
	
	/**
	* @param string $id XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
	*
	* @return array
	*/
	public function view($id)
	{
		try
		{
			
			$response = $this->client->request('GET',$id.'.json');
			
			//Returns data in array format
			return json_decode(
				(string)$response->getBody(),
				true
			);
		
		}
		catch(ClientException $e)
		{
			//Client error "Status code : Reason phrase"
			echo $this->exceptionMessage($e);
			
		}
		catch(ConnectException $e)
		{
			echo 'Connection cannot be established.';
			
		}
		catch(ServerException $e)
		{
			//Server error "Status code : Reason phrase"
			echo $this->exceptionMessage($e);
			
		}
	}
	
	/**
	* @param string $id  XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
	* @param array $data
	*
	* @return string
	*/
	public function add($id,$data)
	{
		try
		{
			//Get category list
			$old = $this->all($id);
			
			$response = $this->client->request('POST',$id,[
				'json' => $data
			]);
			
			//Get category list after insert
			$new = $this->all($id);
			
			$old = array_flip($old);
			$new = array_flip($new);
			
			$id = array_diff_key($new,$old);
			
			$this->last = array_keys($id)[0];
			
			//return the generated ID of the last inserted data
			return $this->last;

		}
		catch(ClientException $e)
		{
			//Client error "Status code : Reason phrase"
			echo $this->exceptionMessage($e);
			
		}
		catch(ConnectException $e)
		{
			echo 'Connection cannot be established.';
			
		}
		catch(ServerException $e)
		{
			//Server error "Status code : Reason phrase"
			echo $this->exceptionMessage($e);
			
		}
	}
	
	
	/**
	* @param string $id  XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
	* @param array $data
	*/
	public function edit($id,$data)
	{
		try
		{
			
			$response = $this->client->request('PUT',$id,[
				'json' => $data
			]);
		
		}
		catch(ClientException $e)
		{
			//Client error "Status code : Reason phrase"
			echo $this->exceptionMessage($e);
			
		}
		catch(ConnectException $e)
		{
			echo 'Connection cannot be established.';
			
		}
		catch(ServerException $e)
		{
			//Server error "Status code : Reason phrase"
			echo $this->exceptionMessage($e);
			
		}
	}
	
	/**
	* @param string $id XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
	*/
	public function delete($id)
	{
		try
		{
			
			$response = $this->client->request('DELETE',$id.'.json');
		
		}
		catch(ClientException $e)
		{
			//Client error "Status code : Reason phrase"
			echo $this->exceptionMessage($e);
			
		}
		catch(ConnectException $e)
		{
			echo 'Connection cannot be established.';
			
		}
		catch(ServerException $e)
		{
			//Server error "Status code : Reason phrase"
			echo $this->exceptionMessage($e);
			
		}
	}
	
	/**
	* @param string $id XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
	*
	* @return array
	*/
	public function all($id)
	{
		return $this->view($id.'/index');
	}
	
	/**
	* @return string
	*/
	public function last()
	{
		return $this->last;
	}
	
	/**
	* Helper for the exception message 
	*
	* @param GuzzleHttp\Exception\ClientException | GuzzleHttp\Exception\ClientException $exception
	*
	* @return string
	*/
	private function exceptionMessage($e)
	{
		return $e->getResponse()->getStatusCode() .' '. $e->getResponse()->getReasonPhrase();
	}
	
}