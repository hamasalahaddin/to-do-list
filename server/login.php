<?php
require "config.php";

$username = trim($_POST["username"]);
$password = trim($_POST["password"]);

if($username === "" || $password === ""){
    sendResponse(false, "Username and password are required");
}

$stmt = mysqli_prepare(
    $conn,
    "SELECT id, password
     FROM users
     WHERE username = ?"
);

mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result) === 0){
    sendResponse(false, "Invalid username or password");
}

$user = mysqli_fetch_assoc($result);

if(password_verify($password, $user["password"])){
    $_SESSION["user_id"] = $user["id"];

    sendResponse(true, "Login successful");
}

sendResponse(false, "Invalid username or password");