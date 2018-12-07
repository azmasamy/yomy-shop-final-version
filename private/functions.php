<?php

function is_blank($value) {
   return !isset($value) || trim($value) === '';
 }
 function redirect_to($location) {
  header("Location: " . $location);
  exit;
}
 ?>
