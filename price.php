
<!-- This page allows the admin to set or update the price of a vehicle 
fixing etc. -->

<!DOCTYPE html>
<html>
<head>
<title>Update Price</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>

//This function can retrieve the row from the admin page that saved the row from the update
//button clicked. 
// It recieves the selected items value and adds it to the given price. Since there 
//are multiple items allowed to be clicked the price is the sum of all them.
    $(document).ready(function(){
        $("button").click(function(){
            let arr = [];
            var para = new URLSearchParams(window.location.search);
            var pass = para.get("row"); 
            var spanresult = document.getElementById("result");
            var pric = 0;
            var x = document.getElementById("carparts");
            for(var i = 0; i<x.options.length; i++){
                if(x.options[i].selected === true){
                    arr.push(x.options[i].value);
                }
            }
            
            var arr1 = JSON.stringify(arr);
            alert(arr1);
            window.location.href='price.php?arr=' + arr1 + '&passw=' + pass;
        });
    });
</script>
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

  <!-- select any option  -->
     
  <div class="col-lg-6 col-xs-12 offset-lg-3 my-5">
       <div class="car_status">
            <div class="card">
            <div class="card-body">
              <h2 class="text-center">Price</h2>
                <form action = "admin.php" method="post" >
                    <div class="form-group">
                       <!-- This allows the admin to choose multiple values and the prices will be added up by js function -->
                        <lable for="status">Price</lable>
                        <select class="form-control form-control-sm" name="carparts" id="carparts" multiple = "multiple">
                        <option value="roof">Roof</option>
                            <option value="wheel_well">Wheel well</option>
                            <option value="sunproof">Sunproof</option>
                            <option value="bonnet">Bonnet</option>
                            <option value="brakes">Brakes</option>
                            <option value="trim">Trim</option>
                            <option value="shock_absorber">Shock absorber</option>
                            <option value="autp">Auto</option>
                            <option value="dashboard">Dashboard</option>
                            <option value="camshaft">Camshaft</option>
                            <option value="antilock_brakes">Anti-lock brakes</option>
                            <option value="radio">Radio</option>
                            <option value="bench_seat">Bench seat</option>
                            <option value="power_brakes">Power brakes</option>
                            <option value="baby_car_seat">Baby car seat</option>
                            <option value="automatic_transmission">Automatic transmission</option>
                            <option value="engine">Engine</option>
                            <option value="antenna">Antenna</option>
                            <option value="warning_light">Warning light</option>
                            <option value="tachometer">Tachometer</option>
                            <option value="door_handle">Door handle</option>
                            <option value="spare_tire">Spare tire</option>
                            <option value="instrument_panel">Instrument panel</option>
                            <option value="jack">Jack</option>
                            <option value="hubcap">Hubcap</option>
                            <option value="fuel_gaugage">Fuel gaugage</option>
                            <option value="fan_belt">Fan belt</option>
                            <option value="gas_gaugage">Gas Gaugage</option>
                            <option value="speaker">Speaker</option>
                            <option value="rag_top">Rag top</option>
                            <option value="driver_seat">Driver's seat</option>
                            <option value="seat_belt">Seat belt</option>
                            <option value="rotary_engine">Rotary engine</option>
                            <option value="rear_window_defroster">Rear window defroster</option>
                            <option value="carburetor">Carburetor</option>
                            <option value="accelerator">Accelerator</option>
                            <option value="seat">Seat</option>
                            <option value="floor_mat">Floor Mat</option>
                            <option value="car_seat_cover">Car seat Cover</option>
                            <option value="gasoline">Gasoline</option>
                            <option value="front_window">Front window</option>
                            <option value="other">Other</option>
                        </select>
                        <span id = "result"></span>
                    </div>

                    <button type = "button" class="btn btn-info btn-md" name="submit">Save</button>
                </form>
            </div>
            </div>
        
        </div>
       

      </div>
  

    
    <!-- Here the overall price is calculated as the sum of the service and the items added.
    Items are transfered as a array from the javascript code above and through iteration their prices
    are retrieved from the item table. Thent he overal price is added to the table and that price will go up as the 
    admin adds more items. -->
    
    <?php
        if(isset($_GET['passw'])&& isset($_GET['arr'])){
        $price = 0;
        $row = $_GET['passw'];
        $dbhandle = mysqli_connect("localhost", "root","") or die (mysql_error());
        mysqli_select_db($dbhandle, "reg") or die (mysql_error());
        $arr = json_decode($_GET['arr']); 
        $arr1 = $_GET['arr']; 
        echo is_string($arr1)?"y":"no";
        $sql4 = "update appointment set items = '$arr1' where row = '$row'";

        if (mysqli_query($dbhandle, $sql4)) {
            echo "added";
        } else {
            echo " Error: " . mysqli_error($dbhandle);
        }

      
            $query = "select price from appointment where row = '$row'";
            $result = mysqli_query($dbhandle, $query) or die( mysqli_error($dbhandle));
            while ($ro = mysqli_fetch_assoc($result)) {
                foreach ($ro as $value) { 
                    $v = (int)$value;
                    $price = $price+$v;
                    foreach ($arr as $val){
                        $query1 = "select price from item where name ='$val'";
                        $result1 = mysqli_query($dbhandle, $query1) or die( mysqli_error($dbhandle));
                        while ($ro1 = mysqli_fetch_assoc($result1)) {
                            foreach ($ro1 as $value1) { 
                                if($value!=''){
                                    $v1 = (int)$value1;
                                    $price = $price+ (int)$value1;
                                    $query = "select price from appointment where row= '$row'";
                                    $result = mysqli_query($dbhandle, $query) or die( mysqli_error($dbhandle));
                                    while ($ro = mysqli_fetch_assoc($result)) {
                                        foreach ($ro as $value) { 
                                            $q = "update appointment set price = '$price' where row = '$row'";
                                            if (mysqli_query($dbhandle, $q)){
                                                echo "done";
                                            }else{
                                                echo 'Opss';
                                            }
                                        }
                                        break;
                                    }
                                }
                            }
                            break;
                        }
                    }   
                }
            }
        }
    ?>


    
</table>
</form>


</body>
</html> 