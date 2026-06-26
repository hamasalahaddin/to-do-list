<?php
require "db.php";

$sql = "SELECT * FROM tasks";
$result = mysqli_query($conn, $sql);

$tasks = [];

while($row = mysqli_fetch_assoc($result)){
    $tasks[] = $row;
}

header("Content-Type: application/json");
echo json_encode($tasks);
