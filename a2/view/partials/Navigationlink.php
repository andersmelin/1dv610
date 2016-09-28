<?php

class Navigationlink {

  public $show;

	public function __construct($maincontent){

    if($maincontent == "Loginform"){
      $this->show = "<a href='?register'>Register a new user</a>";

    } else if($maincontent == "Registrationform"){
      $this->show = "<a href=?>Back to login</a>";
    }
	}
}
