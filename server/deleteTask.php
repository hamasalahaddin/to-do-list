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
    sendResponse(true, "Task deleted successfully");
}

sendResponse(false, "Failed to delete task");