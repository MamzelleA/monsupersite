<?php
namespace OCFram;

abstract class Entity implements \ArrayAccess
{
	protected 	$erreurs = [];
				$id;

	public function __construct(array $donnees = [])
	{
		if (!empty($donnees))
		{
			$this->hydrate($donnes);
		}
	}
	public function isNew()
	{
		return empty($this->id);
	}
	public function erreurs()
	{
		return $this->erreurs;
	}
	public function id()
	{
		return $this->id;
	}
	public function setId($id)
	{
		$this->id = (int)$id;
	}
	public function hydrate(array $donnees)
	{
		foreach ($donnees as $attribut => $valeur)
		{
			$methode = 'set'.ucfirst($attribut);

			if (is_callable([$this, $methoe]))
			{
				$this->$methode($valeur);
			}
		}
	}
	public  function offsetGet($var)
	{
		if(isset($this->$var) && is_callable([$this, $var]))
		{
			return $this->$var;
		}
	}

}