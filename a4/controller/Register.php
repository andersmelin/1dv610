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
      $this->user->create($this->username, $this->password, $this->passwordRepeat);
      return new Loginform("Registered new user.", $this->username);
    } catch (Exception $e) {
      return new Registrationform($e->getMessage(), strip_tags($this->username), strip_tags($this->password));
    }
  }
}
