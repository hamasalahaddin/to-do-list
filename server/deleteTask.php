<?php
require "config.php";

$userId = requireLogin();

$id = $_POST["id"];

$stmt = mysqli_prepare(
    $conn,
    "DELETE FROM tasks
    WHERE id = ?
    AND user_id = ?"
);

mysqli_stmt_bind_param(
    $stmt,
    "ii",
    $id,
    $userId
);

if(mysqli_stmt_execute($stmt)){
    sendResponse(true, "Task deleted successfully");
}

sendResponse(false, "Failed to delete task");