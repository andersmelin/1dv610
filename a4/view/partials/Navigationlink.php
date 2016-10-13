<?php

class Navigationlink {

  private $navlink;

	public function __construct($maincontent){

    if($maincontent == "Loginform"){
      $this->navlink = "<a href='?register'>Register a new user</a>";

    } else if($maincontent == "Registrationform"){
      $this->navlink = "<a href='?'>Back to login</a>";
    }
	}

  public function show(){
    return $this->navlink;
  }
}
