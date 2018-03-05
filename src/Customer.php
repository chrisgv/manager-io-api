<?php

namespace ManagerIO;

class Customer {
	private $name;							//string
	private $billingAddress; 				//string
	private $email;							//string(email)
	private $businessIdentifier; 			//string
	private $code; 							//string
	private $inactive = false; 				//boolean
	private $creditLimit; 					//float
	private $hasStartingBalance; 			//boolean
	private $startingBalanceType = 'Credit';//string
	
	//Constructors parameter keys are CASE-SENSITIVE
	public function __construct($data = []) {
		foreach($data as $key => $val) {
			//Prepend "set" to the array key to match setter method
			$method = 'set' . $key;
			if(method_exists($this,$method)) {
				//Set property if a setter method is found
				$this->{$method}($val);
			}
		}
	}
	
	public function json() {
		$properties = get_object_vars($this);
		foreach($properties as $property => $value) {
			if(isset($properties[$property])) {
				$properties[ucfirst($property)] = $value;
			}
			unset($properties[$property]);
		}
		return json_encode($properties);
	}
	
	//Setter and Getter Methods
	
	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getBillingAddress(){
		return $this->billingAddress;
	}

	public function setBillingAddress($billingAddress){
		$this->billingAddress = $billingAddress;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getBusinessIdentifier(){
		return $this->businessIdentifier;
	}

	public function setBusinessIdentifier($businessIdentifier){
		$this->businessIdentifier = $businessIdentifier;
	}

	public function getCode(){
		return $this->code;
	}

	public function setCode($code){
		$this->code = $code;
	}

	public function getInactive(){
		return $this->inactive;
	}

	public function setInactive($inactive){
		$this->inactive = $inactive;
	}

	public function getCreditLimit(){
		return $this->creditLimit;
	}

	public function setCreditLimit($creditLimit){
		$this->creditLimit = $creditLimit;
	}

	public function getHasStartingBalance(){
		return $this->hasStartingBalance;
	}

	public function setHasStartingBalance($hasStartingBalance){
		$this->hasStartingBalance = $hasStartingBalance;
	}

	public function getStartingBalanceType(){
		return $this->startingBalanceType;
	}

	public function setStartingBalanceType($startingBalanceType){
		$this->startingBalanceType = $startingBalanceType;
	}
}