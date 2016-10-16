<?php

require_once($_SERVER["ROOT"] . "model/User.php");

abstract class Auth{

  protected $username;
  protected $password;
  protected $passwordRepeat;
  protected $user;

  public function __construct($username, $password, $passwordRepeat){
    $this->username = $username;
    $this->password = $password;
    $this->passwordRepeat = $passwordRepeat;

    $this->user = new User();
  }
}
