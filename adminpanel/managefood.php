
 <?php include 'parts/menu2.php'; ?>
            
          
        <div class ="wrapper">

         
          <div class="list">
                <p>List of Foods</p>
                 <a href = "addfood.php" class ="btn-primary"><i class=" fa-solid fa-plus"></i>  Add Menu</a>
            </div>
<div class="header">
    <div>
    <tr>
        <td class="s">Search:</td>
    <td><input type="search" name="search" id="search" class="search-input"></td>
    </tr>
    </div>
    <div>
    <?php
                // $recordsPerPage = 10; // Change this value to the desired number of records per page
                // $pageNumber = isset($_GET['page']) ? $_GET['page'] : 1;
                // $offset = ($pageNumber - 1) * $recordsPerPage;
                  
                  // Query to retrieve a specific page of records
                    
                    // Query to retrieve a specific page of records
                    $sql = "SELECT * FROM tbl_food ORDER BY date_created DESC ";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    $sn = 1;


                    // $sqlCount = "SELECT COUNT(*) AS total FROM tbl_food";
                    // $resCount = mysqli_query($conn, $sqlCount);
                    // $rowCount = mysqli_fetch_assoc($resCount)['total'];
                    // $totalPages = ceil($rowCount / $recordsPerPage);
                
                    // $visiblePages = 5; // Number of visible page links
                    // $halfVisible = ($visiblePages - 1) / 2;
                
                    // echo '<div class="pagination">';
                    // if ($pageNumber > 1) {
                    //     echo '<a href="?page=' . ($pageNumber - 1) . '" class="prev">Previous</a>';
                    // }
                
                    // $startPage = max($pageNumber - $halfVisible, 1);
                    // $endPage = min($startPage + $visiblePages - 1, $totalPages);
                    // $startPage = max($endPage - $visiblePages + 1, 1);
                
                    // for ($i = $startPage; $i <= $endPage; $i++) {
                    //     $activeClass = ($i == $pageNumber) ? 'active' : '';
                    //     echo '<a href="?page=' . $i . '" class="' . $activeClass . '">' . $i . '</a>';
                    // }
                
                    // if ($pageNumber < $totalPages) {
                    //     echo '<a href="?page=' . ($pageNumber + 1) . '" class="next">Next</a>';
                    // }
           ?>
    </div>
   
</div>       
                <div class ="table-section">
                    
           <table class="table2">
            <colgroup>
					<col width="3%">
					<col width="25%">
					<col width="10%">
					<col width="10%">
					<col width="7%">
                    <col width="10%">
                    <col width="10%">
                    <col width="20%">
				</colgroup>
                <?php


            if ($count > 0) {
                ?>
 <thead>  
                  <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Servings</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th>Actions</th>
                  </tr>  
            </thead>
                <?php
                while ($rows = mysqli_fetch_assoc($res)) {

                    $id = $rows['id'];
                    $food_name = $rows['food_name'];
                    $size = $rows['size'];
                    $stocks = $rows['stocks'];
                    $price = $rows['price'];
                    $image_name = $rows['image_name'];
                    $featured = $rows['featured'];
                    $deleted = $rows['deleted'];
                    ?>
                                <tbody  id="myTable">
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $food_name; ?></td>
                                        <td><?php echo $size; ?></td>
                                        <td>₱ <?php echo number_format(
                                            $price,
                                            2
                                        ); ?></td>
                                        <td><?php echo $stocks; ?></td>
                                     
                                        <td><?php if ($stocks <= 0) {
                                            $sql2 = "UPDATE tbl_food SET featured = 'No' WHERE id=$id ";

                                            $res2 = mysqli_query($conn, $sql2);
                                            $newfeatured = $rows['featured'];
                                            echo $newfeatured;
                                        } else {
                                            echo $featured;
                                        } ?></td>
                                        <td><?php if ($stocks > 0 || $deleted = 0 ) { ?>
                                        <div class="status">Available</div>
                                        <?php } else { ?>
                                        <div class="status-not">Unavailable</div>
                                        <?php } ?></td>
                                    
                                        <td> <a href = "viewfood.php ?id=<?php echo $id; ?>" class ="view-btn" data-toggle="tooltip" data-placement="top" title="View Details"><i class="fa-solid fa-eye"></i> </a>
                                        
                                                <a href = "updatefood.php ?id=<?php echo $id; ?>" class ="update-btn"  data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                                   
                                     
                                           
                                                  <?php if (
                                                      $rows['deleted'] == 1
                                                  ) { ?>
                                                  <a href = "deletefood.php ?id1=<?php echo $id; ?>" class ="delete-btn" data-toggle="tooltip" data-placement="top" title="Click to Enable"><i class="fa-solid fa-x"></i></a>
                                            <?php } else { ?>
                                                  <a href = "deletefood.php ?id=<?php echo $id; ?>" class ="dis-btn"  data-toggle="tooltip" data-placement="top" title="Click to Disable"><i class="fa-solid fa-check"></i></a>
                                            <?php } ?>
                                                
                                        
                                        </td>
                                    </tr>
                                </tbody>

                                <?php
                            
                }
         
            } else {
                 ?>
                            
                                <div class = 'no-orders'> No food added yet!</div>
                          
                        <?php
            }
      
            ?>

                 

                   
               
           </table>
   
           <?php if (isset($_GET['n'])): ?>
                    <div class="flash-data1" data-flashdata="<? = $_GET['n']; ?>"></div>
                <?php endif; ?>
                 <?php if (isset($_GET['fail'])): ?>
                    <div class="flash-data2" data-flashdata="<? = $_GET['fail']; ?>"></div>
                <?php endif; ?>
                <?php if (isset($_GET['fails'])): ?>
                    <div class="flash-data4" data-flashdata="<? = $_GET['fails']; ?>"></div>
                <?php endif; ?>
                 <?php if (isset($_GET['success'])): ?>
                    <div class="flash-data" data-flashdata="<? = $_GET['success']; ?>"></div>
                <?php endif; ?>
                <?php if (isset($_GET['fail1'])): ?>
                    <div class="flash-data3" data-flashdata="<? = $_GET['fail1']; ?>"></div>
                <?php endif; ?>
                 <?php if (isset($_GET['fail2'])): ?>
                    <div class="flash-data5" data-flashdata="<? = $_GET['fail2']; ?>"></div>
                <?php endif; ?>
                 <?php if (isset($_GET['success1'])): ?>
                    <div class="flash-data6" data-flashdata="<? = $_GET['success1']; ?>"></div>
                <?php endif; ?>
                 <?php if (isset($_GET['fail3'])): ?>
                    <div class="flash-data7" data-flashdata="<? = $_GET['fail3']; ?>"></div>
                <?php endif; ?>
                </div>
                   
                                      
    
