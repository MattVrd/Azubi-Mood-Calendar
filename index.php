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
  require_once 'db.php';

  try {
    //Prepare the SQL statement to retrieve names
    $sql = "SELECT * FROM azubis";

    //Execute the statement                      
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    //Fetching the results and storing them in $names
    $names = $stmt->fetchAll(PDO::FETCH_ASSOC); 
                      
    //Close the connection
    $conn = null;
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
  }
  ?>
    <h1>Stimmung einer Person eingeben</h1>
    <div>
      <form class="form-container" action="submit.php" method="post">
        <label for="azubi-name">Azubi auswählen:</label>
        <select name="azubi-name" id="azubi-name" required>
          <?php foreach ($names as $azubi): ?>  <!-- option value is Azubi_ID -->
              <option value="<?php echo htmlspecialchars($azubi["Azubi_ID"]); ?>"><?php echo htmlspecialchars($azubi["Name"]); ?></option>  
          <?php endforeach; ?> 
        </select> 
    </div>

      <h2 class="title">Stimmung auswählen:</h2>
        <div id="feeling" class="icon-container">
            <span class="icon" id="emoji" data-value="1">😞</span>
            <span class="icon" id="emoji" data-value="2">😐</span>
            <span class="icon" id="emoji" data-value="3">😊</span>
            <span class="icon" id="emoji" data-value="4">😁</span>
            <span class="icon" id="emoji" data-value="5">😍</span>
        </div>
        <input type="hidden" name="Feeling" id="feeling-input" required />

        <br /><br />

        <h2 class="title">Energie Level auswählen:</h2>
        <div id="Energy" class="icon-container">
          <img class="icon" data-value="1" src="img/low.png" alt="Low Energy" />
          <img class="icon" data-value="2" src="img/medium.png" alt="Medium Energy" />
          <img class="icon" data-value="3" src="img/high.png" alt="High Energy" />
        </div>
        <input type="hidden" name="Energy" id="energy-input" required /> <!--Hidden Field to store the energy level-->

        <br /><br />

        <div class="button-container">
          <input type="submit" value="Absenden" />
        </div>
        

      <?php
      //Checking if the success query parameter is set
      if (isset($_GET['success']) && $_GET['success'] == 1) {
          echo "<span style='color: green; margin-left: 10px;'> Neuer Tag eingetragen</span>"; //Display the message under to the submit button
      } else if (isset($_GET['success']) && $_GET['success'] == 2) {
        echo "<span style='color: green; margin-left: 10px;'> Der Tag wurde erfolgreich aktualisiert</span>"; 
      }
      ?>
    </form>
     <script src="index.js"></script> 
  </body>
</html>
