<?php
include 'cashiernav.php'; ?>
 
<div class ="wrapper" id="wrapper">

          <div class="list">
                <p>Daily Sales Report</p>
                <span>Search: <input type="search" name="search" id="search"></span>
            
            </div>
            <a href="greport.php?date=<?php echo date(
                'Y/m/d'
            ); ?>"> <button class="prt"><i class="fa-solid fa-print"></i> Print</button> </a>
          <div class ="table-section1"  >
                   
          
          <?php
          $date = date('Y/m/d');

          $sql = "SELECT * FROM orders WHERE status!=0  AND date='$date' order by update_time DESC";

          $res = mysqli_query($conn, $sql);

          $count = mysqli_num_rows($res);

          $sn = 1;

          if ($res == true) {
              $rows = mysqli_num_rows($res);
              $sn = 1;
              if ($count > 0) { ?>
                        <table class="table2">
            <colgroup>
					<col width="5%">
					<col width="16%">
					<col width="10%">
					<col width="15%">
					<col width="10%">
                    <col width="14%">
                    <col width="12%">
                    <col width="9%">
                    <col width="9%">
				</colgroup>
              <thead>  
                  
                        
                        <th>No.</th>
                        <th>Transaction Code</th>
                        <th>Time</th>
                        <th>Customer Name</th>
                        <th>Table No.</th>
                        <th>Processed By</th>
                        <th>Total</th>
                        <th>Cash</th>
                        <th>Change</th>
                    
            </thead>
            <?php while ($rows = mysqli_fetch_assoc($res)) {

                $id = $rows['id'];
                $tcode = $rows['tcode'];
                $time = $rows['update_time'];
                $new_time = date('g:i A', strtotime($time));
                $name = $rows['name'];
                $pby = $rows['cashier'];
                $table = $rows['table'];
                $total = $rows['total_amount'];
                $tendered = $rows['tendered_amount'];
                $change = $rows['change_amount'];
                ?>
                             
                         
                                <tbody  id="myTable">
                                    <tr>
                                       <td><?php echo $sn++; ?></td>
                                        <td><?php echo $tcode; ?></td>
                                        <td><?php echo $new_time; ?></td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo $table; ?></td>
                                        <td><?php echo $pby; ?></td>
                                        <td><?php echo number_format(
                                            $total,
                                            2
                                        ); ?></td>
                                        <td><?php echo number_format(
                                            $tendered,
                                            2
                                        ); ?></td>
                                        <td><?php echo number_format(
                                            $change,
                                            2
                                        ); ?></td>
                                    </tr>
                                     
                                </tbody>


                          </td>
                                <?php
            }} else { ?>
                          
                                <div class = 'i'>'' No Daily Sales Yet ''</div>
                            
                        <?php }
          }
          ?>
               
           </table>
          
       
                </div>
                <?php
                $sql2 = "SELECT SUM(total_amount)  AS sum from orders where date='$date' and status!=0";
                $res2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_num_rows($res2);
                $row2 = mysqli_fetch_assoc($res2);

                $total = $row2['sum'];
                ?>   
           <div class="ta">
   <span> <h3>Daily Total Sales</h3></span>
   <span class="amt"><h3>₱ <?php echo number_format($total, 2); ?></h3></span>
          

           </div>                           
    
</div>
                   
</div>

<script src="../adminpanel/toggle.js"></script>


<script>

      
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


</script>