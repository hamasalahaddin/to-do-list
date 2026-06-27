<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Content-Type: application/json");

require "db.php";

$sql = "SELECT * FROM tasks";
$result = mysqli_query($conn, $sql);

$tasks = [];

while($row = mysqli_fetch_assoc($result)){
    $tasks[] = $row;
}

echo json_encode($tasks);
