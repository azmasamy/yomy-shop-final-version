<?php $selected = "home";?>
<?php require_once('../../private/initialize.php'); ?>
<?php require_once(INCLUDES_PATH.'/admin_header.php'); ?>
<div class="container">
  <h3>Welcome to Yomyshop admin panel</h3>

<?php
  if($session->is_logged_in())
    echo "Loggedin, ". "<a href='logout.php'> logout </a>";
    else {
      echo "Login, ". "<a href='login.php'> login </a>";
    }
 ?>


</div>
