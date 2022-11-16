<?php
namespace RoySandip\LaravelTcpdf\Traits;


trait Helper
{


    public function view($view, array $data = [])
    {
        $html = view($view)->with($data)->render();  
        $this->writeHTML($html, true, false, true, false, '');
        return $this;
    }




    public function download($filename = null)
    {
        $filename = $this->generateFileName($filename);
        return $this->Output($filename, 'D');
    }
    
    public function stream($filename = null)
    {
        return $this->Output($this->generateFileName($filename), 'I');
    }

    public function generateFileName($string = null)
    {
        $string = $string ?? \Str::uuid();
        return $string.'.pdf';
    }

    public function Header()
    {
        if(is_callable($this->customHeader))
        {
            return call_user_func($this->customHeader, $this);
        }
      parent::Header();
    }
    
    public function Footer()
    {
        if(is_callable($this->customFooter))
        {
            return call_user_func($this->customHeader, $this);
        }
      parent::Footer();
    }

    public function setCustomHeader(callable $callback)
    {
        $this->customHeader = $callback;
    }
    
    public function setCustomFooter(callable $callback)
    {
        $this->customFooter = $callback;
    }

}