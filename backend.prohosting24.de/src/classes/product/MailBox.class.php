<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class MailBox extends Base
{
	private MailCowClient $client;

	public function __construct($dependencyInjector)
	{
		parent::__construct($dependencyInjector);
		$this->client = new MailCowClient($this->dependencyInjector->getConfig()->getconfigvalue("mailcow_key"),$this->dependencyInjector->getConfig()->getconfigvalue("mailcow_endpoint"));
	}

	public function create($domain, $username, $password, $name)
	{
		$this->createDomain($domain);

		return $this->createMailbox($domain, $username, $password, $name);
	}

	public function createMailbox($domain, $username, $password, $name)
	{
		$checkCount = count($this->client->getMailBoxTLD($domain));
		if($checkCount >= $this->dependencyInjector->getConfig()->getconfigvalue("mailcow_maxMailBoxCount")){
			return "MailBox Limit erreicht.";
		}

		$check = $this->client->getMailBox($domain, $username);
		if(count($check) == 0){
			return $this->client->createMailbox($domain, $username, $password, $name);
		}
		return [];
	}

	public function getByTLD($domain)
	{
		return $this->client->getMailBoxTLD($domain);
	}

	public function getDKIM($domain)
	{
		$this->createDomain($domain);
		$check = $this->client->getDKIM($domain);
		if(count($check) == 0){
			$this->client->createDKMI($domain);
			return $this->client->getDKIM($domain);
		}
		return $check;
	}

	public function createDomain($domain)
	{
		$check = $this->client->getDomain($domain);
		if(count($check) == 0){
			$return = $this->client->createDomain($domain, $domain, $this->dependencyInjector->getConfig()->getconfigvalue("mailcow_maxDomainStorage"));
			$this->client->createDKMI($domain);
			return $return;
		}
		return [];
	}

	public function delete($username, $domain)
	{
		$this->client->deleteMailBox($username . "@" . $domain);
		$mailBoxCount = count($this->getByTLD($domain));
		if($mailBoxCount == 0){
			return $this->deleteDomain($domain);
		}
		return [];
	}

	public function deleteDomain($domain)
	{
		return $this->client->deleteDomain($domain);
	}

	public function edit($domain, $username, $password)
	{
		return $this->client->editMailBox($domain, $username, $password);
	}
}
