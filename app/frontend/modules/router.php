<?php
nameSpace OCFram

class Router
{
	protected $routes = [];

	const NO_ROUTE = 1;

	public function addRoute (Route $route)
	{
		if (!in_array($route, $this->routes))
		{
			$this->routes[] = $route;
		}
	}

	public function getRoute ($url)
	{
		foreach ($this->routes as $route)
		{
			//si route correspond a url
			if (($varsValues = $route->match($url)) !== false)
			{
				$varsName = $route->varsNames();
				$listVars = [];

				//on crée nouveau tab cle/valeur
				// cle = nom variable, valeur = sa valeur
				foreach ($varsValues as $key => $match)
				{
					//la 1ere valeu contient entierement la chaine capturee (voir doc preg_match)
					if ($key !== 0)
					{
						$listVars[$varsNames[$key-1]] = $match;
					}
				}
				//on assigne ce tableau de variable a la route
				$route->setVars($listVars);
			}
			return $route;
		}
		throw new \RuntimeException ('Aucune route ne correspond à l\'URL', self::NO_ROUTE);
	}
}