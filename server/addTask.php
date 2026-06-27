<?php
header("Access-Control-Allow-Origin: http://localhost:5173");

require "db.php";

$task = $_POST["task"];

$sql = "INSERT INTO tasks (task, completed)
        VALUES ('$task', 0)";

if(mysqli_query($conn, $sql)){
    echo "Task added successfully";
}
else{
    echo "Error";
}