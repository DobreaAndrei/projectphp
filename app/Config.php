<?php
namespace App;

class Config
{
    const ENV = "dev";
    const DB = [
        "driver"  => "mysql",
        'host'    => 'sandbox_db',
        'dbname'  => 'sandbox',
        'port'    => '3306',
        'charset' => 'utf8mb4',
        'user'    => 'root',
        'pass'    => 'secret'
    ];
}
