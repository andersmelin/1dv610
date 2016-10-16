<?php

require_once("Auth.php");

class Login extends Auth{

  private $loginStatus;
  private $loginMessage;
  private $partial;

  public function __construct($username = "", $password = ""){
    parent::__construct($username, $password, null);
    $this->tryLogin();
    $this->startUsersessionIfAuthenticated();
    $this->setPartial();
  }

  // public function getPartial() {
  //   try {
  //     $this->user->authenticate($this->username, $this->password);
  //     $_SESSION['username'] = $this->username;
  //     return new Logoutform("Welcome");
  //
  //   } catch (Exception $e){
  //     return new Loginform($e->getMessage(), $this->username, $this->password);
  //   }
  // }

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

  private function startUsersessionIfAuthenticated() {
    if ($this->loginStatus) {
        $_SESSION['username'] = $this->username;
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
