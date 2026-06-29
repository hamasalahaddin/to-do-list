<?php
require "config.php";

$sql = "SELECT * FROM tasks";
$result = mysqli_query($conn, $sql);

$tasks = [];

while($row = mysqli_fetch_assoc($result)){
    $tasks[] = $row;
}

echo json_encode($tasks);
