<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "docdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Log and display the received data for debugging
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// die;

// TODO: Retrieve task IDs from the frontend
$todoTasks = isset($_POST['todoTasks']) ? $_POST['todoTasks'] : null;
$inProgressTasks = isset($_POST['inProgressTasks']) ? $_POST['inProgressTasks'] : null;
$doneTasks = isset($_POST['doneTasks']) ? $_POST['doneTasks'] : null;

// Check if any of the arrays is not null before updating the database
if ($todoTasks !== null) {
  updateTaskOrder($conn, 'todo_tasks', $todoTasks);
}
if ($inProgressTasks !== null) {
  updateTaskOrder($conn, 'in_progress_tasks', $inProgressTasks);
}
if ($doneTasks !== null) {
  updateTaskOrder($conn, 'done_tasks', $doneTasks);
}

$conn->close();

function updateTaskOrder($conn, $tableName, $taskIds) {
  // Check if $taskIds is an array before proceeding
  if (!is_array($taskIds)) {
    echo "Invalid data for $tableName.\n";
    return;
  }

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
    echo "Error updating task order for $tableName: " . $conn->error . "\n";
  }
}
?>
