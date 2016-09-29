<?php

require_once("Auth.php");

class Register extends Auth{

  protected $passwordRepeat;

  public function __construct($username, $password, $passwordRepeat){

    parent::__construct($username, $password, null, $passwordRepeat);

    if($this->validateAll()){
      $this->user->create($username, $password);
      $this->maincontent = "Loginform";
      $this->message = "Registered new user.";
    } else {
      $this->maincontent = "Registrationform";
      $this->message = $this->generateMessage();
    }

  }

  private function validateUsernameLength(){
    return mb_strlen($this->username, "utf8") > 2;
  }

  private function validatePasswordLength(){
    return mb_strlen($this->password, "utf8") > 5;
  }

  private function comparePasswords(){
    return $this->password == $this->passwordRepeat;
  }

  private function validateAll(){
    return ($this->validateUsernameLength() && $this->validatePasswordLength() && $this->comparePasswords() && !$this->user->exists($this->username));
  }

  private function generateMessage(){

    if(!$this->validatePasswordLength() || !$this->validateUsernameLength()){
      $usernameShort = ($this->validateUsernameLength()) ? "" : "Username has too few characters, at least 3 characters. ";
      $passwordShort = ($this->validatePasswordLength()) ? "" : "Password has too few characters, at least 6 characters.";

      return trim($usernameShort . $passwordShort);
    }

    if(!$this->comparePasswords()){
      return "Passwords do not match.";
    }

    if($this->user->exists($this->username)){
      return "User exists, pick another username.";
    }

    throw new Exception("Unhandled user registration state");
  }
}
