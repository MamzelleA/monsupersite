<?php
nameSpace OCFram

abstract class Application 
{
	protected $httpRequest;
	protected $httpResponse;
	protected $name;

	public function __construct ()
	{
		$this->httpRequest = new HTTPRequest;
		$this->httpResponse = new HTTPResponse;
		$this->name = '';
	}

	public function getController ()
	{
		$router = new Router;
		$xml = new \DOMDocument;
		$xml->load(__DIR__.'/../../App'.$this->name.'/Config/routes.xml');
		$routes = $xml->getElementByTagName('route');
		//on parcourt les routes du fichier xml
		foreach ($routes as $route)
		{
			$vars = [];
			//on regarde si des variables sont présentes dans l'URL
			if ($route->hasAttribute('vars'))
			{
				$vars = explode(',', $route->getAttribute('vars'));
			}
			//on ajoute la route au routeur
			$router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
		}
		try
		{
			//on recupere la correspondante a l'URL
			$matchedRoute = $router->getRoute($this->HTTPRequest->requestURI());
		}
		catch (\RuntimeException $e)
		{
			if ($e->getCode() === ROUTER::NO_ROUTE)
			{
				//si aucune route ne correspond c'est que page demandee n'existe pas
				$this->HTTPRespons->redirect404(); 
			}
		}
		//on ajoute less variables de l'URL au tableau $_GET
		$_GET = array_merge($_GET, $matchedRoute->vars());
		//on instancie le controller
		$controllerClass = 'App\\'.$this->name.'\\Modules\\'.$matchedRoute->module().'\\'.$matchedRoute->module().'Controller';
		return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());
	}

	abstract public function run ()

	public function httpRequest ()
	{
		return $this->httpRequest; 
	}

	public function httpResponse ()
	{
		return $this->httpResponse;
	}

	public function name ()
	{
		return $this->name;
	}
}