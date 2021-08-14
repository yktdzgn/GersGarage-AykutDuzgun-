
<!-- This page is the first page that appears to the user and shows all their 
individual appointments, the status, data, employee asssigned by the admin and price. -->


<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<!-- this is the menu -->
<!-- Top menu header -->
<nav class="navbar navbar-expand-lg navbar-light bg-light text-right">
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
        <a class="nav-link" href="book.php">Book</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Log out</a>
      </li>
    </ul>
  </div>
</nav>

<!-- this creates a table where all the data of the car appears along with the 
employee assigned to fix the car, 
its status 
and the final or current price
The table shows only the appointments and data of the accounts user and ignores the other users 
of the application -->

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
      <!-- Start This About me   -->
      <div class="about_me mt-5">
        <h2 class="text-capitalize">About us</h2>
        <p class="muted">Our company operates in the market since 1980. We care to deliver the best product to customers. Our customers can choose to book from a variety of appintment services including annual service, major service, repair/fault and major repair. 
         </p>
      </div>
      <!-- End This About me   -->

      <!-- Start : Your appointment -->
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="your_appointment mt-5">
             <h2 class="text-center text-capitalize">Your appointment</h2>
             <!-- Database Connection -->
             <?php
                $dbhandle = mysqli_connect("localhost", "root","") or die (mysql_error());
                mysqli_select_db($dbhandle, "reg") or die (mysql_error());
              ?>

              <!-- Start : table Of appiontment -->
                <table class="table table-sm able-bordered table-responsive w-100 mt-5" >
                  <thead>
                    <tr> 
                      <th class="text-center">Appointment type</th>
                      <th class="text-center">Appointment date</th>
                      <th class="text-center">Tel. number</th>
                      <th class="text-center">Vehicle type</th>
                      <th class="text-center">Vehicle make</td>
                      <th class="text-center">Vehicle license number</th>
                      <th class="text-center">Engine type</th>
                      <th class="text-center">Further comments</th>
                      <th class="text-center">Employee</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Price</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    session_start();
                    $email = $_SESSION['email'];
                    $query = "select appointment_type, app_date, phone, vehicle_type , vehicle_make, vehicle_license_nr, engine, further_comments, employee, status, price from appointment where email= '$email'";
                    $result = mysqli_query($dbhandle, $query) or die( mysqli_error($dbhandle));
                    // Start : Display data
                    while ($value = mysqli_fetch_assoc($result)) {
                     if (!empty($value) && $value != ""){ 
//foreach ($row as $value) { ?>
                        <tr>
                          <td class="text-center"><?php echo $value['app_date']; ?></td>
                          <td class="text-center"><?php echo $value['appointment_type']; ?></td>
                          <td class="text-center"><?php echo $value['phone']; ?></td>
                          <td class="text-center"><?php echo $value['vehicle_type']; ?></td>
                          <td class="text-center"><?php echo $value['vehicle_make']; ?></td>
                          <td class="text-center"><?php echo $value['vehicle_license_nr']; ?></td>
                          <td class="text-center"><?php echo $value['engine']; ?></td>
                          <td class="text-center"><?php echo $value['further_comments']; ?></td>
                          <td class="text-center"><?php echo $value['employee']; ?></td>
                          <td class="text-center"><?php echo $value['status']; ?></td>
                          <td class="text-center"><?php echo $value['price']; ?></td>
                        </tr>
                     <?php //}
                      } else{ ?>
                        <tr class="text-center">To be decided.</tr>
                     <?php }
                      //  End of Data
                    } ?>
                  
              <!-- End : table Of appiontment -->
           </div>
          </div>
        </div>
      </div>
      
<!-- End: Your appointment -->
</section>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html> 