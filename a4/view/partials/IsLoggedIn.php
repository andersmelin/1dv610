<?php

class IsLoggedIn {

  private $isLoggedIn;

  public function __construct(){
    if (isset($_SESSION['username'])) {
      $this->show = "<h2>Logged in</h2>";
    }
    else {
      $this->isLoggedIn = "<h2>Not logged in</h2>";
    }
  }

  public function show(){
    return $this->isLoggedIn;
  }
}
