<?php
session_start();

// SET ROOT FOLDER FOR EASY ACCESS
$_SERVER["ROOT"] = $_SERVER["DOCUMENT_ROOT"] . "/1dv610/a4/";

// INCLUDE VIEWS
require_once('view/Layout.php');

// INCLUDE CONTROLLERS
require_once('controller/IncomingParams.php');
require_once('controller/Router.php');

// require_once('controller/Register.php');
// require_once('controller/Login.php');
// require_once('controller/Logout.php');
// require_once('controller/CookieLogin.php');
// require_once('controller/Postdata.php');

// MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// ROUTER

// RENDER PAGE
new Router();
//(new Layout($maincontent, $message, $username, $password))->render();
