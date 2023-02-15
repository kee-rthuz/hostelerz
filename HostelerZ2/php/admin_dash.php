<?php
 $page="addstud";
 function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
 if($_SERVER["REQUEST_METHOD"] == "GET")
 {
     if(isset($_GET["logout"]))
     {
         session_unset();
         session_destroy();
         header("Location: ./register.php");
     }
     if(isset($_GET["addstud"]))
     {
        $page="addstud";
     }
     if(isset($_GET["viewstud"]))
     {
         $page="viewstud";
     }
     if(isset($_GET["viewrooms"]))
     {
         $page="viewrooms";
     }
     if(isset($_GET["remove"]))
     {
         $stud_id = $_GET["stud_id"];
         $stmt = "DELETE FROM `students` WHERE `id` = $stud_id";
         if($conn->query($stmt) === TRUE)
         {
             echo "<script>alert('Student Removed Successfully');</script>";
         }
     }
 }
 $name = $nameerr = $email=$emailerr=$pname=$pnameerr=$pphone=$pphoneerr="";
 $sphone=$sphoneerr=$address=$addresserr=$wc=$wcerr=$error=$room="";
 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
     if(isset($_POST["add_student"]))
     {
         if(empty($_POST["name"]))
         {
             $nameerr = "*Required";
         }
         else{
             $name = test_input($_POST["name"]);
         }
         if(empty($_POST["email"]))
         {
             $emailerr="*Required";
         }
         else
         {
             $email=test_input($_POST["email"]);
             if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailerr = "Invalid email format";
              }
         }
         if(empty($_POST["p_name"]))
         {
             $pnameerr = "*Required";
         }
         else
         {
             $pname = test_input($_POST["p_name"]);
         }
         if(empty($_POST["p_phone"]))
         {
             $pphoneerr = "*Required";
         }
         else
         {
             $pphone = test_input($_POST["p_phone"]);
         }
         if(empty($_POST["s_phone"]))
         {
             $sphoneerr = "*Required";
         }
         else{
             $sphone = test_input($_POST["s_phone"]);
         }
         if(empty($_POST["address"]))
         {
             $addresserr = "*Required";
         }
         else{
             $address = test_input($_POST["address"]);
         }
         if(empty($_POST["w_c_name"]))
         {
             $wcerr = "*Required";
         }
         else{
             $wc=test_input($_POST["w_c_name"]);
         }
         if(isset($_POST["rooms"]))
         {
            $room = $_POST["rooms"];
         }
         
         if($nameerr || $emailerr || $pnameerr || $pphoneerr || $sphoneerr || $addresserr || $wcerr)
         {
             $error = true;
         }
         else
         {
             $error = false;
         }
         if($error == false)
         {
             $hid = $_SESSION["hid"];
             $stmt = "INSERT INTO `students`(`hid`, `name`, `email`, `parent_name`, `parent_phone`, `student_phone`, `address`, `work_or_college`,`room_no`) VALUES ($hid,'$name','$email','$pname',$pphone,$sphone,'$address','$wc',$room)";
             if($conn->query($stmt) === TRUE)
             {
                 echo "<script>alert('Student added succesfully');</script>";
             }

         }
     }
 }
?>