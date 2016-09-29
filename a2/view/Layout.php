<?php

// INVLUDE PARTIALS
require_once('partials/DateTimeParagraph.php');
require_once('partials/IsLoggedIn.php');
require_once('partials/Loginform.php');
require_once('partials/Navigationlink.php');
require_once('partials/Registrationform.php');
require_once('partials/Logoutform.php');

class Layout {

  private $navlink;
  private $isLoggedIn;
  private $maincontent;
  private $dateTimeParagraph;

  private $args;

  public function __construct($maincontent, $message, $username, $password){
    $this->isLoggedIn = (new IsLoggedIn())->show;
    $this->dateTimeParagraph = (new DateTimeParagraph())->show;
    $this->maincontent = (new $maincontent($message, $username, $password))->show;
    $this->navlink = (new Navigationlink($maincontent))->show;
  }

  private function renderPartials(){
    $this->isLoggedIn = (new IsLoggedIn())->show;
    $this->dateTimeParagraph = (new DateTimeParagraph())->show;

    $this->maincontent = (new $maincontent(...$this->args))->show;

    if(isset($_SESSION["username"])){
      $this->navlink = (new Navigationlink("loggedIn"))->show;

    } else if(in_array("register", array_keys($_GET))){
      $this->navlink = (new Navigationlink("register"))->show;

    } else {
      $this->navlink = (new Navigationlink("default"))->show;
    }
  }

  public function render() {
    echo "<!DOCTYPE html>
      <html>
        <head>
          <meta charset='utf-8'>
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          {$this->navlink}
          {$this->isLoggedIn}

          <div class='container'>
            {$this->maincontent}
            {$this->dateTimeParagraph}
          </div>
         </body>
      </html>
    ";
  }
}
