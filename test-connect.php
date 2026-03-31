<?php
require __DIR__.'/vendor/autoload.php';

use Doctrine\DBAL\DriverManager;

$connectionParams = [
    'dbname' => 'plantsobs',
    'user' => 'root',
    'password' => 'root',
    'host' => '127.0.0.1',
    'driver' => 'pdo_mysql',
];

$conn = DriverManager::getConnection($connectionParams);
$stmt = $conn->executeQuery('SELECT 1');
echo $stmt->fetchOne() . PHP_EOL;