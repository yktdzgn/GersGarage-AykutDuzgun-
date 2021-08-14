
<!-- This page will allow the admin to assign an employee to a vehicle
However, no emplyee can be assigned more than 4 vehicles per day  -->

<!DOCTYPE html>
<html>
<head>
<title>Assign employee</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>

//This function can retrieve the row from the admin page that saved the row from the update
//button clicked. 
// It recieves the selected employee value and adds it to the table  in the specified row
   $(document).ready(function(){
        $("button").click(function(){
            var para = new URLSearchParams(window.location.search);
            var pass = para.get("row"); 
            var emp = document.getElementById('employee').value;
            window.location.href='employee_choice.php?emp=' + emp+ '&pass=' + pass;
        });
    });
</script>
</head>
<body>

<!-- This is the Top menu -->
<!-- This is the navigation part consisting only of admins home page and logout  -->
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
     <div class="row1">
      <div class="col-12">
      <h1> Ger's Garage</h1>
      <!-- This is banner image  -->
      <div class="techn_img">
        <img src="assets/image/technician.jpg" class="img-fluid w-80 rounded" alt="Responsive image" >
      </div>
    </div>
   </div>
  </div>
  <!-- start -->
  <!-- select any option  -->
     
  <div class="col-lg-6 col-xs-12 offset-lg-3 my-5">
       <div class="car_status">
            <div class="card">
            <div class="card-body">
              <h2 class="text-center">Employee</h2>
                <form action = "admin.php" method="post" >
                    <div class="form-group">
                      <!-- This shows the options to choose from the employees as a drop down menu -->
                        <lable for="status">Choose employee</lable>
                        <select class="form-control form-control-sm" name="employee" id="employee" >
                            <option value="">Choose option</option>
                            <option value="paul_smith">Paul Smith</option>
                            <option value="john_smith">John Smith</option>
                            <option value="mike_barry">Mike Barry</option>
                            <option value="ryan_kerry">Ryan Kerry</option>
                            <option value="andy_finney">Andy Finney</option>
                        </select>
                    </div>
                     <button type = "button" class="btn btn-info btn-md" name="submit">Save</button>
           
  <!-- End -->
  

<!-- First of all the date is selected from the database in the selected row. 
That data and employee number is checked to see if the employee is assigned more than 4
vahicles that day. If not the appointmanet table is updated with that employee. Otherwise,
the text to choose another employee will appear. -->
    
    <?php
        if(isset($_GET['pass'])&& isset($_GET['emp'])){
            $emp = $_GET['emp'];
            $row = $_GET['pass'];

            $q = "select app_date from appointment where row = $row";
            $dbhandle = mysqli_connect("localhost", "root","") or die (mysql_error());
            mysqli_select_db($dbhandle, "reg") or die (mysql_error());
            $res = mysqli_query($dbhandle, $q) or die( mysqli_error($dbhandle));
            while ($r = mysqli_fetch_assoc($res)) {
                foreach($r as $val){
                    
                    $q1 = "select count(*) from appointment where app_date = '$val' and employee = '$emp'" ;
                    $dbhandle = mysqli_connect("localhost", "root","") or die (mysql_error());
                    mysqli_select_db($dbhandle, "reg") or die (mysql_error());
                    $res1 = mysqli_query($dbhandle, $q1) or die( mysqli_error($dbhandle));
                    while ($r1 = mysqli_fetch_assoc($res1)) {
                        foreach($r1 as $val1){
                            $q2 = "select count(*) from appointment where app_date = '$val' and employee = '$emp' and appointment_type = 'major_repair' and row!='$row'" ;
                            $dbhandle = mysqli_connect("localhost", "root","") or die (mysql_error());
                            mysqli_select_db($dbhandle, "reg") or die (mysql_error());
                            $res2 = mysqli_query($dbhandle, $q2) or die( mysqli_error($dbhandle));
                            while ($r2 = mysqli_fetch_assoc($res2)) {
                                foreach($r2 as $val2){
                                    $val3 = (int)$val1 - (int)$val2;
                                    $val4 = 2* (int)$val2;
                                    $val5 = (int)$val3 + (int)$val4;
                                    if($val5<4){
                                        $q = "update appointment set employee = '$emp' where row = $row";
                                        $dbhandle = mysqli_connect("localhost", "root","") or die (mysql_error());
                                        mysqli_select_db($dbhandle, "reg") or die (mysql_error());
                                        $result = mysqli_query($dbhandle, $q) or die( mysqli_error($dbhandle));
                                        if (mysqli_query($dbhandle, $q)){
                                            echo "Done";
                                        }else{
                                            echo 'Opss';
                                        }
                                    }else{
                                        echo " Opsss this employee is really busy, choose another one. ";
                                    }
                                }
                            }
                    
                        }
                    }
                }
            }
 
        } ?>
     </form>
    </div>
  </div>
 </div>
</div>
</body>
</html> 