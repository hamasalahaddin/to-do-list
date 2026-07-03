<?php
require "config.php";

$username = trim($_POST["username"]);
$password = trim($_POST["password"]);

if($username === "" || $password === ""){
    sendResponse(false, "Username and password are required");
}

$stmt = mysqli_prepare(
    $conn,
    "SELECT id FROM users WHERE username = ?"
);

mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result) > 0){
    sendResponse(false, "Username already exists");
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO users (username, password)
     VALUES (?, ?)"
);

mysqli_stmt_bind_param(
    $stmt,
    "ss",
    $username,
    $hashedPassword
);

if(mysqli_stmt_execute($stmt)){
    sendResponse(true, "User registered successfully");
}

sendResponse(false, "Failed to register user");