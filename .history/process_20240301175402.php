<?php
    // Receive data from the front-end
    $id = $_POST['id'];

    // Implement your logic for storing the data in a MySQL database
    // Ensure you have a MySQL connection established
    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $database = "docdb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the database
    $sql = "INSERT INTO your_table_name (id) VALUES ('$id')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close(