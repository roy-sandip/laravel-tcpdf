<?php
namespace RoySandip\LaravelTcpdf;

use Illuminate\Support\ServiceProvider;
use RoySandip\LaravelTcpdf\Commands\MakePDFCommand;

class TCPDFServiceProvider extends ServiceProvider
{
    public function boot()   
    {

        $this->setTcpdfConfig();

        if ($this->app->runningInConsole()) {
            $this->commands([
                MakePDFCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__.'/../config/tcpdf.php' => config_path('tcpdf.php'),
        ], 'tcpdf-config');

        $this->publishes([
             \TCPDF_FONTS::_getfontpath() => base_path('/tcpdf-fonts'),
        ], 'tcpdf-fonts');

    
    }

    public function register()
    {
        
    }


    protected function setTcpdfConfig()
    {
        if(defined('K_TCPDF_EXTERNAL_CONFIG'))
        {
            return;
        }
        define ('K_TCPDF_EXTERNAL_CONFIG', true);
        foreach(config('tcpdf', []) as $key => $value)
        {
            if(defined($key))
            {
                continue;
            }
            define($key, $value);
        }
    }


}
