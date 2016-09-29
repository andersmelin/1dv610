<?php

class Postdata {

  public function __construct(){
    foreach ($_POST as $key => $value) {
      $key = (strpos($key , "::")) ? explode("::", $key)[1] : $key;
      $key = strtolower($key);

      if($key == "login"){
        $key = "action";
        $value = "login";
      }
      if($key == "logout"){
        $key = "action";
        $value = "logout";
      }
      if($key == "doregistration" || $key == "doregistration" || $key == "register"){
        $key = "action";
        $value = "Register";
      }

			$this->$key = $value;
		}
  }
}
