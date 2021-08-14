
<!-- This page updates the appointment table to add aother status to a vehicle.
The admin only can access this page. -->

<!DOCTYPE html>
<html>
<head>
<title>Status</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>

//This function can retrieve the row from the admin page that saved the row from the update
//button clicked. 
// It recieves the selected status value and adds it to the table in the specified row
   $(document).ready(function(){
        $("button").click(function(){
            var para = new URLSearchParams(window.location.search);
            var pass = para.get("row"); 
            var stat = document.getElementById('status').value;
            window.location.href='status.php?stat=' + stat+ '&pass=' + pass;
        });
    });
</script>
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
<div class="clearfix"></div>
<section class="main-section">
    <div class="row">
     <div class="container">
        <h1 class="text-center"> Ger's Garage</h1>
      <!-- This is banner image  -->
      <div class="techn_img">
        <img src="assets/image/technician.jpg" class="img-fluid w-80 rounded" alt="Responsive image" >
      </div>
     <div class="clearfix"></div>
      <!-- select any option  -->
     
      <div class="col-lg-6 col-xs-12 offset-lg-3 mt-5">
       <div class="car_status">
            <div class="card">
            <div class="card-body">
              <h2 class="text-center">Car status</h2>
                <form action = "admin.php" method="post" >
                    <div class="form-group">
                        <!-- This displays the statuses in a dropdown menu in order for the admin to choose -->
                        <lable for="status">Choose status</lable>
                        <select class="form-control form-control-sm" name="stat" id = "status">
                            <option value="">Choose option</option>
                            <option value="booked">Booked</option>
                            <option value="in_service">In service</option>
                            <option value="fixed">Fixed</option>
                            <option value="Collected">Collected</option>
                            <option value="unrepearable">Unrepearable</option>
                        </select>
                    </div>

                    <button type = "button" class="btn btn-info btn-md" name="submit">Save</button>
                </form>
            </div>
            </div>
        
        </div>
       

      </div>
     
     </div>
    </div>
     
</section>
 
    <!-- If the status is selected, the table in the given row will be updated with the given value  -->
    
    <?php
        if(isset($_GET['pass'])&& isset($_GET['stat'])){
            $stat = $_GET['stat'];
            $row = $_GET['pass'];
            $q = "update appointment set status = '$stat' where row = $row";
            $dbhandle = mysqli_connect("localhost", "root","") or die (mysql_error());
            mysqli_select_db($dbhandle, "reg") or die (mysql_error());
            $result = mysqli_query($dbhandle, $q) or die( mysqli_error($dbhandle));
            if (mysqli_query($dbhandle, $q)){
                echo "done";
            }else{
                echo 'Opss';
            }
        }
    ?>

 


</body>
</html> 