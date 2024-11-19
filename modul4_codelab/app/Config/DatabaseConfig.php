<?php

namespace app\Config;

class DatabaseConfig
{
    // Setting database
    public $host = "localhost";
    public $user = "root";
    public $password = "pwdpwd8";
    public $databaseName = "prak-web-4-db";
    public $port = 3306;

    public function __construct()
    {
        // Optional constructor if you want to initialize something
    }
}