
<!-- This creates the booking page appearing to the users that are about to take thier car
to service.  -->

<?php

        $dbhandle = mysqli_connect("localhost", "root","") or die (mysql_error());
        mysqli_select_db($dbhandle, "reg") or die (mysql_error());


        // this adds the phone number, engine, application type,
        // application date, vehicle type, vehicle make, vehicle
        // license number and further comments to the 
        // application table 

        if (isset($_POST['book']))
        {
            $phone = $_POST['phone'];
            $engine = $_POST['engine'];
            $type = $_POST['app_type'];
            $date = $_POST['app_date'];
            $vehicle_type = $_POST['vehicle_type'];
            $vehicle_make = $_POST['vehicle_make'];
            $vehicle_license_nr = $_POST['vehicle_license_nr'];
            $further_comments = $_POST['further_comments'];

            session_start();
            $email = $_SESSION['email'];
            $row1 = '';
            $price = 0;
            $booking_nr = 0;

            //the row is added only if no field  is null

            if($phone != '' and $engine != '' and $type != '' and  $date != '' and $vehicle_type  != '' and $vehicle_make != '' and $vehicle_license_nr != '' and $further_comments != '' ){
                
                $count = "select count(*) from appointment";
                $result = mysqli_query($dbhandle, $count) or die( mysqli_error($dbhandle));
                    while ($row = mysqli_fetch_assoc($result)) {
                        foreach ($row as $value) { 
                            $row1 = $value;   
                        }
                    }
                $timestamp = strtotime($date);
                $day = date('l', $timestamp);
                if ($day == 'Sunday'){
                    echo "It's Sunday, choose another day";
                }
                else{
                $countbookings = "select count(app_date) from appointment where app_date = '$date'";
                $resultbook = mysqli_query($dbhandle, $countbookings) or die( mysqli_error($dbhandle));
                    while ($row = mysqli_fetch_assoc($resultbook)) {
                        foreach ($row as $value) { 
                            if ($value <= 15){
                                //attach a price to each service
                                if($type == 'annual_service'){
                                    $price = 150;
                                }
                                elseif($type == 'repair_fault'){
                                    $price = 200;
                                }
                                elseif($type == "major_service"){
                                    $price = 250;
                                }
                                elseif($type == "major_repair"){
                                    $price = 200;
                                }
    
                                $query = "insert into appointment (phone, email, engine, appointment_type, app_date, vehicle_type, vehicle_make, vehicle_license_nr, further_comments, price) values ('$phone' , '$email' , '$engine' ,'$type', '$date' , '$vehicle_type ' , '$vehicle_make' , '$vehicle_license_nr' , '$further_comments', '$price' )";
                                if (mysqli_query($dbhandle, $query)){ ?>
                                    
                                    Succesfully booked appointment at Ger's Garage
                              <?php  } 
                            }else{

                                //avoid more than 15 bookings on the same day 
                                echo "Too many bookings on the same day";
                            }
                        }
                    }
                }     
            }else{
                echo 'Information missing';
            }
        }



// This will create the form for the user to insert the data and fill the table 
// The vehicle make appears in a drop down to be seleted by the user. 
// There are 30 vehicle makes.

?>
<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>

<!-- This is the nagivation menu -->
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
        <a class="nav-link" href="book.php">Book</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Log out</a>
      </li>
    </ul>
  </div>
</nav>
  
  <section class="main-section">
      <h1> Ger's Garage</h1>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-xs-12 offset-lg-2 mt-5">
            <div class="card">
            <div class="card-body">
                <h2 class="card-title">Book appointment</h2>
                <!-- This creates the from to be filled and values selected -->
                <form action = "book.php" method="post" >
                    <div class="form-group">
                        <lable for="appointment-type">Appointment Type</lable>
                        <select class="form-control form-control-sm" id="type" name="app_type">
                            <option value="annual_service">Annual service</option>
                            <option value="major_service">Major service</option>
                            <option value="repair_fault">Repair fault</option>
                            <option value="major_repair">Major repair</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <lable for="appointment-day">Appointment day</lable>
                        <input type= "date" name = "app_date" id="txtDate" class="form-control ">
                    </div>
                    <div class="form-group">
                        <lable for="Telephone-number">Telephone number</lable>
                        <input type= "number" name = "phone" class="form-control ">
                    </div>
                    <div class="form-group">
                        <lable for="Telephone-number">Vehicle type</lable>
                        <select class="form-control form-control-sm" id="vehicle_type" name="vehicle_type">
                          <option value="motorbike">Motorbike</option>
                          <option value="car">Car</option>
                          <option value="small_van">Small Van</option>
                          <option value="small_bus">Small bus</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <lable for="Vehicle-make">Vehicle make</lable>
                        <select class="form-control form-control-sm" id="vehicle_make" name="vehicle_make">
                        <option value="mercedes">Mercedes</option>
                            <option value="toyota">Toyota</option>
                            <option value="audi">Audi</option>
                            <option value="porsche">Porsche</option>
                            <option value="volvo">Volvo</option>
                            <option value="honda">Honda</option>
                            <option value="peaugeot">Peaugeot</option>
                            <option value="hyundai">Hyundai</option>
                            <option value="kia">Kia</option>
                            <option value="mazda">Mazda</option>
                            <option value="alfa_romeo">Alfa Romeo</option>
                            <option value="mitsubishi">Mitsubishi</option>
                            <option value="honda">Honda</option>
                            <option value="jeep">Jeep</option>
                            <option value="ford">Ford</option>
                            <option value="skoda">Skoda</option>
                            <option value="nissan">Nissan</option>
                            <option value="suzuki">Suzuki</option>
                            <option value="land_rover">Land Rover</option>
                            <option value="volkswagen">Volkswagen</option>
                            <option value="fiat">Fiat</option>
                            <option value="dogde">Dogde</option>
                            <option value="chrysler">Chryslern</option>
                            <option value="chevrolet">Chevrolet</option>
                            <option value="maserati">Maserati</option>
                            <option value="ferrari">Ferrari</option>
                            <option value="renault">Renault</option>
                            <option value="tata">Tata</option> 
                            <option value="motorbike">Motorbike</option>
                            <option value="citroen">Citroen</option>
                            <option value="jaguar">Jaguar</option>
                            <option value="bmw">BMW</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <lable for="Engine-type">Engine type</lable>
                        <input type= "text" name = "engine" class="form-control ">
                    </div>
                    <div class="form-group">
                        <lable for="Engine-type">Vehicle license number</lable>
                        <input type= "text" name = "vehicle_license_nr" class="form-control ">
                    </div>
                    
                    <div class="form-group">
                        <lable for="Engine-type">Further Comments</lable>
                        <textarea type= "text" name = "further_comments" class="form-control "></textarea>
                        <!-- <input type= "text" name = "further_comments" class="form-control "> -->
                    </div>
                    <input type = "submit" class="btn btn-success btn-lg" name = "book" value = "Submit"/>
                </from>
            </div>
            </div>
          </div>
        </div>
      </div>
       
  </section>
 
    
    
</body>
</html>
  
<script type="text/javascript">
    $(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    var maxDate = year + '-' + month + '-' + day;

    $('#txtDate').attr('min', maxDate);
});
</script>
