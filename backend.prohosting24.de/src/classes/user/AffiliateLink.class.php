<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class AffiliateLink extends BaseDatabase
{

	public function __construct($dependencyInjector, $value, $key = "id")
	{
		parent::__construct("affiliate_link", $dependencyInjector, $value, $key);
	}

	public function checkLink()
	{
		$this->setValue("link", str_replace(' ', '', $this->getValue("link")));
		$allByValue = $this->getAll(["link" => $this->getValue("link")]);
		if (count($allByValue) != 0) {
			$this->dependencyInjector->getResponse()->fail(200, MainConstants::affiliate_linkexists);
		}
		$allByUser = $this->getAll(["userid" => $this->getValue("userid")]);
		if (count($allByUser) >= MainConstants::affiliate_maxlinks) {
			$this->dependencyInjector->getResponse()->fail(200, MainConstants::affiliate_maxLimitReached);
		}
		$blacklist = $this->dependencyInjector->getConfig()->getconfigvalue("affiliate_blacklist");
		foreach ($blacklist as $entry) {
			
			if (strpos($this->getValue("link"), $entry) !== false) {
				$this->dependencyInjector->getResponse()->fail(200, MainConstants::affiliate_blacklistword);
			}
		}
		if(strlen($this->getValue("link")) > MainConstants::affiliate_maxChars){
			$this->dependencyInjector->getResponse()->fail(200, MainConstants::affiliate_maxCharsMessage);
		}
		if(strlen($this->getValue("link")) < MainConstants::affiliate_minChars){
			$this->dependencyInjector->getResponse()->fail(200, MainConstants::affiliate_minCharsMessage);
		}
	}

	public function getLinkCount()
	{
		$tmpCount = new AffiliateClick($this->dependencyInjector, null, null);
		return count($tmpCount->getAll(["linkid" => $this->getValue("id")]));
	}


}
