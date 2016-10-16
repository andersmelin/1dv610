<?php

require_once("IncomingParams.php");
require_once("Login.php");
require_once("Logout.php");
require_once("Register.php");
require_once("Sessionstatus.php");

class Controller {

  private $partial;
  private $params;
  public $sessionStatus;

  public function __construct(){
    $this->params = new IncomingParams();
    $this->sessionStatus = new Sessionstatus;
    $this->router();
  }

  private function router(){
    $params = $this->params;

    if($params->action == "logout"){
      $this->partial = (new Logout($this->sessionStatus))->getPartial();

    } else if($this->sessionStatus->isLoggedIn()){
      $this->partial = new Logoutform();

    } else if($params->action == "login"){
      $this->partial = (new Login($params->username, $params->password, $this->sessionStatus))->getPartial();

    } else if($params->action == "register"){
      $this->partial = (new Register($params->username, $params->password, $params->passwordrepeat))->getPartial();

    } else if($params->action == "showRegistrationform"){
      $this->partial = new Registrationform();

    } else {
      $this->partial = new Loginform();
    }
  }

  public function renderView() {
    (new Layout($this->partial, $this->sessionStatus))->render();
  }
}
