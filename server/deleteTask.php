<?php
require "config.php";

$id = $_POST["id"];

$stmt = mysqli_prepare(
    $conn,
    "DELETE FROM tasks WHERE id = ?"
);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);

if(mysqli_stmt_execute($stmt)){
    echo json_encode([
        "success" => true,
        "message" => "Task deleted successfully"
    ]);
}else{
    echo json_encode([
        "success" => false,
        "message" => "Failed to delete task"
    ]);
}