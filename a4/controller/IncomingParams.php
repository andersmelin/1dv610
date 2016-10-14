<?php

class IncomingParams {

  private $action;

  public function __construct(){
    if(in_array("register", array_keys($_GET))){
        $this->action = "ShowRegistrationform";
    }

    foreach ($_POST as $key => $value) {
      $key = (strpos($key , "::")) ? explode("::", $key)[1] : $key;
      $key = strtolower($key);

      if($key == "login"){ $this->action = "login"; }
      if($key == "logout"){ $this->action = "logout"; }
      if($key == "doregistration" || $key == "register"){ $this->action = "register"; }
		}
  }
}
