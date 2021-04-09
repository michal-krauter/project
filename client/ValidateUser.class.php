<?php
/**
 * @file
 * class ValidateUser
 *
 * @author Michal Krauter <michal.krauter@seznam.cz>
 */

class ValidateUser {
  private $name;
  private $password;
  private $email;

  function __construct() {
    $this->name = isset($_POST['name']) ? $_POST['name'] : null;
    $this->password = isset($_POST['password']) ? $_POST['password'] : null;
    $this->email = isset($_POST['email']) ? $_POST['email'] : null;
  }

  function validate() {
    $errors = array();
    if (empty($this->name) || empty($this->password) || empty($this->email)) {
      $errors['name'] = 'Jméno, heslo nebo email není validní.';
    }
    else if (!empty($this->email) && !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = 'E-mail není validní.';
    }  
    return $errors;      
  }
}

?>