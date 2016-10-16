<?php

require_once("Auth.php");

class Login extends Auth{

  private $loginStatus;
  private $loginMessage;
  private $partial;

  public function __construct($username = "", $password = "",  $sessionStatus){
    parent::__construct($username, $password, null);
    // User cannot login if already logged in
    if($sessionStatus->isLoggedIn()){
      return;
    }

    $this->tryLogin();
    $sessionStatus->logIn($this->username);
    $this->setPartial();
  }
  
  private function tryLogin() {
    try {
      $this->user->authenticate($this->username, $this->password);
      $this->loginStatus = true;
      $this->loginMessage = "Welcome";

    } catch (Exception $e){
      $this->loginStatus = false;
      $this->loginMessage = $e->getMessage();
    }
  }

  private function setPartial() {
    if ($this->loginStatus) {
        $this->partial =  new Logoutform($this->loginMessage);

    } else {
      $this->partial = new Loginform($this->loginMessage, $this->username, $this->password);
    }
  }

  public function getPartial() {
    return $this->partial;
  }
}
