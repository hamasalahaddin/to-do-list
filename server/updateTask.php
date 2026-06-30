<?php
require "config.php";

$id = $_POST["id"];
$task = trim($_POST["task"]);

$stmt = mysqli_prepare(
    $conn,
    "UPDATE tasks
     SET task = ?
     WHERE id = ?"
);

mysqli_stmt_bind_param(
    $stmt,
    "si",
    $task,
    $id
);

if(mysqli_stmt_execute($stmt)){
    sendResponse(true, "Task updated successfully");
}

sendResponse(false, "Failed to update task");