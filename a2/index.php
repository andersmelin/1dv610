<?php
session_start();
//$_SESSION["username"] = "JKJJ";

// SET ROOT FOLDER FOR EASY ACCESS
$_SERVER["ROOT"] = $_SERVER["DOCUMENT_ROOT"] . "/1dv610-a2/";

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

// default screen
$message = "";
$username = "";
$password = "";
$maincontent = "Loginform";

$postdata = new Postdata();
if(isset($postdata->action)){
  switch ($postdata->action) {

    case "login":
      $controller = new Login($postdata->username, $postdata->password);
      break;

    case "logout":
      $controller = new Logout();
      break;

    case "register":
      $controller = new Register($postdata->username, $postdata->password, $postdata->passwordrepeat);
      break;

    default:
      throw new Exception("Unhandled POST request: " . $postdata->action);
  }

    $message     = (isset($controller->message))     ? $controller->message     : "";
    $username    = (isset($controller->username))    ? $controller->username    : "";
    $password    = (isset($controller->password))    ? $controller->password    : "";
    $maincontent = (isset($controller->maincontent)) ? $controller->maincontent : "";

} else if(isset($_SESSION['username'])){
    $maincontent = "Logoutform";

} else if(in_array("register", array_keys($_GET))){
    $maincontent = "Registrationform";

}




// RENDER PAGE

(new Layout($maincontent, $message, $username, $password))->render();
