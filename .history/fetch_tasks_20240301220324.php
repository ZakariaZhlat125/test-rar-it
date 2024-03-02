<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "docdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$status = isset($_GET['status']) ? $_GET['status'] : null;

if ($status !== null) {
    // Adjust the SQL query based on your database schema
    $sql = "SELECT * FROM tasks  ORDER BY date_created ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="task-item" id="' . $row['id'] . '" draggable="true" ondragstart="drag(event)">' . $row['name'] . '</div>';
        }
    } else {
        echo '<p>No tasks in this category</p>';
    }
}

$conn->close();
