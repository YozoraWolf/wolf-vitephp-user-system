<?php

// Require composer autoload plus path aliases
require_once 'vendor/autoload.php';
require_once 'config/paths.php';


// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();


// Database connection variables
$host = $_ENV['DB_HOST'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$dbname = $_ENV['DB_NAME'];
$dbtable = $_ENV['DB_TABLE'];

function checkDatabaseExists($dbname, $pdo) {
    try {
        $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$dbname]);
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result['SCHEMA_NAME'] == $dbname;
    } catch (PDOException $e) {
        echo "Connection failed: ' . {$e->getMessage()}";
        return false;
    }
}



try {
    $dsn = "mysql:host=$host";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully! <br>";
} catch (PDOException $e) {
    echo "Init Connection failed: ' . {$e->getMessage()}.";
    exit(0);
}

$userDBexists = checkDatabaseExists($dbname, $pdo);

// Check if database exists, if not create it.
if(!$userDBexists) {
    $query = "CREATE DATABASE $dbname";
    $pdo->exec($query);
    echo "Database $dbname created successfully! <br>";
} else {
    echo "Database $dbname already exists! <br>";
}

?>