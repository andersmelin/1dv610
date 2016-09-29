<?php

class Logout{

  public $message = "Bye bye!";
  public $maincontent = "Loginform";

  public function __construct(){
    if(isset($_SESSION['username'])){
      unset($_SESSION['username']);

    } else {
      $this->message = "";
    }

    session_destroy();
  }
}
