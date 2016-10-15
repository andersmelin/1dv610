<?php

class IsLoggedIn {

  private $isLoggedIn = "<h2>Not logged in</h2>";

  public function __construct(){
    if (isset($_SESSION['username'])) {
      $this->isLoggedIn = "<h2>Logged in</h2>";
    }
  }

  public function show(){
    return $this->isLoggedIn;
  }
}
