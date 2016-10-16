<?php

// INCLUDE VIEWS (Partials included in Layout)
require_once('view/Layout.php');

// INCLUDE HELPER CONTROLLERS
require_once("IncomingParams.php");
require_once("Sessionstatus.php");

// INCLUDE USE CASE CONTROLLERS
require_once("Login.php");
require_once("Logout.php");
require_once("Register.php");

class Controller {

  private $partial;
  private $params;
  public $sessionStatus;

  public function __construct(){
    $this->params = new IncomingParams();
    $this->sessionStatus = new Sessionstatus;
    $this->router();
  }

  // This router takes care of auth (model) and/or sets the correct partial (view)
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

  // Sends the partial to the main view template and render the main view
  public function renderView() {
    (new Layout($this->partial, $this->sessionStatus))->render();
  }
}
