<?php
require "config.php";

$task = $_POST["task"];

$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO tasks (task, completed)
     VALUES (?, ?)"
);

$completed = 0;

mysqli_stmt_bind_param(
    $stmt,
    "si",
    $task,
    $completed
);

if(mysqli_stmt_execute($stmt)){
    sendResponse(true, "Task added successfully");
}

sendResponse(false, "Failed to add task");