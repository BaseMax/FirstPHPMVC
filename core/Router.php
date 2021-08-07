<?php

namespace Core;

use Core\Config;

class Router
{
    private static array $routes = [];
    private static array $serve = [];

    public static function addRoute(string $uri, array $controllerAction): void
    {
        static::$routes[$uri] = $controllerAction;
    }

    private static function uriValidation(string $routerUri, string $requestUri): bool
    {
        // TODO: regex match to handle all of the params!
        return $routerUri === $requestUri;
    }

    public static function dispatch(string $requestUri): bool
    {
        // print_r(static::$routes);

        if(static::$serve === [])
        {
            static::$serve = Config::get('SERVE_DIRS');
        }

        foreach(static::$routes as $path=>$route)
        {
            if(static::uriValidation($path, $requestUri) === true)
            {
                $class = $route[0];
                $call = $route[1];

                $instance = new $class();
                $instance->$call();
                return true;
            }
        }

        if(static::$serve !== null)
        {
            foreach(static::$serve as $dir)
            {
                if(str_starts_with($requestUri, "/" . $dir. "/") === true)
                {
                    return false;
                    // $fileUri = substr($requestUri, 1);
                    // if(file_exists($fileUri) === true)
                    // {
                    //     if(is_file($fileUri) === true)
                    //     {
                    //         print file_get_contents($fileUri);
                    //         return true;
                    //     }
                    //     else
                    //     {
                    //         print 'Directory index!'; // TODO
                    //         return true;
                    //     }
                    // }
                    // continue;
                }
            }
        }

        http_response_code(404);
        // print '404 Error page!';
        return true;
    }
}
