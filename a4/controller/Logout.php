<?php

// Kills the current login session if such a thing exists
// One public methods "getPartial" returns the correct view partial
class Logout{

  private $message = "Bye bye!";

  public function __construct(){
    if(isset($_SESSION['username'])){
      unset($_SESSION['username']);
    } else {
      $this->message = "";
    }

    session_destroy();
  }

  public function getPartial() {
    return new Loginform($this->message);
  }
}
