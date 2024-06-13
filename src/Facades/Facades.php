<?php 

namespace Core\Facades;

use Exception;
use ReflectionFunction;
use RuntimeException;

abstract class Facades {

    private static $instance;

    /**
     * The resolved object instances.
     *
     * @var array
     */
    protected static array $instances;
    protected static array $resolvedInstance;

    public function __construct() {
        
    }
    
    public static function getInstance() {
        
        throw new Exception(" Not instance");
    }
    
    public static function registerFacade($name) {
        
        static::$instances[$name] = $name;
    }
    
    public static function loadFacades() {
        
        foreach (static::$instances as $instance => $value) {
            # code...
        }
        
    }

    public static function resolveFacade() {
        
        if( isset(static::$resolvedInstance[static::class])) {
            return  static::$resolvedInstance[static::class];
        }

        if( isset(static::$instances[static::class])) {
            $instance  = app()->get( static::getInstance() );
            static::$resolvedInstance[static::class] = $instance;
            return $instance;
        }
    }


    public static function __callStatic($method, $args)
    {
          
         
         //$instance = static::getInstance();
         $instance = static::resolveFacade();
         
         if (! $instance) {
            throw new RuntimeException('A facade root has not been set.');
        }
         
        
        

        return $instance->$method(...$args);

        /* 

        if( class_exists($instance)) {
            $classname = app()->get($instance);
            if(method_exists($classname, $name)) {
                return $classname->$name(...$arguments);
            }
        } */
    }
}

?>