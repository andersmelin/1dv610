<?php

// Kills the current login session if such a thing exists
// One public methods "getPartial" returns the correct view partial
class Logout{

  private $message = "Bye bye!";

  public function __construct($sessionStatus){
    if($sessionStatus->isLoggedIn()){
      $sessionStatus->logOut();

    } else {
      $this->message = "";
    }
  }

  public function getPartial() {
    return new Loginform($this->message);
  }
}
