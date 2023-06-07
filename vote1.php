<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Assuming you have a MySQL database connection

  session_start();

  include('connection.php');


  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }


  //


  $userId = $_SESSION['name'];

  // Retrieve selected candidate ID and user ID from the form submission
  $candidateId = $_POST['candidate'];


  // Check if the user has already voted
  $sql = "SELECT * FROM votes WHERE user_id = '$userId'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    echo '<script>
    window.location.href ="index.php";
    alert("You already voted, Back to home page...! ")
    </script>';
  } else {
    // Update the vote count in the database for the selected candidate

    $sql = "UPDATE candidates SET votes = votes + 1 WHERE id = $candidateId";

    if (mysqli_query($conn, $sql)) {
      // Insert the vote into the votes table to track the user's vote
      $sql = "INSERT INTO votes (candidate_id, user_id) VALUES ($candidateId, '$userId')";
      mysqli_query($conn, $sql);

      echo '<script>
window.location.href ="index.php";
alert("Vote Submitted Successfully ")
</script>';
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }

  mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Vote for Candidates</title>

  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="head">

    <header>
      <h2><img src="images/unnamed.png" alt="" width="50" height="50">Smart Voting</h2>
    </header>
  </div>
  <div id="form" class="form">
    <?php
    session_start();

    if (isset($_SESSION['userId']) && isset($_SESSION['name'])) {
      $userId = $_SESSION['userId'];
      $name = $_SESSION['name'];

      // Display the user information
      echo "<h1>Welcome, $name (User ID: $userId)</h1>";
    } else {
      // User not logged in, handle accordingly (e.g., redirect to login page)
      header("Location: userlogin.php");
      exit();
    }
    ?>
    <h1>Vote for Candidates</h1>
    <form action="" method="POST">
      <label for="candidate">Select a candidate:</label>
      <select id="candidate" name="candidate">

        <?php
        // Assuming you have a MySQL database connection

        include('connection.php');


        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        // Retrieve candidate data from the database
        $sql = "SELECT * FROM candidates";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['id'] . "'>" . $row['Name1'] .  "</option>";
          }
        } else {
          echo "<option value=''>No candidates found</option>";
        }

        mysqli_close($conn);
        ?>
      </select><br><br>
      <!-- <label for="userId">User ID:</label>
    <input type="text" id="userId" name="userId" required><br><br>
     -->
      <input type="submit" value="Vote">
    </form>
  </div>
</body>

</html>