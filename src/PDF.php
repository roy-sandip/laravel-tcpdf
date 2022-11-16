<?php
namespace RoySandip\LaravelTcpdf;
use \TCPDF;
use RoySandip\LaravelTcpdf\Traits\Helper;

class PDF extends TCPDF
{
    use Helper;


    protected $customHeader = null;
    protected $customFooter = null;
    

	public function __construct($orientation= PDF_PAGE_ORIENTATION, $unit='mm', $format='A4', $unicode=true, $encoding='UTF-8', $diskcache=false, $pdfa=false)
	{
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
	}

 
    public static function template($invoice)
    {
        return new $invoice;
    }
	
}
