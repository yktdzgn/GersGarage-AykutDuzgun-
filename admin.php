

<!-- This creates the application's admin main page.
This page includes all the users that have made appointments and 
it allows the admin to make updates on the employee taking care of a car, the status of 
the vehicle and the the final price. -->

<!DOCTYPE html>
<html>
<head>
<title>Admin Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>


<script>


//this function transferes the row number of the data that needs to be updated by cheching the
//the row that the price button clicked belongs to 
    $(document).ready(function(){
        $("button[name = 'price']").click(function(){
            // alert("worked");
            var $tr = $(this).closest('tr');
            var row = $("#myTable tr").index($tr);
            var  row = $(".row_"+row).val();
            window.location.href='price.php?row=' + row;
        });
    });

//this function transferes the row number of the data that needs to be updated by cheching the
//the row that the employee button clicked belongs to 
    $(document).ready(function(){
        $("button[name = 'emp']").click(function(){
            var $tr = $(this).closest('tr');
            var row = $("#myTable tr").index($tr);
            var  row = $(".row_"+row).val();
             
            window.location.href='employee_choice.php?row=' + row;
        });
    });


//this function transferes the row number of the data that needs to be updated by cheching the
//the row that the status button clicked belongs to 
    $(document).ready(function(){
        $("button[name = 'stat']").click(function(){
            var $tr = $(this).closest('tr');
            var row = $("#myTable tr").index($tr);
            var row = $(".row_"+row).val();
            window.location.href='status.php?row=' + row;
        });
    });

    //this function transferes the row number of the data that needs to be updated by cheching the
//the row that the status button clicked belongs to 
$(document).ready(function(){
        $("button[name = 'bill']").click(function(){
            var $tr = $(this).closest('tr');
            var row = $("#myTable tr").index($tr);
             var row = $(".row_"+row).val();
            window.location.href='bill.php?row=' + row;
        });
    });


</script>
</head>
<body>
<!-- this is the menu -->
<!-- Top menu header -->
<nav class="navbar navbar-expand-lg navbar-light bg-light text-right topnav " id="">
  <a class="navbar-brand" href="index.php"><strong>Ger's Garage</strong></a>
  <!-- Start This button only visiable on mobile screen -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- End This button only visiable on mobile screen -->

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home </a>
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
  
  <section class="main-section">
  <div class="container">
     <div class="row">
       <div class="col-12">
      <h1> Ger's Garage</h1>
      <!-- This is banner image  -->
      <div class="techn_img">
        <img src="assets/image/technician.jpg" class="img-fluid w-80 rounded" alt="Responsive image" >
      </div>
      </div>
     </div>
    </div>


<!-- This displays all the data from all customers along with the employee assigned, 
status and price
Another column has 3 buttons each allowing to update the price, employee ans status -->
    <!-- Start : Mange Appointments -->
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="your_appointment mt-5">
             <h2 class="text-center text-capitalize">Manage appointment</h2>
             <!-- Database Connection -->
                <?php
                $dbhandle = mysqli_connect("localhost", "root","") or die (mysql_error());
                mysqli_select_db($dbhandle, "reg") or die (mysql_error());
                ?>

              <!-- Start : table Of Mange appiontment -->
              <form action = "admin.php" method="post" >
                <table class="table table-sm able-bordered table-responsive w-100 mt-5"  id="myTable">
                  <thead>
                    <tr> 
                      <th class="text-center">Customer</th>
                      <th class="text-center">Appointment type</th>
                      <th class="text-center">Appointment date</th>
                      <th class="text-center">Tel. number</th>
                      <th class="text-center">Vehicle type</td>
                      <th class="text-center">Vehicle make</th>
                      <th class="text-center">Vehicle license number</th>
                      <th class="text-center">Engine type</th>
                      <th class="text-center">Further comments</th>
                      <th class="text-center">Employee</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Price</th>
                      <th class="text-center">Update</th>
                    </tr>
                  </thead>
                  <tbody>
    
<!-- Here the name, appointment type, application date, phone, vehicle type and name, 
license number, engine, further comments, current employee, status and price are retrieved from the database for each user and
show in a table.  -->
    <?php // Query for Select data from appointment 
        $query = "select row, name, appointment_type, app_date, phone, vehicle_type , vehicle_make, vehicle_license_nr, engine, further_comments, employee, status, price from appointment join user where user.email = appointment.email order by row ASC ";
        $result = mysqli_query($dbhandle, $query) or die( mysqli_error($dbhandle));
        $ctr=1;
        while ($value = mysqli_fetch_assoc($result)) {
            //foreach ($row as $value) { 

                if (!empty($value) && $value != ''){ ?>
                    <tr <?php //echo $value['row'];?>>
                        <td class="text-center"><?php echo $value['name']; ?></td>
                        <td class="text-center"><?php echo $value['appointment_type']; ?></td>
                        <td class="text-center"><?php echo $value['app_date']; ?></td>
                        <td class="text-center"><?php echo $value['phone']; ?></td>
                        <td class="text-center"><?php echo $value['vehicle_type']; ?></td>
                        <td class="text-center"><?php echo $value['vehicle_make']; ?></td>
                        <td class="text-center"><?php echo $value['vehicle_license_nr']; ?></td>
                        <td class="text-center"><?php echo $value['engine']; ?></td>
                        <td class="text-center"><?php echo $value['further_comments']; ?></td>
                        <td class="text-center"><?php echo $value['employee']; ?></td>
                        <td class="text-center"><?php echo $value['status']; ?></td>
                        <td class="text-center"><?php echo $value['price']; ?></td>
                        <td class="text-center">
                          <input type="hidden" name="row_<?php echo $ctr;?>" class="row_<?php echo $ctr;?>"  value="<?php echo  $value['row'];?>">
                          
                        <button type = "button" class="btn btn-success btn-sm" name = "emp">Update employee</button>
                        <button type = "button" class="btn btn-info btn-sm" name="stat" id = "stat">Update status</button>
                        <button type= "button" class="btn btn-success btn-sm" name = "price" id = "price">Update price</button>
                        <button type= "button" class="btn btn-success btn-sm" name = "bill" id = "bill">Print bill</button>
                        </td>
                    </tr>
               <?php  }
                else{ ?>
                  <tr ><td class="text-center text-danger w-100" >No records Found.</td></tr>
                    <!-- echo "<td style = color:red;>" .'select' . "</td>"; -->
                <?php }
                $ctr++;
                 //}       
            } ?>
       </table>
      </form>
     </div>
    </div>
   </div>
</div>
<!-- End: Mange Appointments -->
</section>
</body>
</html> 



















