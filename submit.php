<?php

//Starting a session to save the POST values in a session variable
session_start();
require_once 'db.php';

// Get form data
$azubiID = $_POST['azubi-name'];
$stimmung = $_POST['Feeling'];
$energie = $_POST['Energy'];

$table = 'daily_moods';

// Get the current date
$currentDate = date('Y-m-d');


// Check if there is already an entry for the current date
$sqlCheck = "SELECT COUNT(*) FROM $table WHERE Datum = :currentDate AND Azubi_ID = :azubiID";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bindParam(':currentDate', $currentDate);
$stmtCheck->bindParam(':azubiID', $azubiID);
$stmtCheck->execute();
$existingCount = $stmtCheck->fetchColumn();


if ($existingCount > 0) { 
      //Store the values in a session variable so they can be "transfered" over to the overwrite page
      $_SESSION['overwrite_data'] = array(
        'azubi-name' => $_POST['azubi-name'],
        'Feeling' => $_POST['Feeling'],
        'Energy' => $_POST['Energy']
    );
    //Redirect to overwrite.php
    header("Location: overwrite.php");
    exit(); 
}else{   
    //If no existing entry, insert a new record
    $sql = "INSERT INTO $table (Azubi_ID, Mood, Energy, Datum) VALUES (:azubiID, :stimmung, :energie, :date)";
    $stmt = $conn->prepare($sql);

    //Binding parameters
    $stmt->bindParam(':azubiID', $azubiID);
    $stmt->bindParam(':date', $currentDate);
    $stmt->bindParam(':stimmung', $stimmung, PDO::PARAM_INT);
    $stmt->bindParam(':energie', $energie, PDO::PARAM_INT);

    // Executing the statement
    try {
        if($stmt->execute()) {
            header("Location: index.php?success=1"); // Redirect to index.html
            exit; // Stop further execution
        } else {
            echo "Error: Unable to insert record.";
        }    
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
}

// Closing the connection
$conn = null;
?>