<?php

include '../config/constant.php';
include '../config/logincheck.php';
$sql = 'SELECT * FROM settings';
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$id = $_SESSION['ad'];
$result=mysqli_query($conn,"SELECT * FROM tbl_users WHERE id = $id ");
$rows=mysqli_fetch_assoc($result);
?>
         
                  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
    <link rel="stylesheet" href="../fontawesome-free-6.1.2-web/fontawesome-free-6.1.2-web/css/all.css">
    <link rel="shortcut icon" href="../images/foods/<?php echo $row[
                            'logo'
                        ]; ?>" type="image/x-icon">
      <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap"
    />
    <link rel="stylesheet" href= "newstyle.css">
<script src="../sweetalert2/jquery-3.4.1.min.js"></script>
    <script src="../sweetalert2/sweetalert2.all.min.js"></script>
     <script src="../sweetalert2/bootstrap.bundle.min.js"></script>
      <script src="../sweetalert2/bootstrap.min.js"></script>
      <script src="../sweetalert2/bootstrap.js"></script>
</head>
<body>
    <div class ="container1">
        <div class="navigation1">
             <?php
             $sql = 'SELECT * FROM settings';
             $res = mysqli_query($conn, $sql);
             $row = mysqli_fetch_assoc($res);
             ?>
            <ul>
                <li class="logo">
                    <a href ="#">
                        <span class ="icon"></span>
                        <span class ="title"><img src="../images/foods/<?php echo $row[
                            'logo'
                        ]; ?>" class="logo" ></span>
                    </a>
                </li>

                <li>
                    <a href ="index.php">
                        <span class ="icon"><i class="fa-solid fa-home"></i></span>
                        <span class ="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href ="newmanage.php">
                        <span class ="icon"><i class="fa-solid fa-users-gear"></i></span>
                        <span class ="title">Accounts</span>
                    </a>
                </li>

                <li>
                    <a href ="managecategory.php">
                        <span class ="icon">  <i class="fa-solid fa-cubes-stacked"></i></span>
                        <span class ="title">Categories</span>
                    </a>
                </li>

                <li>
                    <a href ="managefood.php">
                        <span class ="icon"><i class="fa-solid fa-pizza-slice"></i></span>
                        <span class ="title">Menu's</span>
                    </a>
                </li>

                <li>
                    <a href ="order.php">
                        <span class ="icon"><i class="fa-solid fa-list-check"></i></span>
                        <span class ="title">Orders</span>
                    </a>
                </li>

                <li>
    <a href="#" onclick="toggleReports(event)">
        <span class="icon"><i class="fa-solid fa-file-lines"></i></span>
        <span class="title">Reports<i id="caret" class="fa-solid fa-caret-down"></i></span>
        <span class="dropdown-icon"></span>
    </a>
    <ul id="reports" style="display: none;">
        <li>
            <a href="daily_reports.php">
                <span class="icon"><i class="fa-solid fa-file-lines"></i></span>
                <span class="title">Daily Sales Reports</span>
            </a>
        </li>
        <li>
            <a href="monthly_reports.php">
                <span class="icon"><i class="fa-solid fa-file-lines"></i></span>
                <span class="title">Monthly Sales Reports</span>
            </a>
        </li>
        <li>
            <a href="quarter_reports.php">
                <span class="icon"><i class="fa-solid fa-file-lines"></i></span>
                <span class="title">Quarter Sales Reports</span>
            </a>
        </li>
        <li>
            <a href="annual_reports.php">
                <span class="icon"><i class="fa-solid fa-file-lines"></i></span>
                <span class="title">Annual Sales Reports</span>
            </a>
        </li>
    </ul>
</li>
                        

                <li>
                    <a href ="settings.php">
                        <span class ="icon"><i class="fa-solid fa-screwdriver-wrench"></i></span>
                        <span class ="title">System Settings</span>
                    </a>
                </li>

                
            </ul>
    </div>
 
        <div class="main1">
            

         
            <div class="topbar1">
                
                <div class="system">
                  
                <div class="toggle">
  <i class="fa-solid fa-bars"></i>
                </div>
                   <h4><?php echo $row['name']; ?> Ordering System</h4>
                  
                </div>
               
                 
                <div class="user"  data-toggle="tooltip" data-placement="top" title="Admin Settings">
                    <i class="fa-solid fa-circle-user" id="icon"></i>
                    <h4>Administrator</h4>
                    <h2>-</h2>
                    <h4><?php echo $rows['user_name']; ?></h4>
                    <i class="fa-solid fa-caret-down" onclick="show()" id="user"></i>
                    
                </div>
                
            </div>

            <!-- for admin settings -->
            <div class="settings" id="settings">
                        <ul>
                 
                   <a href="update-admin.php?id=<?php echo $id; ?>">   <li> <i class="fa-solid fa-gear"> </i>Update Account</li></a>
                <a href="logout.php" class = "log-out">    <li><i class="fa-solid fa-right-from-bracket"></i>Logout</li></a>
                        
                        </ul>
                    </div>
        </div>
      


    </div>
</div>
        
</div>
<div class="reports">
  
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
//    var b;
//    function clicked()
//    {
//     if (b==0)
//     {
//         document.getElementById("reports").style.display="none";
//         return b=1;
//     }
//     else
//     {
//         document.getElementById("reports").style.display="block";
//         return b=0;
//     }
//    }
//    document.addEventListener("click", function (event) {
//   var reportsDiv = document.getElementById("reports");
//   var reportDiv = document.getElementById("report");

  
//   if (event.target !== reportsDiv && event.target !== reportDiv) {
//     if (reportsDiv.style.display !== "none") {
//       reportsDiv.style.display = "none";
//       b = 1;
//     }
//   }
// });
   
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
  function toggleReports(event) {
        var reports = document.getElementById("reports");
        var caretIcon = document.getElementById("caret");

        if (reports.style.display === "none") {
            reports.style.display = "block";
            caretIcon.classList.remove("fa-caret-down");
            caretIcon.classList.add("fa-caret-up");
        } else {
            reports.style.display = "none";
            caretIcon.classList.remove("fa-caret-up");
            caretIcon.classList.add("fa-caret-down");
        }

        event.stopPropagation(); // Prevents the click event from propagating to the document
    }

    document.addEventListener("click", function (event) {
        var reports = document.getElementById("reports");
        var caretIcon = document.getElementById("caret");

        if (reports.style.display === "block" && !event.target.closest("#reports")) {
            reports.style.display = "none";
            caretIcon.classList.remove("fa-caret-up");
            caretIcon.classList.add("fa-caret-down");
        }
    });
  
</script>

