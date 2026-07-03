<?php
require "config.php";

if(isset($_SESSION["user_id"])){
    sendResponse(true, "User is logged in", $_SESSION["user_id"]);
}

sendResponse(false, "User is not logged in");