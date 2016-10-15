<?php

require_once("Auth.php");

class Register extends Auth{

  // TODO: Investigate why this is a protected member and not a private
  protected $passwordRepeat;

  public function __construct($username = "", $password = "", $passwordRepeat = ""){
    parent::__construct($username, $password, null, $passwordRepeat);
  }

  public function getPartial() {
    try {
      // TODO: Check requirements if passwordRepeat is a required parameter
      $this->user->create($this->username, $this->password, $this->passwordRepeat);
      return new Loginform("Registered new user.", $username);
    } catch (Exception $e) {
      return new Registrationform($e->getMessage(), $this->username, $this->password);
    }
  }
}
