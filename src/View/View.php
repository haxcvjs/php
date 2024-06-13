<?php

namespace Core\View;

use eftec\bladeone\BladeOne;
use Core\Tools\TempEngine\TempEngine;
use Exception;

class View
{

    public function __construct()
    {
    }

    public function fixFile($path = '')
    {
        return preg_replace("/\./", "/", $path);
    }

    public function render($file_path, $compact = [])
    {

        $views = app('path.views');
        $cache = app('path.base') . '/cache';
          
        $blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG); // MODE_DEBUG allows to pinpoint troubles.
        return $blade->run($file_path, $compact); // it calls /views/hello.blade.php

    }

    public function render2($file_path, $compact = [])
    {


        $engine = app()->make(TempEngine::class);
        $path = app('path.views') . '/' . $this->fixFile($file_path) . '.php';

        if (!file_exists($path)) {
            throw new Exception("File {$file_path} doesn't exists");
        }
        $content =  file_get_contents($path);

        $engine->setFileName($file_path)->setFilePath($path)->setData($compact)->setContent($content);
        $engine->compile();

        #$result =   file_get_contents($engine->outputFile);
        $engine->clean();


        #return $result;

    }
}
