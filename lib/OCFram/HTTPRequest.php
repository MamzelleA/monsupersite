<?php
namespace OCFram;

class HTTPRequest
{
	public function cookieData ($key)
	{
		//methode qui retourne valeur de telle cookie, s'il n'y a pas de cookie, retourne valeur null 
		return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
	}

	public function cookieExists ($key)
	{
		//methode qui retourne un bool si telle cookie existe ou pas
		return isset($_COOKIE[$key]);
	}

	public function getData ($key)
	{
		//methode qui retourne valeur de telle variable GET, s'il n'y a pas, retourne valeur null
		return isset($_GET[$key]) ? $_GET[$key] : null;
	}

	public function getExists ($key)
	{
		//methode qui retourne un bool si telle variable GET existe ou pas
		return isset($GET[$key]);
	}

	public function method ()
	{
		//methode qui renvoi la methode utilisee pour envoye la requête
		return $_SERVER['REQUEST_METHOD'];
	}

	public function postData ($key)
	{
		//methode qui retourne valeur de telle variable POST, s'il n'y a pas, retourne valeur null
		return isset($_POST[$key]) ? $_POST[$key] : null;
	}

	public function postExists ($key)
	{
		//methode qui retourne un bool si telle variable POST existe ou pas
		return isset($_POST[$key]);
	}

	public function requestURI ()
	{
		//methode qui renvoi l'URL entree
		return $_SERVER['REQUEST_URI'];
	}
}