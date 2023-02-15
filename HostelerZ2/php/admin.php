<?php
$emailerr=$passworderr=$rpassworderr=$nameerr=$phoneerr=$rooms=$roomserr="";
$email=$password=$rpassword=$name=$phone=$passerr=$error=$occuerr=$occu = "";
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
  
   if($_SERVER["REQUEST_METHOD"] == "POST")
   {
       if(isset($_POST["signup"]))
       {
           if(empty($_POST["email"]))
           {
               $emailerr = "*Required";
               $error = true;
           }
           else
           {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $emailerr = "Invalid email format";
              $error = true;
            }
            $stmt = "SELECT * FROM `admin` WHERE `email` = '$email'";
            $result = $conn->query($stmt);
            if($result->num_rows > 0)
            {
                $emailerr = "Email Already Taken Try Deffierent Email";
                $error = true;
            }
           }
           if(empty($_POST["password"]))
           {
               $passworderr = "*Required";
               $error = true;
           }
           else
           {
               $password = test_input($_POST["password"]);
           }
           if(empty($_POST["r_password"]))
           {
               $rpassworderr = "*Required";
               $error = true;
           }
           else
           {
               $rpassword = test_input($_POST["r_password"]);
           }
           if(empty($_POST["occu"]))
           {
               $occuerr = "*Required";
               $error = true;
           }
           else
           {
               $occu = test_input($_POST["occu"]);
           }
           if(empty($_POST["rooms"]))
           {
               $roomserr = "*Required";
               $error = true;
           }
           else
           {
               $rooms = test_input($_POST["rooms"]);
           }
           if(empty($_POST["name"]))
           {
               $nameerr = "*Required";
               $error = true;
           }
           else
           {
               $name = test_input($_POST["name"]);
           }
           if(empty($_POST["phone"]))
           {
               $phoneerr = "*Required";
               $error = true;
           }
           else
           {
               $phone = test_input($_POST["phone"]);
           }
           if($password != $rpassword)
           {
               $passerr = "Pasword not Matched";
               $error = true;
           }
           if($error != true)
           {
               $stmt = "INSERT INTO `admin`( `name`, `email`, `password`, `phone`,`total_rooms`,`st_num`) VALUES ('$name','$email','$password',$phone,$rooms,$occu)";
               if($conn->query($stmt) === TRUE)
               {
                $stmt = "SELECT * FROM `admin` WHERE `email`='$email'";
                $result=$conn->query($stmt);
                if($result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc())
                    {
                        $_SESSION["hid"] = $row["id"];
                        $_SESSION["occu"] = $row["st_num"];
                    }
                }   
                $_SESSION["email"] = $email;
                $_SESSION["pass"] = $password;
                header("Location: ./dash.php");
               }
               
           }
       }
   }

?>