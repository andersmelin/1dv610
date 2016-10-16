<?php

require_once("Auth.php");

class Register extends Auth{

  private $registratioonStatus;
  private $registrationMessage;
  private $partial;

  public function __construct($username = "", $password = "", $passwordRepeat = ""){
    parent::__construct($username, $password, $passwordRepeat);
    $this->tryRegister();
    $this->setPartial();
  }

  public function getPartial() {
    return $this->partial;
  }

  private function tryRegister() {
    try {
      $this->user->create($this->username, $this->password, $this->passwordRepeat);
      $this->registratioonStatus = true;
      $this->registrationMessage = "Registered new user.";

    } catch (Exception $e) {
      $this->registrationMessage = $e->getMessage();
      $this->registratioonStatus = false;
    }
  }

  private function setPartial() {
    if($this->registratioonStatus) {
      $this->partial = new Loginform($this->registrationMessage, $this->username);

    } else {
      $this->partial = new Registrationform($this->registrationMessage, strip_tags($this->username), strip_tags($this->password));
    }
  }
}
