<?php include 'parts/menu2.php'; ?>
       
     
            
       <div class ="wrapper" id="wrapper">

          <div class="list">
              <?php 
                    if(isset($_POST['sort']))
                    {
                        $years=$_POST['year'];
                    }
                    else{
                        $years= date("Y");
                    }
              ?>
                <p>Annual Sales Report</p>
                <h3>Year <?php echo $years; ?></h3>
                <span>Search: <input type="search" name="search" id="search"></span>
                
            </div><form action="" method="POST">
            
                        <select name="year" id="month" required>
<option value="<?php  echo $years; ?>">Select Year</option>
<option value="2023">2023</option>
<option value="2024">2024</option>
<option value="2025">2025</option>
<option value="2026">2026</option>
<option value="2027">2027</option>
<option value="2028">2028</option>
<option value="2029">2029</option>
<option value="2030">2030</option>
<option value="2031">2031</option>
<option value="2032">2032</option>
<option value="2033">2033</option>
<option value="2034">2034</option>



            </select>
              <button class="srt" name="sort">Sort</button>
            </form>
            
          <a href="annual_print.php?year=<?php echo $years; ?>">   <button class="prt"><i class="fa-solid fa-print"></i> Print</button></a>
          <div class ="table-section1"  id="table2">
               

           <table class="table2">
             <colgroup>
                    <col width="5%">
					<col width="35%">
					<col width="25%">
					<col width="35%">
				</colgroup>


   
            <?php
                if(isset($_POST['sort']))
                {
                    $year=$_POST['year'];
                    $sn=1;
                    $query="SELECT MONTH(date) as monthly_orders, COUNT(*) as total_orders, SUM(total_amount) as total_sales from orders where YEAR(date) = $year and status != 0 group by MONTH(date)";
                    $result = $conn->query($query);
                    $count = mysqli_num_rows($result);
                    if ($count > 0) {
                        ?>
             <thead>  
                  
                  <th>No.</th>
                  <th>Month</th>
                  <th>Total Orders</th>
                  <th>Total Sales</th>
              
      </thead>

<?php
                        $orders = [];
                        while ($row = $result->fetch_assoc()) {
                            $orders[$row['monthly_orders']] = [
                                'total_orders' => $row['total_orders'],
                                'total_sales' => $row['total_sales'],
                            ];
                        }
                        foreach ($orders as $date => $order) {
                            $date1 = new DateTime("$year-$date-01");
                            $date1 = $date1->format('F');
                            ?>
                
                            <tbody  id="myTable">
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $date1; ?></td>
                                <td><?php echo $order['total_orders']; ?></td>
                                <td><?php echo number_format($order['total_sales'], 2); ?></td>
                            </tr>
                        </tbody>
                            <?php
                        }
                    }
                    else
                    {
                        { ?>
                            <div class = 'i'>'' No Annual Sales Yet ''</div>
                       <?php }
                    }
                }
                else
                {
                    $current_year = date("Y");
                    $sn=1;
                    $query="SELECT MONTH(date) as monthly_orders, COUNT(*) as total_orders, SUM(total_amount) as total_sales from orders where YEAR(date) =   $current_year and status != 0 group by MONTH(date)";
                    $result = $conn->query($query);
                    $count = mysqli_num_rows($result);
                    if ($count > 0) {
                        ?>
                        <thead>  
                             
                             <th>No.</th>
                             <th>Month</th>
                             <th>Total Orders</th>
                             <th>Total Sales</th>
                         
                 </thead>
           
           <?php
                        $orders = [];
                        while ($row = $result->fetch_assoc()) {
                            $orders[$row['monthly_orders']] = [
                                'total_orders' => $row['total_orders'],
                                'total_sales' => $row['total_sales'],
                            ];
                        }
                        foreach ($orders as $date => $order) {
                            $date1 = new DateTime("$current_year-$date-01");
                            $date1 = $date1->format('F');
                            ?>
                            
                            <tbody  id="myTable">
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $date1; ?></td>
                                <td><?php echo $order['total_orders']; ?></td>
                                <td><?php echo number_format($order['total_sales'], 2); ?></td>
                            </tr>
                        </tbody>
                            <?php
                        }
                    }  
                    else
                    {
                        { ?>
                            <div class = 'i'>'' No Annual Sales Yet ''</div>
                       <?php }
                    }
                }
                ?>

               





            
            
           </table>
          
       
                </div>
               
    <?php
      $query1 = "SELECT SUM(total_amount) as total_sales FROM orders WHERE year(date) = $years AND YEAR(date) and status!=0";
      $res1 = mysqli_query($conn, $query1);
      $row1 = mysqli_fetch_assoc($res1);
      ?>
    
           <div class="ta">
   <span> <h3>Monthly Total Sales</h3></span>
   <span class="amt"><h3>₱ <?php echo number_format(
       $row1['total_sales'],
       2
   ); ?></h3></span>
          

           </div>  
   
                
              
</div>
                   
</div>
<script src="toggle.js"></script>
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