<?php
class User
{
  private $database;

  public function __construct()
  {
    $this->database = new Database;
  }

  // Regsiter user
  public function register($data)
  {
    $this->database->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
    // Bind values
    $this->database->bind(':name', $data['name']);
    $this->database->bind(':email', $data['email']);
    $this->database->bind(':password', $data['password']);
    // Execute
    if ($this->database->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Login User
  public function login($email, $password)
  {
    $this->database->query('SELECT * FROM users WHERE email = :email');
    $this->database->bind(':email', $email);

    $row = $this->database->single();

    $hashed_password = $row->password;
    if (password_verify($password, $hashed_password)) {
      return $row;
    } else {
      return false;
    }
  }

  // Find user by email
  public function findUserByEmail($email)
  {
    $this->database->query('SELECT * FROM users WHERE email = :email');
    // Bind value
    $this->database->bind(':email', $email);

    $row = $this->database->single();

    // Check row
    if ($this->database->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  //Get user by ID
  public function findUsersByName($name)
  {

    $this->database->query('SELECT * FROM users WHERE name = :name');
    //Bind value
    $this->database->bind(':name', $name);

    $row = $this->database->single();

    //check row
    if ($this->database->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  //Get user by ID
  public function getUserById($id)
  {
    $this->database->query('SELECT * FROM users WHERE id = :id');
    $this->database->bind(':id', $id);

    $row = $this->database->single();

    //check row
    return $row;
  }
}
