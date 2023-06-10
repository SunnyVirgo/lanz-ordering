<?php
include 'config/constant.php';
$sql = 'SELECT * FROM settings';
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="fontawesome-free-6.1.2-web">
    <link rel="stylesheet" href="css/style.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap"
    />
     <link rel="stylesheet" href="./fontawesome-free-6.1.2-web/fontawesome-free-6.1.2-web/css/all.css">
     <link rel="shortcut icon" href="./images/foods/<?php echo $row[
                            'logo'
                        ]; ?>" type="image/x-icon">
       <script src="sweetalert2/bootstrap.bundle.min.js"></script>
      <script src="sweetalert2/bootstrap.min.js"></script>
    <script src="sweetalert2/jquery-3.4.1.min.js"></script>
    <script src="sweetalert2/sweetalert2.all.min.js"></script>
    <title><?php
    echo $row['name'] 
    ?> Ordering System</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="" class="sign-in-form" method="POST">
            <h2 class="title">WELCOME!</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" autocomplete="off" name="user_name" required />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" placeholder="Password" required />
            </div>
            <input type="submit" name="submit" value="Login" class="btn solid" />
          </form>
        </div>
      </div>
   <?php if (isset($_GET['log-in'])): ?>
                    <div class="flash-data" data-flashdata="<? = $_GET['log-in']; ?>"></div>
                <?php endif; ?>
                 <?php if (isset($_GET['fail'])): ?>
                    <div class="flash-data1" data-flashdata="<? = $_GET['fail']; ?>"></div>
                <?php endif; ?>
      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h1>LANZ PIZZA ORDERING SYSTEM</h1>
            <p>
              Team iCORE
            </p>
          </div>
          <img src="img/undraw_eating_together_re_ux62.svg" class="image" alt="" />
        </div>
      </div>
    </div>
     <script>
const flashdata = $('.flash-data').data('flashdata')
     if (flashdata) {
        Swal.fire({
            type: 'error',
            title: 'Oppps!',
            confirmButtonColor: ' blue',
            text: 'You need to log in!'
        }).then(function() {
            window.location = "index.php";
        })
     }
     const flashdata1 = $('.flash-data1').data('flashdata')
     if (flashdata1) {
        Swal.fire({
            type: 'error',
            title: 'Log in Failed!',
            confirmButtonColor: ' blue',
            text: 'Username or password is incorrect or You are not registered!'
        }).then(function() {
            window.location = "index.php";
        })
     }
    </script>
  </body>
</html>
<?php if (isset($_POST['submit'])) {
    //get data from form
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $password = md5(mysqli_real_escape_string($conn, $_POST['password']));

    //check sql if username and password exists

    $sql =
        "SELECT * FROM tbl_users  WHERE user_name = '" .
        $user_name .
        "' AND password = '" .
        $password .
        "' AND deleted=0";
    //execute query
    $res = mysqli_query($conn, $sql);

    $count = mysqli_fetch_array($res);

    if ($count['user_type'] == 'Cashier') {
        $_SESSION['cashier'] = $user_name;
        $_SESSION['cash'] = $count['id'];
        $_SESSION['name'] = $count['full_name'];
        header('location:cashier/index.php?page=1');
    } elseif ($count['user_type'] == 'administrator') {
        $_SESSION['username'] = $user_name;
        $_SESSION['ad'] = $count['id'];
        $_SESSION['name'] = $count['full_name'];
        if (isset($_SESSION['username'])) {
            header('location:adminpanel/index.php?page=1');
        }
    } elseif ($count['user_type'] == 'Kitchen Staff') {
        $_SESSION['kitchen'] = $user_name;
        $_SESSION['kit'] = $count['id'];
        $_SESSION['name'] = $count['full_name'];
        header('location:kitchenstaff/index.php?page=1');
    } elseif ($count['user_type'] == 'Kiosk') {
        $_SESSION['table'] = $user_name;
        $_SESSION['id'] = $count['id'];
        header('location:customertable/index.php');
    } else {
        header('location:index.php?fail=1');
    }
} ?>
  
    
