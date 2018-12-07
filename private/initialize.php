<?php
  define("PRIVATE_PATH", dirname(__FILE__));
  define("PROJECT_PATH", dirname(PRIVATE_PATH));
  define("PUBLIC_PATH", PROJECT_PATH . '/public');
  define("IMAGES_PATH", PROJECT_PATH . '/public/img');
  define("INCLUDES_PATH", PRIVATE_PATH . '/includes');

  $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
  $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
  define("WWW_ROOT", $doc_root);

  require_once("functions.php");
  require_once("models/MenuItem.class.php");
  require_once("database_functions.php");
  require_once("models/Category.class.php");
  require_once("models/Admin.class.php");
  require_once("models/Session.class.php");


  function is_post_request() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
  }

  function is_get_request() {
    return $_SERVER['REQUEST_METHOD'] == 'GET';
  }



  $session = new Session();

  $db = db_connect();
  Category::set_database($db);
  Admin::set_database($db);

?>
