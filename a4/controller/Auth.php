<?php

require_once($_SERVER["ROOT"] . "model/User.php");

abstract class Auth{

  protected $username;
  protected $password;
  protected $passwordRepeat;
  protected $user;

  public function __construct($username, $password, $passwordRepeat){
    // TODO: Make it fucking right. What kind of BS try block is this!!!
    try{
      $this->username = $username;
      $this->password = $password;
      $this->passwordRepeat = $passwordRepeat;

    } catch(Exception $e){
      throw new Exeption("Missing argument(s)");
    }

    $this->user = new User($username, $password, $passwordRepeat);
  }
}
