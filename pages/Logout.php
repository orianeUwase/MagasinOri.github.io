<?php
   session_unset();
  
   echo 'You have cleaned session';
   header('Refresh: 1; URL = index.php');
?>