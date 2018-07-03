<?php
namespace App\frontend;

use \OCFram\Application;

class frontendApplication extends Application
{
	public function __construct()
	{
		parent::__construct();
		$this->name = 'Frontend';
	}

	public function run()
	{
		$controller = $this->getcontroller();
		$controller->execute();
		$this->httpResponse->setPage($controller->page());
	}

}