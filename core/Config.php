<?php

namespace Core;

class Config
{
    private static bool $loaded = false;
    private static array $config = [];
    
    public static function get(string $key): mixed
    {
        if(static::$loaded === false)
        {
            static::$loaded = true;
            static::$config = require("app/config.php");
        }
        return isset(static::$config[$key]) ? static::$config[$key] : null;
    }
}
