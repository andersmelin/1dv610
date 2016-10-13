<?php

require_once("Auth.php");

class Login extends Auth{

  public function __construct($username, $password){
    parent::__construct($username, $password, null, null);
    
    if($this->user->authenticate($username, $password)){
      $_SESSION['username'] = $username;
      $this->maincontent = "Logoutform";

    } else {
      $this->maincontent = "Loginform";
    }

    $this->message = $this->generateMessage();
  }

  private function generateMessage(){
    if(!$this->username){
      return "Username is missing";

    } else if(!$this->password){
      return "Password is missing";

    } else if(!$this->user->authenticate($this->username, $this->password)){
      return "Wrong name or password";

    } else {
      return "Welcome";
    }
  }
}
