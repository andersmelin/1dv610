<?php

require_once("IncomingParams.php");
require_once("Login.php");
require_once("Logout.php");
require_once("Register.php");

class Controller {

  private $partial;
  private $params;

  public function __construct(){
    $this->params = new IncomingParams();
    $this->router();
    $this->renderView();
  }

  private function router(){
    $action = $this->params->action;
    $username = $this->params->username;
    $password = $this->params->password;
    $passwordrepeat = $this->params->passwordrepeat;

    if($action == "logout"){
      $this->partial = (new Logout())->getPartial();

    } else if(isset($_SESSION['username'])){
      $this->partial = (new Logout())->getPartial();

    } else if($action == "login"){
      $this->partial = (new Login($username, $password))->getPartial();

    } else if($action == "register"){
      $this->partial = (new Register($username, $password, $passwordrepeat))->getPartial();

    } else if($action == "showRegistrationform"){
      $this->partial = (new Register())->getPartial();

    } else if($action == "showLoginform"){
      $this->partial = (new Login())->getPartial();

    } else {
      throw new Exception("Unhandled request");
    }
  }

  private function renderView() {
    echo "Partial: " . get_class($this->partial);
    (new Layout($this->partial))->render();
  }
}

//
//
//
// $username      = (isset($controller->username))    ? $controller->username    : "";
// $password      = (isset($controller->password))    ? $controller->password    : "";
// if(!isset($message)){
//   $message     = (isset($controller->message))     ? $controller->message     : "";
// }
// if(!isset($maincontent)){
//   $maincontent = (isset($controller->maincontent)) ? $controller->maincontent : "Loginform";
// }
