<?php

namespace Core\Router;

use Core\App\Application;
use Exception as ContainerException;
use ReflectionFunction;
use ReflectionMethod;


class RouterHelper
{

    

    public static function resolved(string $abstract)
    {
        $instances = app()->bindings;
        if(in_array( $abstract , $instances )) {
            return $instances[ $abstract ];
        }

        return app()->get($abstract);
    }


    public static function invokeClass(string $instance, string $method, array $argv)
    {

        $argv = self::resolve( $instance, $method , $argv );
         
         $class_name = self::resolved($instance);

        return ( 
            new ReflectionMethod($instance, $method) 
        )
        ->invokeArgs( 
            $class_name,
            $argv
        );
    }
    
    public static function invokeMethod(callable $method, array $argv)
    {

       

         
        $argv = self::resolve_function($method , $argv);

        return ( new ReflectionFunction($method) )->invokeArgs( $argv );
    }


    public static function resolve(string $id, $method, $method_params)
    {
        // 1. Inspect the class that we are trying to get from the container
        $reflectionClass = new \ReflectionClass($id);
        
        if (!method_exists($reflectionClass->name, $method)) {
            throw new ContainerException(
                'method not found "' . $id . '" because param "' . $method . '" is missing a type hint'
            );
        }

        $reflectionMethod = new ReflectionMethod($reflectionClass->name, $method);



        // 3. Inspect the constructor parameters (dependencies)
        $parameters = $reflectionMethod->getParameters();



        // 4. If the constructor parameter is a class then try to resolve that class using the container
        $dependencies = array_map(
            function (\ReflectionParameter $param) use ($method_params) {
                $abstract = $param->getType();

                if ( $abstract ) {                 
                    return  self::resolved($abstract);
                }
            },
            $parameters
        );

        foreach ($dependencies as $key => $value) {
            if (!$value) {
                unset($dependencies[$key]);
            }
        }

        return array_merge($method_params, $dependencies);
    }



    public static function resolve_function($id, $method_params)
    {
        $ReflectionFunction = new ReflectionFunction($id);

        $dependencies = [];

        foreach ($ReflectionFunction->getParameters() as $param) {
            
            $abstract = $param->getType();

            if (class_exists($abstract)) {
                if ( $abstract ) {                 
                    $dependencies[] =  self::resolved($abstract);
                }
            }
        }

        



        foreach ($dependencies as $key => $value) {
            if (!$value) {
                unset($dependencies[$key]);
            }
        }


        return array_merge($method_params, $dependencies);
    }
}
