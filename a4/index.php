<?php
session_start();

// MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// SET ROOT FOLDER FOR EASY ACCESS
$_SERVER["ROOT"] = $_SERVER["DOCUMENT_ROOT"] . "/1dv610/a4/";

// INCLUDE VIEWS
require_once('view/Layout.php');

// INCLUDE CONTROLLERS
require_once('controller/Controller.php');

// RENDER PAGE
(new Controller())->renderView();
