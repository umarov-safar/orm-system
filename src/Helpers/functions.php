<?php

if (!function_exists('env')) {

    function env(string $key, mixed $default = null): mixed
    {
        return $_ENV[$key] ?? $default;
    }

}

// Get value from config files
if (!function_exists('config')) {

    function config(string $key): mixed
    {
        return \Orm\Entity\Helpers\Config::get($key);
    }

}
