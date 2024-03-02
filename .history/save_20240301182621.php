<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "docdb";

// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// TODO: Retrieve task IDs from the frontend
$todoTasks = $_POST['todoTasks'];
$inProgressTasks = $_POST['inProgressTasks'];
$doneTasks = $_POST['doneTasks'];

// TODO: Update the database with the new task order
updateTaskOrder($conn, 'todo_tasks', $todoTasks);
updateTaskOrder($conn, 'in_progress_tasks', $inProgressTasks);
updateTaskOrder($conn, 'done_tasks', $doneTasks);

$conn->close();

function updateTaskOrder($conn, $tableName, $taskIds) {
  // Construct the SQL query to update the task order
  $sql = "UPDATE $tableName SET order_column = CASE id ";

  foreach ($taskIds as $index => $taskId) {
    $sql .= "WHEN '$taskId' THEN '$index' ";
  }

  $sql .= "END WHERE id IN ('" . implode("','", $taskIds) . "')";

  // Execute the query
  if ($conn->query($sql) === TRUE) {
    echo "Task order updated successfully for $tableName.\n";
  } else {
    echo "Error updating task order: " . $conn->error . "\n";
  }
}
?>
