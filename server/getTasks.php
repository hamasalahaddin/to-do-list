<?php
require "config.php";

$userId = requireLogin();

$stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM tasks
     WHERE user_id = ?"
);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $userId
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$tasks = [];

while($row = mysqli_fetch_assoc($result)){
    $tasks[] = $row;
}

sendResponse(true, "Tasks loaded successfully", $tasks);