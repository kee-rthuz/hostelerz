<?php
 session_start();
 if(!isset($_SESSION["email"]) && !isset($_SESSION["pass"]))
 {
    header("Location: ./register.php");
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
    <title>Admin|Dash</title>
    <style>
        body{
            background-color: #6c757d;
        }
    </style>
</head>
<?php
 require('./php/connection.php');
 require('./php/admin_dash.php');
 ?>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand brand" href="./index.php" style="font-size: 1.5rem;">HostelerZ</a>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get">
            <input type="submit" name="logout" class="btn btn-danger logout" value="LOGOUT">
        </form>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-3 bg-secondary" style="height: 100vh;">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get">
                    <ul class="left-list mt-5">
                        <li class="text-white">
                            <input type="submit" class="btn text-white bt" value="Add Student" name="addstud">
                        </li>
                        <li class="text-white">
                            <input type="submit" class="btn text-white bt" value="View Student" name="viewstud">
                        </li>
                        <li class="text-white">
                            <input type="submit" class="btn text-white bt" value="Rooms" name="viewrooms">
                        </li>
                    </ul>
                </form>
            
            </div>
            <div class="col col-md-9 rounded bg-white">
                <?php
                 if($page == "addstud")
                 {
                ?>
                  <div class="container">
                      <h1>Add Student</h1>
                      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                          <div class="form-group">
                              <label for="name" >Student Name</label>
                              <input type="text" name = "name" id="name" class="form-control">
                              <?php echo "<div class='err'>$nameerr</div>" ?>
                          </div>
                          <div class="form-group">
                            <label for="email" >Student Email</label>
                            <input type="email" name = "email" id="email" class="form-control">
                            <?php echo "<div class='err'>$emailerr</div>" ?>
                        </div>
                        <div class="form-group">
                            <label for="p_name" >Parent Name</label>
                            <input type="text" name = "p_name" id="p_name" class="form-control">
                            <?php echo "<div class='err'>$pnameerr</div>" ?>
                        </div>
                        <div class="form-group">
                            <label for="p_phone" >Parent Phone</label>
                            <input type="number" name = "p_phone" id="p_phone" class="form-control">
                            <?php echo "<div class='err'>$pphoneerr</div>" ?>
                        </div>
                        <div class="form-group">
                            <label for="s_phone" >Student Phone</label>
                            <input type="number" name = "s_phone" id="s_phone" class="form-control">
                            <?php echo "<div class='err'>$sphoneerr</div>" ?>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                            <?php echo "<div class='err'>$addresserr</div>" ?>
                          </div>
                        <div class="form-group">
                            <label for="w_c_name" >Current Work/College Name And Place</label>
                            <input type="text" name = "w_c_name" id="w_c_name" class="form-control">
                            <?php echo "<div class='err'>$wcerr</div>" ?>
                        </div>  
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="rooms">Available Rooms</label>
                            </div>
                            <select class="custom-select" id="rooms" name="rooms">
                            <?php
                             $hid=$_SESSION["hid"];
                             $roomfull = array();
                             $roomsfull = false;
                             $stmt = "SELECT `total_rooms` FROM `admin` WHERE `id` = $hid";
                             $result=$conn->query($stmt);
                             if($result->num_rows >0 )
                             {
                                 while($row = $result->fetch_assoc())
                                 {
                                     $total_room = $row["total_rooms"];
                                 }
                             }

                             for($i=1; $i <= $total_room; $i++)
                             {
                                 $stmt = "SELECT * FROM `students` WHERE `room_no` = $i AND `hid` = $hid";
                                 $result=$conn->query($stmt);
                                 $num = $result->num_rows;
                                 if($result->num_rows <= 0)
                                 {
                                     echo "<option value='$i'>Room No: $i ($num student occupied)  </option>";
                                 }
                                if($result->num_rows > 0)
                                {
                                   if($result->num_rows < $_SESSION["occu"])
                                   {
                                    echo "<option value=' $i'>Room No:  $i ($num student occupied)  </option>";

                                   }
                                   else
                                   {
                                       echo "<option value='$i' disabled>  $i Room Full</option>";
                                       array_push($roomfull,$i);
                                   }
                                   
                                }
                             }
                             if(count($roomfull) == $total_room)
                             {
                                 $roomsfull = true;
                             }
                            ?>
                            </select>
                          </div>
                          <p class="lead text-danger"><?php echo $_SESSION["occu"]; ?> Person in One room</p>
                          
                        <?php if($roomsfull == false) { ?>
                        <button type="submit" class="btn btn-primary mb-3 px-4" name="add_student">Add Student</button>
                        <?php } ?>
                        <?php if($roomsfull == true){ ?>
                            <button type="submit" class="btn btn-primary mb-3 px-4 btn-hov" name="add_student" disabled style="cursor: not-allowed !important;">Add Student</button>
                            <p class="lead text-danger">*Rooms Full</p>
                        <?php } ?>    
                      </form>
                  </div>         
                <?php
                 }
                 if($page == "viewstud")
                 {
                ?>
                  <div class="container">
                      <h2>View Students</h2>
                      <table class="table table-hover">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Student Name</th>
                            <th scope="col">Student Email</th>
                            <th scope="col">Parent Name</th>
                            <th scope="col">Parent Phone</th>
                            <th scope="col">Student Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Work Or College</th>
                            <th scope="col">Room Number</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                           $stud_array = array();
                           $hid = $_SESSION["hid"];
                           $stmt = "SELECT * FROM `students` WHERE `hid` = $hid";
                           $result = $conn->query($stmt);
                           if($result->num_rows > 0)
                           {
                               while($row = $result->fetch_assoc())
                               {
                                   array_push($stud_array,$row);
                               }
                           }
                          ?> 
                          <?php
                           foreach($stud_array as $stud)
                           {
                          ?>
                          <tr>
                            <td><?php echo $stud["name"]; ?></td>
                            <td><?php echo $stud["email"]; ?></td>
                            <td><?php echo $stud["parent_name"]; ?></td>
                            <td><?php echo $stud["parent_phone"]; ?></td>
                            <td><?php echo $stud["student_phone"]; ?></td>
                            <td><?php echo $stud["address"]; ?></td>
                            <td><?php echo $stud["work_or_college"]; ?></td>
                            <td><?php echo $stud["room_no"]; ?></td>
                            <td>
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get">
                                  <input type="text" name="stud_id" value="<?php echo $stud['id']; ?>" style="display: none;">  
                                  <input type="submit" name="remove" class="btn btn-danger" value="Remove Student">
                                </form>
                            </td>
                          </tr>
                          <?php
                           }
                          ?>
                        </tbody>
                      </table>
                      
                  </div>
                <?php
                 }
                 if($page == "viewrooms")
                 {
                ?>
                   <div class="container">
                       <table class="table table-hover">
                           <thead class="thead-dark">
                               <tr>
                                   <th scope="col">Room Number</th>
                                   <th scope="col">Total no of students can occupy</th>
                                   <th scope="col">current Student count</th>
                                   <th scope="col">Room Status</th>
                               </tr>
                            </thead>   
                            <tbody>
                                <?php
                                $hid=$_SESSION["hid"];
                                $roomfull = array();
                                $roomsfull = false;
                                $stmt = "SELECT `total_rooms` FROM `admin` WHERE `id` = $hid";
                                $result=$conn->query($stmt);
                                if($result->num_rows >0 )
                                {
                                    while($row = $result->fetch_assoc())
                                    {
                                        $total_room = $row["total_rooms"];
                                    }
                                }
                                ?>
                                <?php
                                $roomsArray = array();
                                 for($i=1; $i <= $total_room; $i++)
                                 {
                                    $stmt = "SELECT * FROM `students` WHERE `room_no` = $i AND `hid` = $hid";
                                    $result=$conn->query($stmt);
                                    $num = $result->num_rows;
                                    if($num <= 0)
                                    {
                                        $key = "$i";
                                        $roomsArray[$key] = array(0,"Available");
                                    }
                                    if($result->num_rows > 0)
                                    {
                                        if($result->num_rows < $_SESSION["occu"])
                                        {
                                            $key = "$i";
                                            $roomsArray[$key] = array($num,"Available");
                                        }
                                        else
                                        {
                                            $key = "$i";
                                            $roomsArray[$key] = array($num,"Full");
                                        }
                                    }

                                 }
                                 
                                ?>
                               <?php
                                foreach($roomsArray as $key=>$value)
                                {
                               ?>
                               <tr>
                                   <td><?php echo $key; ?></td>
                                   <td><?php echo $_SESSION["occu"]; ?></td>
                                   <td><?php echo $value[0]; ?></td>
                                   <?php
                                    if($value[1] == "Available")
                                    {
                                   ?>
                                   <td class="text-success">Available</td>
                                   <?php
                                    }
                                   ?>
                                   <?php
                                    if($value[1] == "Full")
                                    {
                                   ?>
                                   <td class="text-danger">Full</td>
                                   <?php
                                    }
                                   ?>
                                   
                                   
                               </tr>
                               <?php
                                }
                                ?>
                               
                            </tbody>
                       </table>
                   </div>
                <?php
                 }
                ?>

            </div>
        </div>
    </div>
</body>
</html>