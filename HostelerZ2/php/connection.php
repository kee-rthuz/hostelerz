<?php
 $conn = new mysqli("localhost","hosteladmin","hosteladmin123","hostelmanage",3307);
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>