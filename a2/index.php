<?php
session_start();

// SET ROOT FOLDER FOR EASY ACCESS
$_SERVER["ROOT"] = $_SERVER["DOCUMENT_ROOT"] . "/1dv610/a2/";

// INCLUDE VIEWS
require_once('view/Layout.php');

// INCLUDE CONTROLLERS
require_once('controller/Register.php');
require_once('controller/Login.php');
require_once('controller/Logout.php');
require_once('controller/CookieLogin.php');
require_once('controller/Postdata.php');

// MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// ROUTER

// chmod 777 -R ./db
$postdata = new Postdata();
if(isset($postdata->action)){

  if($postdata->action == "logout" && isset($_SESSION['username'])){
    $controller = new Logout();

  } else if(isset($_SESSION['username'])){
    $maincontent = "Logoutform";

  } else if($postdata->action == "login"){
    $controller = new Login($postdata->username, $postdata->password);

  } else if($postdata->action == "register"){
    $controller = new Register($postdata->username, $postdata->password, $postdata->passwordrepeat);

  } else {
    throw new Exception("Unhandled POST request: " . $postdata->action);
  }

} else if(in_array("register", array_keys($_GET))){
    $maincontent = "Registrationform";
}
$message     = (isset($controller->message))     ? $controller->message     : "";
$username    = (isset($controller->username))    ? $controller->username    : "";
$password    = (isset($controller->password))    ? $controller->password    : "";
if(!isset($maincontent)){
  $maincontent = (isset($controller->maincontent)) ? $controller->maincontent : "Loginform";
}

// RENDER PAGE
(new Layout($maincontent, $message, $username, $password))->render();
