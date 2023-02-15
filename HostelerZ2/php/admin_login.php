<?php
$error=$email=$emailerr=$password=$passworderr="";
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_POST["login"]))
    {
        if(empty($_POST["email"]))
        {
            $emailerr = "*Required";
        }
        else
        {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailerr = "Invalid email format";
                $error = true;
              }
            else{
                $error = false;
            }  
        }
        if($email)
        {
            $stmt = "SELECT * FROM `admin` WHERE `email`='$email'";
            $result=$conn->query($stmt);
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    if($email == $row["email"])
                    {
                        $error = false;
                    }
                }
            }
            else
            {
                $emailerr="User not registered please signup";
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
            $error = false;
        }

        if($password)
        {
            $stmt = "SELECT * FROM `admin` WHERE `email`='$email'";
            $result=$conn->query($stmt);
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    if($password != $row["password"])
                    {
                        $passworderr = "Password Incorrect";
                        $error = true;
                    }
                    else{
                        $error=false;
                    }
                }
            }

        }

        if($emailerr || $passworderr)
        {
            $error = true;
        }
    }
    if($error == false)
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
?>