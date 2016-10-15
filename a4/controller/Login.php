<?php

require_once("Auth.php");

class Login extends Auth{

  public function __construct($username = "", $password = ""){
    parent::__construct($username, $password, null, null);
  }

  public function getPartial() {
    try {
      $this->user->authenticate($this->username, $this->password);
      $_SESSION['username'] = $this->username;
      return new Logoutform("message goes here");

    } catch (Exception $e){
      // TODO: Strip tags?
      return new Loginform($e->getMessage(), $this->username, $this->password);
    }
  }
}
