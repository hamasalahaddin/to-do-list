<?php
require "config.php";

$userId = requireLogin();

$id = $_POST["id"];
$task = trim($_POST["task"]);

$stmt = mysqli_prepare(
    $conn,
    "UPDATE tasks
     SET task = ?
     WHERE id = ?
     AND user_id = ?"
);

mysqli_stmt_bind_param(
    $stmt,
    "sii",
    $task,
    $id,
    $userId
);

if(mysqli_stmt_execute($stmt)){
    sendResponse(true, "Task updated successfully");
}

sendResponse(false, "Failed to update task");