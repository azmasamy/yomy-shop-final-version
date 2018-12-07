<?php

class Admin {
  static protected $database;

  static public function set_database($database) {
    self::$database = $database;
  }

  public function find_by_sql($sql)
  {
    $admins_array = array();
    $result = self::$database->query($sql);
    if(!$result) {
      exit("Database query failed.");
    }
    while ($record = $result->fetch_assoc()) {
      $admins_array[] =  self::instantiate($record);
    }
    return $admins_array;
  }
  public function create()
  {
    //print_r($this);
    $sql  ="INSERT INTO admin(" ;
    $sql .=" first_name, last_name, email, username, hashed_password";
    $sql .=" ) VALUES ( ";
    $sql .="'" . $this->first_name ."',";
    $sql .="'" . $this->last_name ."',";
    $sql .="'" . $this->email ."',";
    $sql .="'" . $this->username ."',";
    $sql .="'" . $this->hashed_password ."'";
    $sql .=");";

    echo $sql;

    $result = self::$database->query($sql);
    if($result){
      $this->id = self::$database->insert_id;
    }
    return $result;
  }

  public function find_all()
  {
    $sql = "Select * from admin";
    $admin_array = self::find_by_sql($sql);

    return $admin_array;
  }
  public function find_by_id($id)
  {
    $cat_array = [];
    $sql = "SELECT * FROM admin WHERE id = {$id}";
    $cat_array = self::find_by_sql($sql);
    return array_shift($cat_array);
  }

  public function instantiate($value)
  {
    $obj = new self();
    $obj->id = $value ['id'];
    $obj->first_name = $value ['first_name'];
    $obj->last_name = $value ['last_name'];
    $obj->email = $value ['email'];
    $obj->username = $value ['username'];
    $obj->hashed_password = $value ['hashed_password'];

    return $obj;
  }


  public $id; //DO IT PRIVATE AND USE GET & SET
  private $first_name;
  private $last_name;
  private $email;
  private $username;
  private $hashed_password;
  //private $password;
  //private $confirm_password;


  public function __construct($args=[]) {
    $this->first_name = $args['first_name'] ?? '';
    $this->last_name = $args['last_name'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->username = $args['username'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->hashed_password = $args['hashed_password'] ?? '';
    //var_dump($this);
  }


  static public function find_by_username($username) {
      $sql = "SELECT * FROM admin ";
      $sql .= "WHERE username='" . self::$database->escape_string($username) . "'";
      $obj_array = self::find_by_sql($sql);
      //print_r($obj_array); exit();
      if(!empty($obj_array)) {
        return array_shift($obj_array);
      } else {
        return false;
      }
    }

public function verify_password($password) {
    return password_verify($password, $this->hashed_password);
  }
  public function full_name() {
    return $this->first_name . " " . $this->last_name;
  }

}

?>
