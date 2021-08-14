
<!-- This page will print the bill for the customer 
containing the customers 
names
phone number
vehicle make
licence number 
all items added 
the appointment type and the prices
and the overall price to be paid. -->

<!DOCTYPE html>
<html>
<head>
<title>Bill</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>

<!-- This is the navigation menu for the admin-->
 <!-- This is the Top menu -->
<nav class="navbar navbar-expand-lg navbar-light bg-light text-right  " id="">
  <a class="navbar-brand" href="index.php"><strong>Ger's Garage</strong></a>
  <!-- Start This button only visiable on mobile screen -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- End This button only visiable on mobile screen -->

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="admin.php">Home </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="schedule.php">Daily schedule</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Log out</a>
      </li>
    </ul>
  </div>
</nav>
<div class="clearfix"></div> 
<div class="container">
     <div class="row">
      <div class="col-12">
      <h1> BILL</h1>
      <!-- This is banner image  -->
      <div class="techn_img">
        <img src="assets/image/technician.jpg" class="img-fluid w-80 rounded" alt="Responsive image" >
      </div>
    </div>
   </div>
  </div>
  
      <div class="col-lg-6 col-xs-12 offset-lg-3 my-5">
       <div class="bill">
            <div class="card">
             <div class="card-body">
              <h2 class="text-center">Price</h2>

            
<!-- 
Here the name and all other customer data is taken from the different tables in order to make the 
bill for the customer and calculate the price -->

    <?php

        if(isset($_GET['row'])){
            $row = $_GET['row'];
            $dbhandle = mysqli_connect("localhost", "root","") or die (mysql_error());
            mysqli_select_db($dbhandle, "reg") or die (mysql_error());
            $q = "select name from user join appointment where appointment.row = $row and appointment.email = user.email";
            $q1 = "select phone from appointment where row = $row";
            $q2 = "select vehicle_make from appointment where row = $row";
            $q3 = "select vehicle_license_nr from appointment where row = $row";
            $q5 = "select items from appointment where row = $row";
            $q4 = "select price from appointment where row = $row";
            $q7 = "select appointment_type from appointment where row = $row";

            $res = mysqli_query($dbhandle, $q) or die( mysqli_error($dbhandle));
            $res1 = mysqli_query($dbhandle, $q1) or die( mysqli_error($dbhandle));
            $res2 = mysqli_query($dbhandle, $q2) or die( mysqli_error($dbhandle));
            $res3 = mysqli_query($dbhandle, $q3) or die( mysqli_error($dbhandle));
            $res4 = mysqli_query($dbhandle, $q4) or die( mysqli_error($dbhandle));
            $res5 = mysqli_query($dbhandle, $q5) or die( mysqli_error($dbhandle));
            $res7 = mysqli_query($dbhandle, $q7) or die( mysqli_error($dbhandle));
            while ($r = mysqli_fetch_assoc($res)) {
                foreach($r as $val){
                    while ($r1 = mysqli_fetch_assoc($res1)) {
                        foreach($r1 as $val1){
                            while ($r2 = mysqli_fetch_assoc($res2)) {
                                foreach($r2 as $val2){
                                    while ($r3 = mysqli_fetch_assoc($res3)) {
                                        foreach($r3 as $val3){
                                            echo "Customer:     ";
                                            echo $val;
                                            echo "<br>";
                                            echo "Phone:        ";
                                            echo $val1;
                                            echo "<br>";
                                            echo "Vehicle:      ";
                                            echo $val2;
                                            echo "<br>";
                                            echo "Licence:      ";
                                            echo $val3;
                                            echo "<br>";
                                            while ($r7 = mysqli_fetch_assoc($res7)) {
                                                foreach($r7 as $val7){
                                                    switch ($val7) {
                                                        case 'Annual Service': ?>
                                                           <p><b>Annual Service:</b>  150</p>
                                                       <?php   break;
                                                        case 'major_repair': ?>
                                                           <p><b>Major Repair:</b>   200</p>
                                                       <?php  break;
                                                        case 'major_service': ?>
                                                          <p><b>Major service:</b>   250</p>
                                                        <?php  break;
                                                          case 'repair_fault': ?>
                                                           <p><b>Repair fault:</b>   200</p>
                                                         <?php break;
                                                        default:
                                                         ?> <p>-</p>
                                                    <?php  } 
                                                }
                                                break;
                                            }


                                            while ($r5 = mysqli_fetch_assoc($res5)) {
                                                foreach($r5 as $val5){
                                                    $arr = json_decode($val5);
                                                    if($val5 != ""){
                                                        foreach($arr as $v){
                                                            $q6 = "select price from item where name = '$v'";
                                                            $res6 = mysqli_query($dbhandle, $q6) or die( mysqli_error($dbhandle));
                                                            while ($r6 = mysqli_fetch_assoc($res6)) {
                                                                foreach($r6 as $val6){ ?>
                                                                <p><b><?php echo $v.' :  '; ?></b> <?php echo $val6; ?></p>    
                                                              <?php  }
                                                                break;
                                                            }

                                                        }
                                                    } 
                                                }
                                                break;
                                            }
                                            while ($r4 = mysqli_fetch_assoc($res4)) {
                                                foreach($r4 as $val4){ ?>
                                                    <p><b>Price:</b> <?php echo $val4; ?></p>
                                                   
                                               <?php }
                                                break;
                                            
                                            }
                                            echo "<br><br><br>";
                                            echo "<p>Payment due to collection.</p>";
                                        }
                                        break;
                                    }
                                }
                                break;
                                
                            }
                        } break;
                    }
                }break;
            }
        }
        ?>

        </div>
        </div>
        </div>
      </div>
    </body>
</html> 