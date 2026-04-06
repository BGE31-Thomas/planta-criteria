<?php
require __DIR__.'/vendor/autoload.php';

use Doctrine\DBAL\DriverManager;

$connectionParams = [
    'dbname' => 'plantobs',
    'user' => 'plantthom',
    'password' => 'root',
    'host' => '127.0.0.1',
    'port' => 5432,
    'driver' => 'pdo_pgsql',
    'serverVersion' => '15', // adapte à ta version
];

$conn = DriverManager::getConnection($connectionParams);
$stmt = $conn->executeQuery('SELECT 1');
echo $stmt->fetchOne() . PHP_EOL;