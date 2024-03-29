<?php
namespace RoySandip\LaravelTcpdf;
use \TCPDF;
use RoySandip\LaravelTcpdf\Traits\Helper;

class PDF extends TCPDF
{
    use Helper;


    protected $customHeader = null;
    protected $customFooter = null;

    protected $__data = [];

    protected $html_data = '';
    

	public function __construct($orientation= PDF_PAGE_ORIENTATION, $unit='mm', $format='A4', $unicode=true, $encoding='UTF-8', $diskcache=false, $pdfa=false)
	{
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
	}
	
	public function toHTML($print = false)
    {
		if($print)
        {
            $this->html_data .= '<script>window.addEventListener("load", window.print());</script>';
        }
        return  $this->html_data;
    }
 
    public static function template($invoice)
    {
        return new $invoice;
    }


    public function with(array $data)
    {
        foreach($data as $key => $value)
        {
            $this->__data[$key] = $value;
        }
        
        return $this;
    }
	
}
