<?php
header("Access-Control-Allow-Origin: http://localhost:5173");

require "db.php";

$id = $_POST["id"];

$sql = "DELETE FROM tasks WHERE id = $id";

if(mysqli_query($conn, $sql)){
    echo "Task deleted successfully";
}else{
    echo "Error";
}