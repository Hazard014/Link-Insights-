<?php
// Typically 'localhost' on cPanel-based hosting, unless your host specifies otherwise
$host = 'localhost';                 

// Your actual database name
$db   = 'u394421866_link_tracker';   

// The MySQL user you created/assigned to the database
$user = 'u394421866_link_tracker';         

// The password you set for that user
$pass = 'Thecrazeenterprise#007';    

$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
     throw new PDOException($e->getMessage(), (int)$e->getCode());
}
?>
