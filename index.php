<?php

session_start();

require_once("ViewHelper.php");
require_once("controller/UserController.php");
require_once("controller/GroupController.php");
require_once("controller/RecipeController.php");
require_once("controller/MessageController.php");

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("ASSETS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "assets/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    "user/register" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            UserController::registerUser();
        } else {
            UserController::showRegistrationForm();
        }
    },
    "user/login" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            UserController::loginUser();
        } else {
            UserController::showLoginForm();
        }
    },
    "user/logout" => function () {
        UserController::logoutUser();
    },
    "group/selection" => function () {
        GroupController::showGroupSelection();
    },
    "group/selection" => function () {
        GroupController::showGroupSelection();
    },
    // Other routes...
    "" => function () {
        // Default route - redirect to login/register page
        ViewHelper::redirect(BASE_URL . "user/login");
    },
];

try {
    if (isset($urls[$path])) {
        $urls[$path]();
    } else {
        echo "No controller for '$path'";
    }
} catch (Exception $e) {
    echo "An error occurred: <pre>$e</pre>";
    // Handle the error appropriately, e.g., redirect to an error page
}