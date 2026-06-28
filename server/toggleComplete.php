<?php
header("Access-Control-Allow-Origin: http://localhost:5173");

require "db.php";

$id = $_POST["id"];
$completed = $_POST["completed"];

$sql = "UPDATE tasks
        SET completed = $completed
        WHERE id = $id";

if(mysqli_query($conn, $sql)){
    echo "Task updated successfully";
}else{
    echo "Error";
}