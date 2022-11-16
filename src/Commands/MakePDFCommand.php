<?php
namespace RoySandip\LaravelTcpdf\Commands;

use Illuminate\Console\Command;
use File;
use RoySandip\LaravelTcpdf\TemplateGenerator;

class MakePDFCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:pdf {pdf} {--f|force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new pdf template.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        

        $pdf = $this->argument('pdf');
        $force = $this->option('force');

        if(strlen($pdf) < 3)
        {
            $this->error("PDF should be at least 3 character long.");
        }

        $folders = explode('.', $pdf);
        if(count($folders) < 2)
        {
            array_unshift($folders, 'PDF');
        }
        $className = ucwords(array_pop($folders));
        $namespace = [];
        foreach($folders as $dir)
        {
            $namespace[] = ucwords($dir);
        }




        $path = app_path(join('/', $namespace).'/'.$className.'.php');
        $this->createDir($path);
         

        if (!$force && File::exists($path))
        {
            $this->error("PDF {$className} already exists!");
            return;
        }
        $class = new TemplateGenerator($namespace, $className);
        File::put($path, $class->toString());
        $this->info("PDF {$path} created.");



    }

     /**
     * Get the views.
     *
     * @param string $view
     *
     * @return string
     */
    public function views($view, $resource = false)
    {
        if($resource)
        {
            $dir = str_replace('.', '/', $view);
            return [
                $dir.'/'.'index.blade.php',
                $dir.'/'.'create.blade.php',
                $dir.'/'.'edit.blade.php',
                $dir.'/'.'show.blade.php',
            ];
        }

        return [str_replace('.', '/', $view) . '.blade.php'];
    }



    private function getViewPath()
    {
        $paths = app('view.finder')->getPaths();
    
        if (count($paths) === 1) {
            return head($paths);
        }

        return $this->choice('Where do you want to create the view(s)?', $paths, head($paths));
    }

    /**
     * Get Template
     * */
    private function getTemplate($template)
    {
        if(empty($template))
        {
            return;
        }
        $template = $this->views($template);
        $path = $this->getViewPath().'/'. $template[0];

        if(!File::exists($path))
        {
            $this->error("Template does not exist!");
            exit;
        }
        return File::get($path);
    }

    /**
     * Create view directory if not exists.
     *
     * @param $path
     */
    public function createDir($path)
    {
        $dir = dirname($path);

        if (!file_exists($dir))
        {
            mkdir($dir, 0777, true);
        }
    }

}