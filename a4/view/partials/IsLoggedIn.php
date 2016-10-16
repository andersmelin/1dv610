<?php

class IsLoggedIn {

  private $html = "<h2>Not logged in</h2>";

  public function __construct($sessionStatus){
    if ($sessionStatus->isLoggedIn()) {
      $this->html = "<h2>Logged in</h2>";
    }
  }

  public function show(){
    return $this->html;
  }
}
