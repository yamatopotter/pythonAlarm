<?php
  $host = $_SERVER['HTTP_HOST'];

  $cn = mysqli_connect("db","root","12345678","alarm");

  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }
?>