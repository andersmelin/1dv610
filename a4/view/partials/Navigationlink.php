<?php

class Navigationlink {

  private $navlink;

	public function __construct($partialName){

    if($partialName == "Loginform"){
      $this->navlink = "<a href='?register'>Register a new user</a>";

    } else if($partialName == "Registrationform"){
      $this->navlink = "<a href='?'>Back to login</a>";
    }
	}

  public function show(){
    return $this->navlink;
  }
}
