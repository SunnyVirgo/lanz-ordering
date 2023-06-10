
 <?php include 'parts/menu2.php'; ?>
            
          
        <div class ="wrapper">

          <div class="list">
                <p>List of Categories</p>
                   <a href = "addcategory.php" class ="btn-primary"><i class=" fa-solid fa-plus"></i>  Add Category</a>
            </div>
<div class="header">
    <tr>
        <td class="s">Search:</td>
    <td><input type="search" name="search" id="search" class="search-input"></td>
    </tr>
</div>       
                <div class ="table-section">
                    
           <table class="table2">
            <colgroup>
					<col width="10%">
					<col width="40%">
					<col width="20%">
					<col width="10%">
                    <col width="20%">
			
            <?php
            $sql = 'SELECT * FROM food_category';

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            $sn = 1;

            if ($count > 0) {
                ?>
	</colgroup>
              <thead>  
                  
                        <th>Number</th>
                        <th>Name</th>
                        <th>Date Created</th>
                        <th>Status</th>
                        <th>Actions</th>
                    
            </thead>
                <?php
                while ($rows = mysqli_fetch_assoc($res)) {


                    $id = $rows['id'];
                    $category_name = $rows['category_name'];
                    $date = $rows['date_created'];
                    $deleted = $rows['deleted'];
                    ?>
                                <tbody id="myTable">
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $category_name; ?></td>
                                      <td><?php echo $date; ?></td>
                                      <td><?php if ($deleted ==0) { ?>
                                        <div class="status">Enabled</div>
                                        <?php } else { ?>
                                        <div class="status-not">Disabled</div>
                                        <?php } ?></td>
                                        <td>
                                        
                                                <a href = " updatecategory.php ?id=<?php echo $id; ?>" class="update-btn" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                         
                                                 <?php if (
                                                     $rows['deleted'] == 1
                                                 ) { ?>
                                                  <a href = "deletecategory.php ?id1=<?php echo $id; ?>" class ="delete-btn" data-toggle="tooltip" data-placement="top" title="Click to Enable"><i class="fa-solid fa-x"></i></a>
                                            <?php } else { ?>
                                                  <a href = "deletecategory.php ?id=<?php echo $id; ?>" class ="dis-btn"  data-toggle="tooltip" data-placement="top" title="Click to Disable"><i class="fa-solid fa-check"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </tbody>

                                <?php
                }
            } else {
                 ?>
               
                                <div class = 'no-orders'> No category added yet!</div>
                     
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
                <?php if (isset($_GET['not-found'])): ?>
                    <div class="flash-data" data-flashdata="<? = $_GET['not-found']; ?>"></div>
                <?php endif; ?>
                <?php if (isset($_GET['fail1'])): ?>
                    <div class="flash-data3" data-flashdata="<? = $_GET['fail1']; ?>"></div>
                <?php endif; ?>
                <?php if (isset($_GET['fail2'])): ?>
                    <div class="flash-data5" data-flashdata="<? = $_GET['fail2']; ?>"></div>
                <?php endif; ?>
                 <?php if (isset($_GET['success'])): ?>
                    <div class="flash-data6" data-flashdata="<? = $_GET['success']; ?>"></div>
                <?php endif; ?>
                <?php if (isset($_GET['success1'])): ?>
                    <div class="flash-data7" data-flashdata="<? = $_GET['success1']; ?>"></div>
                <?php endif; ?>
                  <?php if (isset($_GET['fail3'])): ?>
                    <div class="flash-data8" data-flashdata="<? = $_GET['fail3']; ?>"></div>
                <?php endif; ?>
    </div>
            
                   
    </div>
   <script src="toggle.js"></script>
<script>
    $('.delete-btn').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href')

        Swal.fire({
            title: 'Enable Category?',
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
            title: 'Disable Category?',
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
            text: 'Category has been updated!',
            timer:3000,
            showConfirmButton:false
        }).then(function() {
            window.location = "managecategory.php";
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
            window.location = "managecategory.php";
        })
    }
     const flashdata4 = $('.flash-data4').data('flashdata')
     if (flashdata4) {
        Swal.fire({
            type: 'error',
            title: 'Oppps!',
            confirmButtonColor: ' blue',
            text: 'Failed to delete!',
            timer:3000,
            showConfirmButton:false
        }).then(function() {
            window.location = "managecategory.php";
        })
     }
     const flashdata = $('.flash-data').data('flashdata')
     if (flashdata) {
        Swal.fire({
            type: 'error',
            title: 'Oppps!',
            confirmButtonColor: ' blue',
            text: 'Category not found!',
            timer:3000,
            showConfirmButton:false
        }).then(function() {
            window.location = "managecategory.php";
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
            window.location = "managecategory.php";
        })
     }
      const flashdata5 = $('.flash-data5').data('flashdata')
     if (flashdata5) {
        Swal.fire({
            type: 'error',
            title: 'Oppps!',
            confirmButtonColor: ' blue',
            text: 'Failed to update category!',
            timer:3000,
            showConfirmButton:false
        }).then(function() {
            window.location = "managecategory.php";
        })
     }
      const flashdata6 = $('.flash-data6').data('flashdata')
     if (flashdata6) {
        Swal.fire({
            type: 'success',
            title: 'Success!',
            confirmButtonColor: ' blue',
            timer: 2000,
            text: 'Category has been updated!',
            timer:3000,
            showConfirmButton:false
        }).then(function() {
            window.location = "managecategory.php";
        })
     }
     const flashdata7 = $('.flash-data7').data('flashdata')
     if (flashdata7) {
        Swal.fire({
            type: 'success',
            title: 'Success!',
            confirmButtonColor: ' blue',
            text: 'Category has been added!',
            timer:3000,
            showConfirmButton:false
        }).then(function() {
            window.location = "managecategory.php";
        })
     }
      const flashdata8 = $('.flash-data8').data('flashdata')
     if (flashdata8) {
        Swal.fire({
            type: 'error',
            title: 'Oppps!',
            confirmButtonColor: ' blue',
            text: 'Failed to add category!',
            timer:3000,
            showConfirmButton:false
        }).then(function() {
            window.location = "managecategory.php";
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



        