<?php
namespace Service\Admin\Storages;

use Doctrine\DBAL\DriverManager;

class UserStorage
{
    private $database;
    
    public function __construct()
    {
        $conf = [
            'dbname' => getenv('MYSQL_DATABASE'),
            'user' => getenv('MYSQL_USER'),
            'port' => getenv('MYSQL_PORT'),
            'password' => getenv('MYSQL_PASSWORD'),
            'host' => getenv('MYSQL_HOSTNAME'),
            'driver' => 'pdo_mysql',
        ];

        $this->database = DriverManager::getConnection($conf);
    }

    public function getUser()
    {
        return [
            'name' => 'name',
            'email' => 'email',
        ];
    }
}