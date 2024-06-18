<?php
function connectDatabase() {
    global $host;
    global $user; 
    global $password;
    global $dbname;
    $conn = new mysqli($host, $user, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function selectAll($conn, $table) {
    $sql = "SELECT * FROM $table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            print_r($row);
        }
    } else {
        echo "0 results";
    }
}

function insertData($conn, $table, $data) {
    $columns = implode(", ", array_keys($data));
    $values = implode("', '", array_values($data));
    $sql = "INSERT INTO $table ($columns) VALUES ('$values')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


function updateData($conn, $table, $data, $condition) {
    $set = "";
    foreach ($data as $column => $value) {
        $set .= "$column='$value', ";
    }
    $set = rtrim($set, ", ");
    $sql = "UPDATE $table SET $set WHERE $condition";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function deleteData($conn, $table, $condition) {
    $sql = "DELETE FROM $table WHERE $condition";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}