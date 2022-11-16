<?php
namespace RoySandip\LaravelTcpdf;

class TemplateGenerator 
{
	protected $class;
	protected $namespace;

	public function __construct(array $namespace, string $class)
	{
		$this->class = $class;
		$this->namespace = $namespace;
	}


	public function toString()
	{
		$string 	 = "<?php \r\n";
		$string 	.= 'namespace App\\'. join('\\', $this->namespace).";\r\n\r\n\r\n";
		$string 	.= "class ".$this->class." extends \RoySandip\LaravelTcpdf\PDF\r\n{\r\n\r\n\r\n\r\n}";


		return $string;

	}


	
}