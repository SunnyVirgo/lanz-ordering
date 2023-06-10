<?php
include 'kitchennav.php'; ?>

  
<div class ="wrapper">

          <div class="list">
                <p>Order List</p>
                <span>Search: <input type="search" name="search" id="search"></span>

            </div>
         <div class ="table-section"  id="myTable">
                 
       

            <!-- end of box -->
              
            <!-- anotherbox -->
     
       

    </div>
             <?php if (isset($_GET['page'])): ?>
                    <div class="flash-data" data-flashdata="<? = $_GET['page']; ?>"></div>
                <?php endif; ?>     
           <?php if (isset($_GET['m'])): ?>
                    <div class="flash-data1" data-flashdata="<? = $_GET['m']; ?>"></div>
                <?php endif; ?>          
</div>

<script src="../adminpanel/toggle.js"></script>

<script>

    const flashdata = $('.flash-data').data('flashdata')
     if (flashdata) {
        Swal.fire({
            type: 'success',
            title: 'Login Success!',
            text: 'You logged in as Kitchen Staff!',
            timer:3000,
            showConfirmButton:false
        }).then(function() {
            window.location = "index.php";
        })

     }

     $(document).ready(function(){
    $('#search').keyup(function(){
        search_table($(this).val());
    });
    function search_table(value){
        $('#myTable .order-box').each(function(){
            var found = 'false';
            $(this).each(function(){
                if($(this).text().toLowerCase().indexOf(value.toLowerCase())>=0)
                {
                    found='true';
                }
            });
            if(found=='true'){
                $(this).show();
            }
            else{
                $(this).hide();
            }
        });
    }
  });

 

      const flashdata1 = $('.flash-data1').data('flashdata')
     if (flashdata1) {
        Swal.fire({
            type: 'success',
            title: 'Order Served!',
            confirmButtonColor: ' blue',
             timer:1000,
            showConfirmButton:false
        }).then(function() {
            window.location = "index.php";
        })
     }
         $(document).ready(function()
   {
     $("#myTable").load ("table.php");
      setInterval(function(){
          $("#myTable").load ("table.php");
          refresh();
        },10000);
    
});

</script>