<?php

class Postdata {

  public function __construct(){
    foreach ($_POST as $key => $value) {
      $key = (strpos($key , "::")) ? explode("::", $key)[1] : $key;
      $key = strtolower($key);
      $key = (in_array($key , array("logout", "login", "doregistration"))) ? "action" : $key;

			$this->$key = $value;
		}
  }
}
