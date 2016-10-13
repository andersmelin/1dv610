<?php

class IsLoggedIn {

  public $show;

  public function __construct(){

    if (isset($_SESSION['username'])) {
      $this->show = "<h2>Logged in</h2>";
    }
    else {
      $this->show = "<h2>Not logged in</h2>";
    }
  }
}
