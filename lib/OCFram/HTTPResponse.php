<?php
namespace OCFram;

class HTTPResponse 
{
	protected $page;

	public function addHeader ($header)
	{
		//methode permettant d'ajouter un header specifique
		header($header);
	}

	public function redirect ($location)
	{
		//methode permettant redirection utilisateur
		header('Location', $location);
		exit;
	}

	public function redirect404 ()
	{
		//methode de redirection vers erreur 404
		$this->page = new Page($this->app);
    	$this->page->setContentFile(__DIR__.'/../../Errors/404.html');
    
    	$this->addHeader('HTTP/1.0 404 Not Found');
    
    	$this->send();

	}

	public function send ()
	{
		//methode envoyant la reponse en generant la page
		exit($this->page->getGeneratedPage());
	}

	public function setCookie ($name, $value = '', $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = true)
	{
		//methode permettant d'ajouter un cookie
		setCookie($name, $value, $expire, $path;=, $domain, $secure, $httpOnly);
	}

	public function setPage ($page)
	{
		//methode assignant page a la reponse
		$this->page = $page;
	}
}