<?php

namespace Core\Container;

use Closure;
use Core\App\Application;
use Exception;
use ReflectionFunction;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;

class Container {
    
    public $bindings = [];

    public static $instance;
    
    public $singletons = [];

    protected $abstractAliases = [];

    protected $aliases = [];

    protected $instances = [];

      
    public function get($id,  $concrate = null) {
        
        if( $this->isSingleton($id)) {
            return $this->singletons[$id];
        }
        
        if($this->has($id)) {
            return $this->bindings[$id];
        }
        

        if($concrate instanceof Closure) {
            $instance =  $this->resolveMethod($concrate);
        } else {
            $instance =  $this->resolve($id);
        }
        
        return $this->bindings[$id] = $instance;
    }
    
    public function has($id) {
       
       return isset( $this->bindings[$id] );
    }
    
    public function isSingleton($id) {
       
       return isset( $this->singletons[$id] );
    }
    
    public function singleton($id, callable $concrate = null) {

        if( $this->isSingleton($id)) {
            return $this->singletons[$id];
        }

        if($concrate instanceof Closure) {
            $instance =  $this->resolveMethod($concrate);
        } else {
            $instance =  $this->resolve($id);
        }

        return $this->singletons[$id] = $instance;
    }
    
    public function bind($id,  $concrate): void {

        $this->bindings[$id] = $concrate;
    }
    
    public function make($id, $concrate = null) {
         
        if($concrate instanceof Closure) {
            $instance =  $this->resolveMethod($concrate);
        } else {
            $instance =  $this->resolve($id);
        }

        return $this->bindings[$id] = $instance;

         
    }

    public function resolve_function($id)
    {
        $ReflectionFunction = new ReflectionFunction($id);

            $parameters = $ReflectionFunction->getParameters();
        
            if(!$parameters) {
                return;
            }
        
            $dependecies = array_map( function ( ReflectionParameter $param) use ($id) {

                $ReflectionType = $param->gettype();

                $ReflectionName = $param->getName();
    
                
    
                if( ! $ReflectionType) {
    
                    throw new Exception(" type is missing for {$ReflectionName} for class {$id}");
                }
    
                if( $ReflectionType instanceof ReflectionUnionType ) {
    
                    throw new Exception(" type is ReflectionUnionType for {$ReflectionName} for class {$id}");
                }
                
                if( $ReflectionType instanceof ReflectionNamedType && !$ReflectionType->isBuiltin() ) {
    
                    return $this->get($ReflectionType->getName());
                }
    
                throw new Exception(" type is ReflectionUnionType for {$ReflectionName} for class {$id}");
    
            } , $parameters);
             
        return is_array($dependecies) ? $dependecies : [];
    }
    
    public function resolveMethod($id) {

        

        $argv = self::resolve_function($id);
        return ( new ReflectionFunction($id) )->invokeArgs( $argv ?? [] );
        
    }

    public function resolve($id) {

        if(!class_exists($id)) {

            if($this->has($id)) {
                return $this->get($id);
            }

            throw new Exception(" $id contianer doest't exists ");
        }

        $ReflectionClass = new \ReflectionClass($id);

        if( ! $ReflectionClass->isInstantiable()) {

            throw new Exception(" $id is not instantsable ");
        }

        $constructor = $ReflectionClass->getConstructor();

        if( !$constructor ) {
            return new $id;
        }

        $parameters = $constructor->getParameters();

        if( !$parameters ) {
            return new $id;
        }

        $dependecies = array_map( function ( ReflectionParameter $param) use ($id) {

            $type = $param->gettype();
            $name = $param->getName();

            

            if( ! $type) {

                throw new Exception(" type is missing for {$name} for class {$id}");
            }

            if( $type instanceof ReflectionUnionType ) {

                throw new Exception(" type is ReflectionUnionType for {$name} for class {$id}");
            }
            
            if( $type instanceof ReflectionNamedType && !$type->isBuiltin() ) {

                return $this->get($type->getName());
            }

            throw new Exception(" type is ReflectionUnionType for {$name} for class {$id}");

        } , $parameters);
        
        
        return $ReflectionClass->newInstanceArgs($dependecies);


    }

    public function instance($abstract, $instance)
    {
        $this->bind($abstract , $instance);
      
        return $instance;
    }


    /**
     * Get the globally available instance of the container.
     *
     * @return static
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    /**
     * Set the shared instance of the container.
     *
     * @param  \Illuminate\Contracts\Container\Container|null  $container
     * @return \Illuminate\Contracts\Container\Container|static
     */
    public static function setInstance(Container $app = null)
    {
        return static::$instance = $app;
    }

    /**
     * Dynamically access container services.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
         
    }

    /**
     * Dynamically set container services.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function __set($key, $value)
    {
        #$this[$key] = $value;
    }

}