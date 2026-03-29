<?php
ob_start();

function getDatabaseConnection(): ?PDO
{
    static $pdo = false;

    if ($pdo !== false) {
        return $pdo;
    }

    $host = getenv('MYSQLHOST') ?: 'mysql.railway.internal';
    $port = getenv('MYSQLPORT') ?: '3306';
    $dbName = getenv('MYSQLDATABASE') ?: 'railway';
    $username = getenv('MYSQLUSER') ?: 'root';
    $password = getenv('MYSQLPASSWORD') ?: 'qqFEpmkEnkKXjTAXFbWVPqRYBocPEeUG';

    $dsn = "mysql:host={$host};port={$port};dbname={$dbName};charset=utf8mb4";

    try {
        $pdo = new PDO(
            $dsn,
            $username,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    } catch (PDOException $exception) {
        $pdo = null;
    }

    return $pdo;
}
