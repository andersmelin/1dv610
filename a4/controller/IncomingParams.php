<?php

// Takes POST and GET arguments and store them in key-value pairs
// NB! php doesn't allow for dynamically created private properties. Props are public
class IncomingParams {

  public $action = "showLoginform";

  public function __construct(){
    if(in_array("register", array_keys($_GET))){
        $this->action = "showRegistrationform";
    }

    foreach ($_POST as $key => $value) {
      $key = (strpos($key , "::")) ? explode("::", $key)[1] : $key;
      $key = strtolower($key);

      $this->$key = $value;

      // Only key provided - make "action" be the key and the key be the value
      if($key == "login"){ $this->action = "login"; }
      if($key == "logout"){ $this->action = "logout"; }
      if($key == "doregistration" || $key == "register"){ $this->action = "register"; }
		}
  }
}
