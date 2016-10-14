<?php

// INVLUDE PARTIALS
require_once('partials/DateTimeParagraph.php');
require_once('partials/IsLoggedIn.php');
require_once('partials/Navigationlink.php');

require_once('partials/Loginform.php');
require_once('partials/Logoutform.php');
require_once('partials/Registrationform.php');

class Layout {

  private $navlink;
  private $isLoggedIn;
  private $maincontent;
  private $dateTimeParagraph;

  public function __construct($partial){
    $this->isLoggedIn = (new IsLoggedIn())->show();
    $this->navlink = (new Navigationlink(get_class($partial)))->show();
    $this->dateTimeParagraph = (new DateTimeParagraph())->show();
    $this->maincontent = $partial->show();
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
