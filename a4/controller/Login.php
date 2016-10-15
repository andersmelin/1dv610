<?php

require_once("Auth.php");

class Login extends Auth{

  public function __construct($username = "", $password = ""){
    parent::__construct($username, $password, null);
  }

  public function getPartial() {
    try {
      $this->user->authenticate($this->username, $this->password);
      $_SESSION['username'] = $this->username;
      return new Logoutform("Welcome");

    } catch (Exception $e){
      return new Loginform($e->getMessage(), $this->username, $this->password);
    }
  }
}
