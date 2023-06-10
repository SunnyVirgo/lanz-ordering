<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../fontawesome-free-6.1.2-web/fontawesome-free-6.1.2-web/css/all.css">
    <link rel="stylesheet" href= "newstyle.css">

</head>
<body>
    <div class ="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href ="#">
                        <span class ="icon"><i class="fa-solid fa-utensils"></i></span>
                        <span class ="title"><img src="../images/lanzlogo.png" class="logo" ></span>
                    </a>
                </li>

                <li>
                    <a href ="#">
                        <span class ="icon"><i class="fa-solid fa-chart-line"></i></span>
                        <span class ="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href ="#">
                        <span class ="icon"><i class="fa-solid fa-users-gear"></i></span>
                        <span class ="title">Accounts</span>
                    </a>
                </li>

                <li>
                    <a href ="#">
                        <span class ="icon">  <i class="fa-solid fa-cubes-stacked"></i></span>
                        <span class ="title">Categories</span>
                    </a>
                </li>

                <li>
                    <a href ="#">
                        <span class ="icon"><i class="fa-solid fa-pizza-slice"></i></span>
                        <span class ="title">Food</span>
                    </a>
                </li>

                <li>
                    <a href ="#">
                        <span class ="icon"><i class="fa-solid fa-right-from-bracket"></i></span>
                        <span class ="title">Logout</span>
                    </a>
                </li>
            </ul>
</div>
<div class="main">
    <div class="topbar">
        <div class="toggle">
            <i class="fa-solid fa-bars"></i>
        </div>
        <div class="search">
            <label>
                <input type="text" placeholder="Search here">
                <i class="fa-solid fa-magnifying-glass"></i>
            </label>
        </div>
        <div class="user">
              <img src="#">
        </div>
    </div>
</div>
</div>

<script>
    let list = document.querySelectorAll('.navigation li');
    function activeLink(){
        list.forEach((item) =>
        item.classList.remove('hovered'));
        this.classList.add('hovered');
    }
        list.forEach((item) =>
        item.addEventListener('mouseover',activeLink));
</script>
</body>
</html>