<?php

class Connection {

  private $pdo;

  public function connect() {
    if ($this->pdo == null) {
      $this->pdo = new \PDO("sqlite:model/db/1dv610.db");
    }

    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $this->pdo;
  }
}
