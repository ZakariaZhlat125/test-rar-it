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
$status = isset($_POST['status']) ? $_POST['status'] : null;

if ($taskId !== null && $status !== null) {
  // Adjust the SQL query based on your database schema
  $sql = "UPDATE tasks SET status = '$status' WHERE id = '$taskId'";

  if ($conn->query($sql) === TRUE) {
    echo "Task status updated successfully.";
  } else {
    echo "Error updating task status: " . $conn->error;
  }
}

$conn->close();
?>
