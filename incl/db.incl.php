<?php

// Load path aliases
require_once __DIR__.'/../config/paths.php';


// Database connection variables


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

function checkTableExists($dbtable, $pdo) {
    try {
        $query = "SELECT * FROM $dbtable";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

function createTable($dbtable, $pdo) {
    try {
        $query = "CREATE TABLE $dbtable (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(30) NOT NULL,
            email VARCHAR(50) NOT NULL,
            password VARCHAR(255) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $pdo->exec($query);
        //echo "Table $dbtable created successfully! <br>";
    } catch (PDOException $e) {
        echo "Table creation failed: ' . {$e->getMessage()}";
        exit(0);
    }

}

$pdo = null;
$host = "127.0.0.1"; 
$username = "root";
$password = "wolf123";
$dbname = "wbase";
$dbtable = "wusers";

function init_pdo() {
    global $pdo, $host, $username, $password, $dbname;
    try {

        $dsn = "mysql:host=$host;dbname=$dbname";
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully! <br>";
    } catch (PDOException $e) {
        echo "Init Connection failed: ' . {$e->getMessage()}.";
        exit(0);
    }
}


// Call init_pdo() to initialize the $pdo variable
init_pdo();

if ($pdo === null) {
    echo "Failed to initialize PDO.";
    exit(0);
}

$userDBexists = checkDatabaseExists($dbname, $pdo);

// Check if database exists, if not create it.
if(!$userDBexists) {
    $query = "CREATE DATABASE $dbname";
    $pdo->exec($query);
    //echo "Database $dbname created successfully! <br>";
} else {
    //var_dump("Database $dbname already exists! <br>");
}

?>
