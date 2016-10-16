<?php

class SessionStatus {

  public function __construct() {
    $this->isLoggedIn = (isset($_SESSION['username']) && !empty($_SESSION['username']));
  }

  public function logOut() {
    unset($_SESSION['username']);
    session_destroy();
  }

  public function logIn($username) {
    $_SESSION['username'] = $username;
  }

  public function isLoggedIn() {
    return (isset($_SESSION['username']) && !empty($_SESSION['username']));
  }
}
