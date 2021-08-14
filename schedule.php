
<!-- This page allows the admin to view the daily schedule of any particular day. -->

<!DOCTYPE html>
<html>
<head>
<title>Schedule</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>
<body>
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

    <section class="main-section">
    <div class="row">
     <div class="container">
        
     <div class="clearfix"></div>
     <div class="col-lg-6 col-xs-12 offset-lg-3 my-5">
       <div class="car_status mb-4">
            <div class="card">
            <h1 class="text-center"> Daily schedule</h1>
             <div class="card-body">
              <form action = "schedule.php" method="post" >
                  
    <!-- This allows the admin to choose multiple values and the prices will be added up by js function -->
                  <div class="form-group">
                    <lable for="Pick date:"></lable>
                    <input  type= "date" name = "app_date" class="form-control">
                  </div>
                  <div class="text-center">
                   <input type = "submit" name="submit" class="btn btn-custom " value = "Check"/>
                  </div>
              </form>
             </div>
            </div>
        </div>

    </div>
   

    <!-- View Table data which select from DB -->
    <div class="view_table_data">
    <div class="col-lg-12 col-xs-12  mt-5">
        <!-- This allows the admin to choose multiple values and the prices will be added up by js function -->
     <form action = "schedule.php" method="post" >
       <table class="table table-sm able-bordered table-responsive w-100 mt-5" >
        <thead>
        <tr> 
        <th class="text-center">Customer</th>
        <th class="text-center">Appointment type</th>
        <th class="text-center">Appointment date</th>
        <th class="text-center">Tel. number</th>
        <th class="text-center">Vehicle type</th>
        <th class="text-center">Vehicle make</th>
        <th class="text-center">Vehicle license number</th>
        <th class="text-center">Engine type</th>
        <th class="text-center">Further comments</th>
        <th class="text-center">Employee</th>
        <th class="text-center">Status</th>
        <th class="text-center">Price</th>
        </tr>
       </thead>
       <tbody>
           <!-- The data is retrieved here abour the vehicle and appoitment maker on the day selected by the admin. -->
    <?php
        if (isset($_POST['submit']))
        {
            $date = $_POST['app_date'];
            if($date!=''){
                $query = "select name, appointment_type, app_date, phone, vehicle_type , vehicle_make, vehicle_license_nr, engine, employee, further_comments, status, price from appointment join user where user.email = appointment.email and app_date = '$date'; ";
                $dbhandle = mysqli_connect("localhost", "root","") or die (mysql_error());
                mysqli_select_db($dbhandle, "reg") or die (mysql_error());
                $result = mysqli_query($dbhandle, $query) or die( mysqli_error($dbhandle));
                while ($value = mysqli_fetch_assoc($result)) {
                    
                    // foreach ($row as $value) { 
                        if (!empty($value) && $value != ''){ ?>
                          <tr>
                            <td class="text-center"><?php echo $value['name']; ?></td>
                            <td class="text-center"><?php echo $value['appointment_type']; ?></td>
                            <td class="text-center"><?php echo $value['app_date']; ?></td>
                            <td class="text-center"><?php echo $value['phone']; ?></td>
                            <td class="text-center"><?php echo $value['vehicle_type']; ?></td>
                            <td class="text-center"><?php echo $value['vehicle_make']; ?></td>
                            <td class="text-center"><?php echo $value['vehicle_license_nr']; ?></td>
                            <td class="text-center"><?php echo $value['engine']; ?></td>
                            <td class="text-center"><?php echo $value['further_comments']; ?></td>
                            <td class="text-center"><?php echo $value['status']; ?></td>
                            <td class="text-center"><?php echo $value['price']; ?></td>
                          </tr>
                       <?php }
                        else{?>
                          <tr><td style = color:red;>To be decided</td></tr>
                       <?php  }
                    // }
                }
            }
        }else{
            
        } ?>
       </tbody>
     </form>
    </div>
    </div>
    </section>
  

  
    <form action = "schedule.php" method="post" >
    <table  border="1" align="center" id="myTable">

    <!-- This allows the admin to choose multiple values and the prices will be added up by js function -->
    




</body>
</html> 