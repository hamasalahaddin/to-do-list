<?php
require "config.php";

session_unset();
session_destroy();

sendResponse(true, "Logged out successfully");