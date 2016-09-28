<?php

class Logout{

  public $message = "Bye Bye!";
  public $maincontent = "Loginform";

  public function __construct(){
    unset($_SESSION['username']);
    session_destroy();
  }
}
