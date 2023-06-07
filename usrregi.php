
<?php
// Assuming you have a MySQL database connection
session_start();

include('connection.php');


if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$username=$_POST['user'];
$password=$_POST['pass'];
$mobile=$_POST['mobile'];

// Insert data into the database
$sql = "INSERT INTO users(username, password, mobile) VALUES ('$username','$password','$mobile')";

if (mysqli_query($conn, $sql)) {
    echo '<script>
window.location.href ="userlogin.php";
alert("New Registration Completed ")
</script>';
} else {
  echo '<script>
window.location.href ="userlogin.php";
alert("New Registration Completed ")
</script>';
}

mysqli_close($conn);
?>