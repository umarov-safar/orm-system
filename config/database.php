<?php

return [
    'host' => env('MYSQL_HOST'),
    'database' => env('MYSQL_DATABASE', 'orm'),
    'user' => env('MYSQL_USER', 'mysql'),
    'password' => env('MYSQL_PASSWORD', 'secret'),
];