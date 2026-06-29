<?php
require "helpers.php";

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Content-Type: application/json");

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "todo_db"
);

mysqli_set_charset($conn, "utf8mb4");

if(!$conn){
    echo json_encode([
        "success" => false,
        "message" => "Database connection failed"
    ]);
    exit();
}