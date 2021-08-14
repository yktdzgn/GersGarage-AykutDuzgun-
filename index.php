

<!-- 
This is the initial page of the program. 
It creates the database, tables and the admin user of the application. -->


<?php


// credentials of the database
// password is initialized to null while localhost is used
// as the server and the root is the username 
$serverName = "localhost";
$userName = "root";
$password = "";
$dbname = "reg";


// creates the connection
$conn = mysqli_connect($serverName, $userName, $password);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


//creates the reg database only if it doesn't exist
//if it exists nothing will change 
$sql = "CREATE DATABASE IF NOT EXISTS reg;";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}


$conn = mysqli_connect($serverName, $userName, $password,$dbname );
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// creates the user table containing the name,
//email and password. Email is the primary key
// so it is unique to each row/user
$sql = "CREATE TABLE if not exists user(
    name VARCHAR(30) NOT NULL,
    email Varchar(30) PRIMARY KEY,
    password VARCHAR(30) NOT NULL
);";

if (mysqli_query($conn, $sql)) {
    //echo "Table created successfully";
} else {
    echo "Could not create table. Error: " . mysqli_error($conn);
}




//creates table appointment which contains
//the user email to make the connection with the user table
// row number 
// appointment type
// vehicle type
// vehicle make 
// vehicle licence number
// employee
// status 
// app_date
// engine
// phone 
// further comments from user and 
// price updated by admin only

$sql1 = "CREATE TABLE if not exists appointment (
    email Varchar(30) NOT NULL,
    row INT Not Null AUTO_INCREMENT primary key, 
    appointment_type Varchar(30) NOT NULL,
    vehicle_type Varchar(30) NOT NULL,
    vehicle_make Varchar(30) NOT NULL,
    vehicle_license_nr Varchar(30) NOT NULL,
    employee Varchar(30) ,
    status Varchar(30) ,
    app_date date NOT NULL,
    engine Varchar(30) NOT NULL,
    phone Varchar(20) NOT NULL,
    further_comments Varchar(100),
    price INT,
    items Varchar(200)
);";

// create table and check result
if (mysqli_query($conn, $sql1)) {
   // echo "Table created successfully";
} else {
    echo "Could not create table. Error: " . mysqli_error($conn);
}


//this creates the admin 
//however for security reasons this can be directly created in database and not in code
$sql2 = "insert ignore into user (name, password, email) values ('ADMIN', 'admin', 'admin@yahoo.com')";

// create table and check result
if (mysqli_query($conn, $sql2)) {
    echo "ADMIN added";
} else {
    echo "Could not insert. Error: " . mysqli_error($conn);
}

$sql3 =  "CREATE TABLE if not exists item (
    name Varchar(30) NOT NULL,
    price INT Not Null 
    );";

// create table and check result
if (mysqli_query($conn, $sql3)) {
    echo "item table created";
} else {
    echo "Could not create. Error: " . mysqli_error($conn);
}


//here the table with all the items is created 
$sql4 = "insert ignore into item (name, price) values ('roof', 400),('wheel_well',280),('superproof',250),('bonnet',100),('brakes',630)
,('trim',110),('shock_asorber',240),('auto',160),('dashboard',100),('camshaft',500)
,('antilock_brakes',810),('radio',529),('bench seat',1200),('power_brakes',310),('baby_car_seat',290)
,('automatic_transmission',260),('engine',5020),('antenna',145),('warning_light',98),('tachometer',54)
,('door_handle',30),('spare_tire',257),('instrument_panel',468),('jack',47),('hubcap',378)
,('fuel_gaugage',537),('fan_belt',23),('gas_gaugage',547),('speaker',103),('rag_top',34)
,('driver_seat',145),('seat_belt',42),('rotary_engine',124),('carburetor',324),('accelerator',245)
,('seat',235),('floor_mat',13),('car_seat_cover',29),('gasoline',378),('front_window',431),('other',400)";

if (mysqli_query($conn, $sql4)) {
    echo "Table created";
} else {
    echo "Could not add to table item. Error: " . mysqli_error($conn);
}


// close connection
mysqli_close($conn);


$dbhandle = mysqli_connect("localhost", "root","") or die (mysql_error());
mysqli_select_db($dbhandle, "reg") or die (mysql_error());

if (isset($_POST['signup']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];


    if($name != '' and $email != '' and $pass != '' and $name!= 'ADMIN'){
        $query = "insert into user (name, password, email) values ('$name', '$pass', '$email')";
        if (mysqli_query($dbhandle, $query)){
            echo"<h3> You have registered successfully!!</h3>";
            header("Location: login.php");
            exit();
        }
    }
    else{ ?>
        <style>
            .alert-danger{display:block !important; }
        </style>
  <?php   }
   
}


?>

<!DOCTYPE html>
<html>
<head>
<title>Sign Up</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<style>
    /* //.alert-danger{ } */
</style>
</head>
<body>
 <!-- this creates the register form and may make the connection with the login form  -->
<div class="container">
        <div class="row">
            <div class="col-lg-3 "></div>
            <div class="col-lg-6 col-xs-12">
                
            <div class="card pb-3" style="margin-top: 100px;">
              <div class="alert alert-danger" role="alert" style="display:none;">
              Complete all fields
              </div>
              <div class="card-header">
                  <h5 class="card-title text-center">Ger's Garage</h5>
                  <h2 class="card-title">Register here</h2>
                </div>  
                <div class="card-body pb-3">  
                 <form action = "index.php" method="post">
                   <div class="form-group">
                     <label for="Email">Name</label>
                      <input type="text" name = "name" class="form-control" id="name" placeholder="Enter your Name">
                    </div>
                    <div class="form-group">
                     <label for="Password">Email</label>
                      <input type="email" name = "email" class="form-control" id="email" placeholder="Enter your Email">
                    </div>  
                    <div class="form-group">
                     <label for="Password">Password</label>
                      <input type="password" name = "password" class="form-control" id="password" placeholder="Enter your Password">
                    </div>  
                    <input type="submit" class="btn btn-custom login-btn text-capitalize fontbold"  name = "signup" value = "Sign up">
                    <!-- This go to Login page -->
                    <span class="loginwith pl-2 pr-2 text-capitalize">or Already have an account? <a href="login.php" class="btn-link font-weight-bold">Log In</a></span>
                 </form>
                </div>
                </div>
            </div>
            
        </div>
    </div>

</body>
</html>

<!-- this adds the new users to the database after checking that all values are inserted 
and the name is not admin  If users are successfully added then the words will be displayed. Otherwise 
state that all fields should be completed -->
