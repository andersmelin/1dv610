<?php

class CookieLogin extends Auth{

  public function __construct(){
    parent::__construct($username, null, $cookiePassword);
  }

  protected function cookiePasswordMatch(){
    $cookiePassword = null; // Get cookiePassword from username in db
    return $this->cookiePassword == $cookiePassword;
  }
}
