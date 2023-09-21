<?php
namespace Classes;

Class ProductFactory {
	private $type;
	private $namespace;

	public function createProduct($type, $namespace) 
	{
		$className = "\\" . $namespace . "\\" . $type;
		return new $className();
	}
}
