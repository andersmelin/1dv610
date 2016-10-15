<?php

require_once("db/Connection.php");

class User{

  private $db;

  private $username;
  private $password;
  private $passwordRepeat;

  public function __construct($username = "", $password = "", $passwordRepeat = ""){

    $this->username = $username;
    $this->password = $password;
    $this->passwordRepeat = $passwordRepeat;

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
  public function get(){
    $query = "SELECT username, password, cookiepassword FROM users WHERE username = '{$this->username}'";
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

  public function create(){
    $this->validateRegistrationData($this->username, $this->password, $this->passwordRepeat);
    $password = password_hash($this->password, PASSWORD_BCRYPT);
    // TODO: Implement prepared statements instead
    $addNewUser = "INSERT INTO users(username, password, cookiepassword) VALUES('{$username}', '{$password}', null)";
    $this->db->exec($addNewUser);
  }

  public function authenticate(){
    $this->validateLoginData($this->username, $this->password);
    $user = $this->get($this->username);
    // TODO: try-catch of password_verify
    return !!password_verify($this->password, $this->user['password']);
  }

  /*
  ========================================
    DATA VALIDATION CONVENIENCE METHODS
  ========================================
  */
  private function validateLoginData() {
    return (
      $this->usernameProvided() &&
      $this->passwordProvided() &&
      $this->authenticateUser()
    );
  }

  private function validateRegistrationData(){
    return (
      $this->validateChars() &&
      $this->validateUsernameAndPasswordLength() &&
      $this->passwordEqualsPasswordRepeat() &&
      !$this->exists()
    );
  }

  /*
  =================================
    DATA VALIDATION CORE METHODS
  =================================
  */
  private function usernameProvided() {
    if(!isset($this->username) || empty($this->username)) {
      throw new Exception("Username is missing");
    }

    return true;
  }

  private function passwordProvided() {
    if(!isset($this->password) || empty($this->password)) {
      throw new Exception("Password is missing");
    }

    return true;
  }

  private function authenticateUser() {
    if(!$this->authenticate($this->username, $this->password)) {
      throw new Exception("Wrong name or password");
    }

    return true;
  }

  private function exists(){
    if(!!$this->get($this->username)) {
      throw new Exception("User exists, pick another username.");
    }

    return true;
  }

  private function validateUsernameAndPasswordLength(){
    if(!mb_strlen($this->username, "utf8") > 2 || !mb_strlen($this->password, "utf8") > 5){
      $usernameShort = (!mb_strlen($username, "utf8") > 2) ? "" : "Username has too few characters, at least 3 characters. ";
      $passwordShort = (!mb_strlen($password, "utf8") > 5) ? "" : "Password has too few characters, at least 6 characters.";

      throw new Exception(trim($usernameShort . $passwordShort));
    }

    return true;
  }

  private function validateChars(){
    if($this->username !== strip_tags($this->username) && $this->password !== strip_tags($this->password)){
      throw new Exception("Username contains invalid characters.");
    }

    return true;
  }

  private function passwordEqualsPasswordRepeat(){
    if($this->password !== $this->passwordRepeat){
      throw new Exception("Passwords do not match.");
    }

    return true;
  }
}
