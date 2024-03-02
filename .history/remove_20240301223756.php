<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "docdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$taskId = isset($_POST['taskId']) ? $_POST['taskId'] : null;

if ($taskId !== null) {
  // Adjust the SQL query based on your database schema
  $sql = "DELETE FROM tasks WHERE id = '$taskId'";

  if ($conn->query($sql) === TRUE) {
    echo "Task removed successfully.";
  } else {
    echo "Error removing task: " . $conn->error;
  }
}

$conn->close();
?>
