<?php
require "config.php";

$userId = requireLogin();

$id = $_POST["id"];
$completed = $_POST["completed"];

$stmt = mysqli_prepare(
    $conn,
    "UPDATE tasks
     SET completed = ?
     WHERE id = ?
     AND user_id = ?"
);

mysqli_stmt_bind_param(
    $stmt,
    "iii",
    $completed,
    $id,
    $userId
);

if(mysqli_stmt_execute($stmt)){
    sendResponse(true, "Task updated successfully");
}

sendResponse(false, "Failed to update task");