</div>
            
            
   <script src="toggle.js"></script>
   <script src="sort.js"></script>
  

<script>
       $('.delete-btn').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href')

        Swal.fire({
            title: 'Enable Food?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'blue',
            cancelButtonColor: 'red',
            confirmButtonText:'Enable',
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    })

     $('.dis-btn').on('click', function(f) {
        f.preventDefault();
        const href = $(this).attr('href')

        Swal.fire({
            title: 'Disable Food?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'blue',
            cancelButtonColor: 'red',
            confirmButtonText:'Disable',
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    })

     const flashdata1 = $('.flash-data1').data('flashdata')
     if (flashdata1) {
        Swal.fire({
            type: 'success',
            title: 'Success!',
            confirmButtonColor: ' blue',
            text: 'Food has been updated!',
            timer:3000,
            showConfirmButton:false
        }).then(function() {
            window.location = "managefood.php";
        })
     }
      const flashdata2 = $('.flash-data2').data('flashdata')
     if (flashdata2) {
        Swal.fire({
            type: 'error',
            title: 'Oppps!',
            confirmButtonColor: ' blue',
            text: 'Failed to remove image!',
            timer:3000,
            showConfirmButton:false
        }).then(function() {
            window.location = "managefood.php";
        })
    }
     const flashdata4 = $('.flash-data4').data('flashdata')
     if (flashdata4) {
        Swal.fire({
            type: 'error',
            title: 'Oppps!',
            confirmButtonColor: ' blue',
            text: 'Food Category is Disabled!',
            timer:3000,
            showConfirmButton:false
        }).then(function() {
            window.location = "managefood.php";
        })
     }
      const flashdata = $('.flash-data').data('flashdata')
     if (flashdata) {
        Swal.fire({
            type: 'success',
            title: 'Success!',
            confirmButtonColor: ' blue',
            text: 'Food has been updated!',
            timer:3000,
            showConfirmButton:false
        }).then(function() {
            window.location = "managefood.php";
        })
     }
     const flashdata3 = $('.flash-data3').data('flashdata')
     if (flashdata3) {
        Swal.fire({
            type: 'error',
            title: 'Oppps!',
            confirmButtonColor: ' blue',
            text: 'Failed to upload image!',
            timer:3000,
            showConfirmButton:false
        }).then(function() {
            window.location = "managefood.php";
        })
     }
     const flashdata5 = $('.flash-data5').data('flashdata')
     if (flashdata5) {
        Swal.fire({
            type: 'error',
            title: 'Oppps!',
            confirmButtonColor: ' blue',
            text: 'Failed to update food!',
            timer:3000,
            showConfirmButton:false
        }).then(function() {
            window.location = "managefood.php";
        })
     }
     const flashdata6 = $('.flash-data6').data('flashdata')
     if (flashdata6) {
        Swal.fire({
            type: 'success',
            title: 'Success!',
            confirmButtonColor: ' blue',
            text: 'Food has been added!',
            timer:3000,
            showConfirmButton:false
        }).then(function() {
            window.location = "managefood.php";
        })
     }
     const flashdata7 = $('.flash-data7').data('flashdata')
     if (flashdata7) {
        Swal.fire({
            type: 'error',
            title: 'Error!',
            confirmButtonColor: ' blue',
            text: 'Failed to add food!',
            timer:3000,
            showConfirmButton:false
        }).then(function() {
            window.location = "managefood.php";
        })
     }

      $(document).ready(function(){
    $('#search').keyup(function(){
        search_table($(this).val());
    });
    function search_table(value){
        $('#myTable tr').each(function(){
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

  $(document).ready(function(){
    $('a').tooltip();
  })


 
</script>


    <script src="sort.js"></script>     
    </body>
</html>