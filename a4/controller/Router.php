<?php

require_once("IncomingParams.php");
require_once("Login.php");
require_once("Logout.php");
require_once("Register.php");

class Router {

  private $partial;
  private $params;

  public function __construct(){
    $this->params = new IncomingParams();
    $this->router();
    $this->renderView();
  }

  private function router(){
    $params = $this->params;

    if(!empty($params->action)){

      if($params->action == "logout"){
        $this->partial = (new Logout())->getPartial();

      } else if(isset($_SESSION['username'])){
        $this->partial = (new Logout())->getPartial();

      } else if($params->action == "login"){
        $this->partial = (new Login($params->username, $params->password))->getPartial();

      } else if($params->action == "register"){
        $this->partial = (new Register($params->username, $params->password, $params->passwordrepeat))->getPartial();

      } else if($params->action == "ShowRegistrationform"){
        // Do something

      } else {
        // echo '<pre>'; echo var_dump($postdata); echo'</pre>';
        throw new Exception("Unhandled request");
      }

    } else {
      $this->partial = (new Login())->getPartial();
    }
  }

  private function renderView() {
    echo get_class($this->partial);
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
