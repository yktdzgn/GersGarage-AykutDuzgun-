<!DOCTYPE html>
<html>
<head>
<title>Log in</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<!-- Login Form for users  -->
    <div class="container">
        <div class="row">
            <div class="col-lg-3 "></div>
            <div class="col-lg-6 col-xs-12">
                
            <div class="card pb-3" style="margin-top: 100px;">
              <div class="alert alert-danger" role="alert">
                Enter your credentials correctly!!
              </div>
              <div class="card-header">
                  <h5 class="card-title text-center">Ger's Garage</h5>
                  <h2 class="card-title">Login here</h2>
                </div>  
                <div class="card-body pb-3">  
                <form action = "login.php" method="post"> 
                    <div class="form-group">
                     <label for="Email">Email</label>
                      <input type="email" name = "email" class="form-control" id="email" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                     <label for="Password">Password</label>
                      <input type="password" name = "password" class="form-control" id="password" placeholder="Enter your password">
                    </div>  
                    <span><a href="index.php" class="btn-link font-weight-bold">
                    <input type="button" class="btn btn-custom login-btn text-capitalize fontbold" name = "register" value = "Register">
                    </a></span>
                    <input type="submit" class="btn btn-custom login-btn text-capitalize fontbold" name = "login" value = "Login">
                </form>
                </div>
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
  $('.alert-danger').hide();
</script>
<?php
$dbhandle = mysqli_connect("localhost", "root","") or die (mysql_error());
mysqli_select_db($dbhandle, "reg") or die (mysql_error());

if (isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    session_start();
    $_SESSION['email'] = $email;

    if ($email != "" && $password != ""){

        $adminpass = "select password from user where email = 'admin@yahoo.com'";
        $res1 = mysqli_query($dbhandle,$adminpass);
        $res1 = mysqli_fetch_array($res1);
        echo $res1[0];
        if($email== 'admin@yahoo.com' && $password == $res1[0]){
            header('Location: admin.php');
        }

        else{

            $query = "select count(*) as nrUsers from user where email='".$email."' and password='".$password."'";
            $result = mysqli_query($dbhandle,$query);
            $row = mysqli_fetch_array($result);

            $count = $row['nrUsers'];

            if($count > 0){
                $_SESSION['email'] = $email;
                header('Location: home.php');
            }else{
                echo "Invalid username and password";
            }

        }
    }

    else{ ?>
        <script>
          $('.alert-danger').show();
        </script>
    <?php }
}


?>
