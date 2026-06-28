<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Content-Type: application/json");

require "db.php";

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
    echo json_encode([
        "success" => true,
        "message" => "Task updated successfully"
    ]);
}else{
    echo json_encode([
        "success" => false,
        "message" => "Failed to update task"
    ]);
}