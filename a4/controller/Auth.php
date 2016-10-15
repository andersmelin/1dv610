<?php

require_once($_SERVER["ROOT"] . "model/User.php");

abstract class Auth{

  public $success;

  // TODO: Carefully remove message
  public $message = "";

  // TODO: Make it private god damn!
  public $username;
  public $password;

  protected $passwordRepeat;
  protected $cookiePassword;

  protected $user;

  public function __construct($username, $password, $cookiePassword, $passwordRepeat){
    // TODO: Make it fucking right. What kind of BS try block is this!!!
    try{
      $this->username = $username;
      $this->password = $password;
      $this->passwordRepeat = $passwordRepeat;
      $this->cookiePassword = $cookiePassword;

    } catch(Exception $e){
      throw new Exeption("Missing argument(s)");
    }

    $this->user = new User($username, $password, $cookiePassword, $passwordRepeat);
  }
}
