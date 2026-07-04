<?php
require "config.php";

$userId = requireLogin();

$task = $_POST["task"];

$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO tasks (task, completed, user_id)
     VALUES (?, ?, ?)"
);

$completed = 0;

mysqli_stmt_bind_param(
    $stmt,
    "sii",
    $task,
    $completed,
    $userId
);

if(mysqli_stmt_execute($stmt)){
    sendResponse(true, "Task added successfully");
}

sendResponse(false, "Failed to add task");