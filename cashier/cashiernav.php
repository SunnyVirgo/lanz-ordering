<?php include '../config/constant.php'; 
include 'checklogin.php';

$sql = 'SELECT * FROM settings';
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$cashId=$_SESSION['cash'];
$result=mysqli_query($conn,"SELECT * FROM tbl_users WHERE id = $cashId ");
$rows=mysqli_fetch_assoc($result);
?>
         
                  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier</title>
    <link rel="stylesheet" href="../fontawesome-free-6.1.2-web/fontawesome-free-6.1.2-web/css/all.css">
    <link rel="shortcut icon" href= "../images/foods/<?php echo $row[
                            'logo'
                        ]; ?>"type="image/x-icon">
                              <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap"
    />
        <link rel="stylesheet" href= "cashier.css">
<script src="../sweetalert2/jquery-3.4.1.min.js"></script>
    <script src="../sweetalert2/sweetalert2.all.min.js"></script>
     <script src="../sweetalert2/bootstrap.bundle.min.js"></script>
      <script src="../sweetalert2/bootstrap.min.js"></script>
      <script src="../sweetalert2/bootstrap.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class ="container1">
        <div class="navigation1">
            <ul>
                <li>
                    <a href ="#">
                        <span class ="icon"></span>
                        <span class ="title"><img src="../images/foods/<?php echo $row[
                            'logo'
                        ]; ?>" class="logo" ></span>
                    </a>
                </li>

                <li>
                    <a href ="index.php">
                       <span class ="icon"><i class="fa-solid fa-list-check"></i></span>
                        <span class ="title">Orders</span>
                    </a>
                </li>

                <li>
                    <a href ="sales.php">
                        <span class ="icon"><i class="fa-solid fa-cart-shopping"></i></span>
                        <span class ="title">Sales</span>
                    </a>
                </li>

             
                
            </ul>
    </div>
        <div class="main1">
             <?php
             //CREATE SQL QUERY TO GET DETAILS
             $sql7 = 'SELECT * FROM tbl_admin WHERE id=1';

             //execute the query
             $res7 = mysqli_query($conn, $sql7);

             // checking
             if ($res7 == true) {
                 $count7 = mysqli_num_rows($res7);

                 if ($count7 == 1) {
                     //get details
                     $row7 = mysqli_fetch_assoc($res7);

                     $user_name7 = $row7['user_name'];
                     $user_type7 = $row7['user_type'];
                 }
             }
             ?>
             <div class="topbar1">
                <div class="system">
               
                 <div class="toggle">
  <i class="fa-solid fa-bars"></i>
                </div>
                   <h4>Lanz Pizza Ordering System</h4>
                </div>
               
                 
                <div class="user" data-toggle="tooltip" data-placement="top" title="Admin Settings">
                    <i class="fa-solid fa-circle-user" id="icon"></i>
                    <h4>Cashier</h4>
                    <h2>-</h2>
                    <h4><?php echo $rows['user_name']; ?></h4>
                    <i class="fa-solid fa-caret-down" onclick="show()" id="user"></i>
                    
                </div>
                
            </div>

            <!-- for admin settings -->
            <div class="settings" id="settings">
                        <ul>
                        <a href="update-admin.php?id=<?php echo $cashId; ?>">   <li> <i class="fa-solid fa-gear"> </i>Update Account</li></a>
                  <a href="../adminpanel/logout.php" class = "log-out">  <li><i class="fa-solid fa-right-from-bracket"></i>Logout</li></a>
                        
                        </ul>
                    </div>
        </div>
      


    </div>
</div>
        
</div>


                
<script>
   
   const currentLocation = location.href;
   const menuItem = document.querySelectorAll(".navigation1 ul a");
   const menuLength = menuItem.length;

   for(var i = 0; i < menuLength; i++) {
    if(menuItem[i].href === currentLocation) {
        menuItem[i].className = "hovered";
    }
   }
   var a;
   function show()
   {
    if (a==0)
    {
        document.getElementById("settings").style.display="none";
        return a=1;
    }
    else
    {
        document.getElementById("settings").style.display="flex";
        return a=0;
    }
   }
   
   $('.log-out').on('click', function(f) {
        f.preventDefault();
        const a = $(this).attr('href')

        Swal.fire({
            title: 'Are You Sure?',
            text: 'You will be logged out!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'blue',
            cancelButtonColor: 'red',
            confirmButtonText:'Log Out',
        }).then((result) => {
            if (result.value) {
                document.location.href = a;
            }
        })
    })
     
     $(document).ready(function(){
    $('div').tooltip();
  })


  function show() {
  var settingsDiv = document.getElementById("settings");
  var caretIcon = document.getElementById("user");
  
  if (a == 0) {
    settingsDiv.style.display = "none";
    caretIcon.classList.remove("fa-caret-up");
    return a = 1;
  } else {
    settingsDiv.style.display = "flex";
    caretIcon.classList.add("fa-caret-up");
    return a = 0;
  }
}

// Event listener for clicks on the document
document.addEventListener("click", function (event) {
  var settingsDiv = document.getElementById("settings");
  var userDiv = document.getElementById("user");
  var caretIcon = document.getElementById("user");
  
  if (event.target !== settingsDiv && event.target !== userDiv) {
    if (settingsDiv.style.display !== "none") {
      settingsDiv.style.display = "none";
      caretIcon.classList.remove("fa-caret-up");
      a = 1;
    }
  }
});
</script>

</body>
</html>