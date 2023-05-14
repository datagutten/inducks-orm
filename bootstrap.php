<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

function InducksORMBootstrap(): EntityManager
{
    $config = ORMSetup::createAttributeMetadataConfiguration(
        paths: array(__DIR__ . "/models"),
        isDevMode: true,
    );

// configuring the database connection
    $config_db = require __DIR__ . '/config_db.php';
    $connection = DriverManager::getConnection([
        'driver' => 'pdo_mysql',
        'user' => $config_db['db_user'],
        'password' => $config_db['db_password'],
        'dbname' => $config_db['db_name'],
        'host' => $config_db['db_host'],
        'charset' => 'utf8',
    ], $config);
    $connection->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
// obtaining the entity manager
    return new EntityManager($connection, $config);

}