<?php

class CookieLogin extends Auth{

  public function __construct(){
    parent::__construct($username, null, $cookiePassword);
  }
}
