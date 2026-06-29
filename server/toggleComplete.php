<?php
require "config.php";

$id = $_POST["id"];
$completed = $_POST["completed"];

$stmt = mysqli_prepare(
    $conn,
    "UPDATE tasks
     SET completed = ?
     WHERE id = ?"
);

mysqli_stmt_bind_param(
    $stmt,
    "ii",
    $completed,
    $id
);

if(mysqli_stmt_execute($stmt)){
    sendResponse(true, "Task updated successfully");
}

sendResponse(false, "Failed to update task");