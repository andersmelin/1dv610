<?php

require_once("db/Connection.php");

class User{

  private $db;

  public function __construct(){
    $this->db = (new Connection())->connect();

    if (!$this->db){
      throw new Exception("Database connection exception");
    }

    $this->createNewTableIfNotExists();
  }

  private function createNewTableIfNotExists(){
    $query = "CREATE TABLE IF NOT EXISTS users (
      username VARCHAR (255) NOT NULL,
      password VARCHAR (255) NOT NULL,
      cookiepassword VARCHAR (255)
    )";

    $this->db->exec($query);
  }

  /*
  ================
     PUBLIC API
  ================
  */
  public function get($username){
    $query = "SELECT username, password, cookiepassword FROM users WHERE username = '{$username}'";
    $result = $this->db->query($query);

    $user = [];

    // TODO: Remove while loop by examine the result and be straight to the point
    while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
      $user[] = [
        'username' => $row['username'],
        'password' => $row['password'],
        'cookiepassword' => $row['cookiepassword']
      ];
    }

    return (count($user)) ? $user[0] : false;
  }

  public function create($username, $password, $passwordRepeat){
    $this->validateRegistrationData($username, $password, $passwordRepeat);
    $password = password_hash($password, PASSWORD_BCRYPT);
    // TODO: Implement prepared statements instead
    $query = "INSERT INTO users(username, password, cookiepassword) VALUES('{$username}', '{$password}', null)";
    $this->db->exec($query);
  }

  public function authenticate($username, $password){
    $this->validateLoginData($username, $password);
    $user = $this->get($username);

    if(!$user || !password_verify($password, $user['password'])){
      throw new Exception("Wrong name or password");
    }

    return true;
  }

  /*
  ========================================
    DATA VALIDATION CONVENIENCE METHODS
  ========================================
  */
  private function validateLoginData($username, $password) {
    return (
      $this->usernameProvided($username) &&
      $this->passwordProvided($password)
    );
  }

  private function validateRegistrationData($username, $password, $passwordRepeat){
    return (
      $this->validateCharsInUsername($username) &&
      $this->validateUsernameAndPasswordLength($username, $password) &&
      $this->passwordEqualsPasswordRepeat($password, $passwordRepeat) &&
      !$this->exists($username)
    );
  }

  /*
  =================================
    DATA VALIDATION CORE METHODS
  =================================
  */
  private function usernameProvided($username) {
    if(!isset($username) || empty($username)) {
      throw new Exception("Username is missing");
    }

    return true;
  }

  private function passwordProvided($password) {
    if(!isset($password) || empty($password)) {
      throw new Exception("Password is missing");
    }

    return true;
  }

  private function exists($username){
    if(!!$this->get($username)) {
      throw new Exception("User exists, pick another username.");
    }

    return true;
  }

  private function validateUsernameAndPasswordLength($username, $password){
    if(mb_strlen($username, "utf8") <= 2 || mb_strlen($password, "utf8") <= 5){
      $usernameShort = (mb_strlen($username, "utf8") > 2) ? "" : "Username has too few characters, at least 3 characters. ";
      $passwordShort = (mb_strlen($password, "utf8") > 5) ? "" : "Password has too few characters, at least 6 characters.";

      throw new Exception(trim($usernameShort . $passwordShort));
    }

    return true;
  }

  private function validateCharsInUsername($username){
    if($username !== strip_tags($username)){
      throw new Exception("Username contains invalid characters.");
    }

    return true;
  }

  private function passwordEqualsPasswordRepeat($password, $passwordRepeat){
    if($password !== $passwordRepeat){
      throw new Exception("Passwords do not match.");
    }

    return true;
  }
}
