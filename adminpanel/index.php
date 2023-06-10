   <?php include 'parts/menu2.php'; ?>
<div class="wrapper1">
<div class="cardbox" id="card">
    

</div>


        <div class="details">
            <div class="recent-orders" id="myTable">
              
 
            </div>
         
        </div>
<?php if (isset($_GET['page'])): ?>
                    <div class="flash-data" data-flashdata="<? = $_GET['page']; ?>"></div>
                <?php endif; ?>
                  <?php if (isset($_GET['success4'])): ?>
                    <div class="flash-data9" data-flashdata="<? = $_GET['success4']; ?>"></div>
                <?php endif; ?>
                <?php if (isset($_GET['not-match'])): ?>
                    <div class="flash-data1" data-flashdata="<? = $_GET['not-match']; ?>"></div>
                <?php endif; ?>
                <?php if (isset($_GET['not-found'])): ?>
                    <div class="flash-data2" data-flashdata="<? = $_GET['not-found']; ?>"></div>
                <?php endif; ?>

</div>
<script>
 const flashdata = $('.flash-data').data('flashdata')
     if (flashdata) {
        Swal.fire({
            type: 'success',
            title: 'Login Success!',
            text: 'You logged in as ADMIN!',
            timer:3000,
            showConfirmButton:false
        }).then(function() {
            window.location = "index.php";
        })

     }
      const flashdata9 = $('.flash-data9').data('flashdata')
     if (flashdata9) {
        Swal.fire({
            type: 'success',
            title: 'Success!',
            confirmButtonColor: ' blue',
            text: 'Admin has been updated!',
             timer:3000,
            showConfirmButton:false
        
        }).then(function() {
            window.location = "index.php";
        })
     }
     const flashdata1 = $('.flash-data1').data('flashdata')
     if (flashdata1) {
        Swal.fire({
            type: 'error',
            title: 'Error!',
            confirmButtonColor: ' blue',
            text: 'Password did not match!',
             timer:3000,
            showConfirmButton:false
        
        }).then(function() {
            window.location = "update-admin.php";
        })
     }
     const flashdata2 = $('.flash-data2').data('flashdata')
     if (flashdata2) {
        Swal.fire({
            type: 'error',
            title: 'Error!',
            confirmButtonColor: ' blue',
            text: 'Password is incorrect!',
             timer:3000,
            showConfirmButton:false
        
        }).then(function() {
            window.location = "update-admin.php";
        })
     }


     let toggle=document.querySelector('.toggle');
     let nav=document.querySelector('.navigation1');
     let main=document.querySelector('.main1');
     let wrapper=document.querySelector('.wrapper1');

     toggle.onclick = function(){
        nav.classList.toggle('active')
        main.classList.toggle('active')
         wrapper.classList.toggle('active')
     }

      $(document).ready(function()
    {
          $("#myTable").load("order-table1.php");
       setInterval(function(){
          $("#myTable").load("order-table1.php");
         refresh();
        }, 10000);
    
});


      $(document).ready(function()
    {
          $("#card").load("dash.php");
       setInterval(function(){
          $("#card").load("dash.php");
         refresh();
        }, 10000);
    
});
</script>
