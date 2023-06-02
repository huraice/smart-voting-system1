
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Assuming you have a MySQL database connection
  

  include("connection.php");

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Retrieve username and password from the form submission
    $username= $_POST['usernamelog'];
    $password= $_POST['passusr'];

  // Validate the user credentials against the database
  $sql = "SELECT id, username FROM users WHERE username = '$username' AND password = '$password'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    // User login successful
    $row = mysqli_fetch_assoc($result);
    $userId = $row['id'];
    $name = $row['username'];



    // Store the user ID in a session variable
    $_SESSION['userId'] = $userId;

    $_SESSION['userId'] = $userId;
    $_SESSION['name'] = $name;

    // Redirect to the next screen or page


    header("Location: vote1.php");
    exit();
  } else {
    // Invalid login credentials
    echo '<script>
window.location.href ="userlogin.php";
alert("Login failed. Invalid username or password ")
</script>';
  }

  mysqli_close($conn);
}
?>
