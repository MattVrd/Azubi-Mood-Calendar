<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mood of Azubi</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php

    session_start();
    if (!isset($_SESSION['overwrite_data'])) {
        echo "No data to overwrite.";
        exit;
    }
    require_once 'db.php';
    
    $table = 'daily_moods';
    $currentDate = date('Y-m-d');

    // Check if the overwrite data is set in the session
    if (isset($_SESSION['overwrite_data'])) {
        // Get the overwrite data from the session
        $overwrite_data = $_SESSION['overwrite_data'];

        ?>
        <!--Create the form with the overwrite data-->
        <form action='overwrite.php' method='post'>
            <div class="centered-div">
            <h3>Ein Eintrag für das heutige Datum existiert bereits. Möchten Sie ihn überschreiben?</h3>
            <input type='hidden' name='azubi-name' value='<?php echo $overwrite_data['azubi-name']; ?>'/>
            <input type='hidden' name='Feeling' value='<?php echo $overwrite_data['Feeling']; ?>'/>
            <input type='hidden' name='Energy' value='<?php echo $overwrite_data['Energy']; ?>'/>
            <input type='hidden' name='overwrite' value='Ja, überschreiben' />
            <input type='submit' name='overwrite' value='Ja, überschreiben' class="button-container" />
            <a href='index.php'>Nein, zurück zur Eingabe</a>
            </div>
        </form>
        <?php

    }else{
        //In case the overwrite data is not set
        echo "Fehler. Bitter veruchen Sie es nochmal.";
    }
    
    // Check if the overwrite button was clicked
    if (isset($_POST['overwrite']) && $_POST['overwrite'] == 'Ja, überschreiben') {   
        //Update the values with the ones from the second form submission 
        $azubiID = $_POST['azubi-name'];
        $stimmung = $_POST['Feeling'];
        $energie = $_POST['Energy'];    

        //Prepare the UPDATE query
        $sql = "UPDATE $table SET Mood = :stimmung, Energy = :energie WHERE Datum = :currentDate AND Azubi_ID = :azubiID";
        $stmt = $conn->prepare($sql);

        //Binding parameters
        $stmt->bindParam(':azubiID', $azubiID);
        $stmt->bindParam(':currentDate', $currentDate);
        $stmt->bindParam(':stimmung', $stimmung, PDO::PARAM_INT);
        $stmt->bindParam(':energie', $energie, PDO::PARAM_INT);

        //Executing the statement
        try {
            if($stmt->execute()) {
                echo "Update successful!";
                header("Location: index.php?success=2"); //Redirect to index.html
                //Empty the Session variable
                unset($_SESSION['overwrite_data']);
                exit; //Stop further execution
            } else {
                echo "Error: Unable to update record.";
            }    
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }   
    }
//Closing the connection
$conn = null;

?>

  <script src="index.js"></script> 
  </body>
</html>