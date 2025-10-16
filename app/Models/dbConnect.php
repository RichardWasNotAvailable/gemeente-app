<?php

$host = 'localhost';
$dbname = 'gemeente_klachten_db';
$username = 'dbUser';
$password = 'SterkWachtwoord123!';

$pdo = null;

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    throw new Exception("Connection failed: " . $e->getMessage());
}

?>