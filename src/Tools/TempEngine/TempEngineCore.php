<?php

namespace Core\Tools\TempEngine;


abstract class TempEngineCore
{

    protected $cache_path = __DIR__ . '/cache';

    protected $tmp_path = __DIR__ . '/temp';

    protected $file_path = '';

    protected $filename = '';

    protected $key;

    protected $execfilename;

    protected $cachefilename;

    protected $validateFile;

    protected $compact;

    protected $content;

    public $output = '';

    public $outputFile = '';

    protected $source = '';

    protected $symbols = [
        '/0xat/' => '@',
        '/0x2brackets/' => '{{'
    ];

    protected $regExps = [
        /* 
        * itrators statments
        */

        'skipSymbols' => [
            "/#@|!##@/" => "0xat", //skip @ foreach|while|if|else|elseif|else if 
            "/#{{|!##{{/" => "0x2brackets", //skip {{ brackets }} 
        ],
        'itrators' => [
            "/@(foreach\s+|\(|while\s+|\(|for\s+|\(|if\s+|\(|elseif\s+|\(|else if\s+|\()(.*)\)/" => "<?php $1$2): ?>", //open  statements
            "/@(foreach|while|for|if|elseif|else if)(.*)\)/" => "<?php $1$2): ?>", //open  statements
            "/@(else)/" => "<?php $1$2: ?>", //open  statements
            "/@(endforeach|endif|endfor|endwhile)/" => "<?php $1 ?>", // close statements
        ],
        'printers' => [
            "/{{(.*?)}}/" => "<?= $1 ?>", //open  statements
            "/@(endforeach|endif|endfor|endwhile)/" => "<?php $1 ?>", // close statements
        ],
        'modules' => [
            "/@import(.*?)(\);|\))/" => "<?php view$1$2 ?>", // render & compile module
            "/@layout(.*?)(\);|\))/" => "<?php view$1$2 ?>", // render & compile module
        ]
    ];

    public function write()
    {

        $this->execfilename      =  $this->tmp_path . '/' . 't' . '.' . $this->key . $this->filename . '.php';
        $this->validateFile      =  $this->tmp_path . '/validate' . 't' . '.' . $this->key . $this->filename . '.php';
        
        $this->cachefilename =  $this->cache_path . '/' . 't' . '.' . $this->key . $this->filename . '.php';

       



        if (!file_exists($this->cachefilename)) {
            file_put_contents($this->cachefilename, $this->getContent());
        }



        file_put_contents($this->execfilename, $this->getContent());

        file_put_contents($this->validateFile, $this->source . " \n <?php ?>");



        return $this;
    }

    public function getExeCode()
    {
        return file_get_contents(__DIR__ . '/function.php');
    }

    public function setFileContent()
    {
        $this->setContent(file_get_contents($this->file_path));
    }



    public function setKey($key = '')
    {
        $this->key = $key;
        return $this;
    }

    public function setFilePath($path = '')
    {
        $this->file_path = $path;
        return $this;
    }

    public function setFileName($filename = '')
    {
        $this->filename = $filename;
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function setData($content = [])
    {
        $this->compact = $content;
        return $this;
    }

    public function getData()
    {
        return $this->compact;
    }

    public function Replace($key = '')
    {
        foreach ($this->regExps[$key] as $Regx => $replacment) {
            $this->output = preg_replace($Regx, $replacment, $this->output);
        }
        return $this;
    }

    public function build()
    {


        $c = $this->getContent();

        foreach ($this->regExps as $gate) {
            foreach ($gate as $Regx => $replacment) {
                $c = preg_replace($Regx, $replacment, $c);
            }
        }

        foreach ($this->symbols as $symbol => $replacment) {
            $c = preg_replace($symbol, $replacment, $c);
        }

        $parmeter  = str_shuffle('ABCDEFG') . rand();
        $$parmeter = $this->getData();

        $func = $this->getExeCode();

        $content = preg_replace("/var/", $parmeter, $func);
        $content = preg_replace("/{{code}}/", $c, $content);





        $this->output = $content;
        $this->source = $c;
        $this->setContent($content);
        return $this;
    }

    public function import()
    {
        if (file_exists($this->cachefilename) && false) {
            $result =  (require_once ($this->cachefilename))($this->getData());
        } else {
            $result =  (require_once ($this->execfilename))($this->getData());
        }
        
        
        /* $this->outputFile      =  $this->tmp_path . '/output.' . 't' . '.' . $this->key . $this->filename . '.php';
        file_put_contents($this->outputFile,   ob_get_contents()); */

          
        


        return $result;
    }

    public function compile()
    {
        if (!$this->getContent()) {
            $this->setFileContent();
        }




        $this->build()->write()->import();




        return $this;
    }

    public function clean()
    {

        if (file_exists($this->execfilename)) {
            unlink($this->execfilename);
        }
        if (file_exists($this->validateFile)) {
            unlink($this->validateFile);
        }
        if (file_exists($this->outputFile)) {
           # unlink($this->outputFile);
        }
        if (file_exists($this->cachefilename)) {
           unlink($this->cachefilename);
        }

        
    }

    public function flush()
    {
        $this->clean();
        $this->file_path =   null;
        $this->filename =   null;
        $this->execfilename = null;
        $this->cachefilename = null;
        $this->validateFile = null;
        $this->outputFile = null;
        $this->compact = null;
        $this->content = null;
        $this->output =   null;
        $this->source =   null;
    }
}
