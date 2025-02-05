<?php

$username = 'root';
$password = '';
$dbName = 'moodofazubi';
$host = 'localhost';

try {
  $conn = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $error) {
    echo "Connection failed: " . $error->getMessage();
    exit;
}