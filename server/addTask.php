<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Content-Type: application/json");

require "db.php";

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
    echo json_encode([
        "success" => true,
        "message" => "Task added successfully"
    ]);
}else{
    echo json_encode([
        "success" => false,
        "message" => "Failed to add task"
    ]);
}