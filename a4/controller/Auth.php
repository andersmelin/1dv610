<?php

require_once($_SERVER["ROOT"] . "model/User.php");

abstract class Auth{

  public $success;

  // TODO: Carefully remove message
  public $message = "";
  public $username;
  public $password;

  protected $passwordRepeat;
  protected $cookiePassword;

  protected $user;

  public function __construct($username, $password, $cookiePassword, $passwordRepeat){
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
