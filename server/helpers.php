<?php
function sendResponse($success, $message){
    echo json_encode([
        "success" => $success,
        "message" => $message
    ]);

    exit();
}