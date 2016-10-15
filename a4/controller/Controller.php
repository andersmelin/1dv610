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
  }

  private function router(){
    $params = $this->params;

    if($params->action == "logout"){
      $this->partial = (new Logout())->getPartial();

    } else if(isset($_SESSION['username'])){
      $this->partial = (new Logout())->getPartial();

    } else if($params->action == "login"){
      $this->partial = (new Login($params->username, $params->password))->getPartial();

    } else if($params->action == "register"){
      $this->partial = (new Register($params->username, $params->password, $params->passwordrepeat))->getPartial();

    } else if($params->action == "showRegistrationform"){
      $this->partial = (new Register())->getPartial();

    } else if($params->action == "showLoginform"){
      $this->partial = new Loginform();

    } else {
      throw new Exception("Unhandled request");
    }
  }

  public function renderView() {
    (new Layout($this->partial))->render();
  }
}
