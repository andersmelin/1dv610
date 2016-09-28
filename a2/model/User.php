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

  public function get($username){
    $query = "SELECT username, password, cookiepassword FROM users WHERE username = '{$username}'";
    $result = $this->db->query($query);

    $user = [];

    while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
      $user[] = [
        'username' => $row['username'],
        'password' => $row['password'],
        'cookiepassword' => $row['cookiepassword']
      ];
    }

    //echo '<pre>'; var_dump($user[0]); echo '</pre>';
    return (count($user)) ? $user[0] : false;;

  }

  private function createNewTableIfNotExists(){
    $createTableIfNotExists = "CREATE TABLE IF NOT EXISTS users (
      username VARCHAR (255) NOT NULL,
      password VARCHAR (255) NOT NULL,
      cookiepassword VARCHAR (255)
    )";

    $this->db->exec($createTableIfNotExists);
  }

  public function create($username, $password){
    $password = password_hash($password, PASSWORD_BCRYPT);
    $addNewUser = "INSERT INTO users(username, password, cookiepassword) VALUES('{$username}', '{$password}', null)";
    $this->db->exec($addNewUser);
  }

  public function exists($username){
    return !!$this->get($username);
  }

  public function authenticate($username, $password){
    $user = $this->get($username);
    return !!password_verify($password, $user['password']);
  }

  public function authenticateUsingCookies($username, $cookiePassword){
    $user = $this->get($username);
    return $cookiePassword == $user->cookiepassword;
  }
}
