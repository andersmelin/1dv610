<?php

class Logout{

  public $message = "Bye bye!";
  public $maincontent = "Loginform";

  public function __construct(){
    unset($_SESSION['username']);
    session_destroy();
  }
}
