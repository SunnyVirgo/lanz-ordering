<?php include 'parts/menu2.php'; ?>
       
     
            
       <div class ="wrapper" id="wrapper">
<?php
if(isset($_POST['sort']))
{   
        $year=$_POST['year'];
        $quarter = $_POST['quarter']; 
        $start_date = date('Y-m-d', strtotime("$year-01-01 + " . (($quarter-1)*3) . " months"));
        $end_date = date('Y-m-d', strtotime("$start_date + 2 months + 30 day"));
}
else{
    $year=date('Y');
    $quarter=1;
    $start_date = date('Y-m-d', strtotime("$year-01-01 + " . (($quarter-1)*3) . " months"));
    $end_date = date('Y-m-d', strtotime("$start_date + 2 months + 30 day"));
}
if($quarter == 1)
{
   $name = "First";
}
elseif ($quarter == 2) 
{
    $name = "Second";
}
elseif ($quarter == 3) 
{
    $name = "Third";
}
else
{
    $name = "Fourth";
}
?>
          <div class="list">
              
                <p>Quarter Sales Report</p>
                <h3><?php
                    echo $name;
            
                ?> Quarter of <?php echo $year; ?></h3>
                <span>Search: <input type="search" name="search" id="search"></span>
                
            </div><form action="" method="POST">
        <select name="quarter" id="month" required>
<option value="0">Quarter</option>
<option value="1">First Quarter</option>
<option value="2">Second Quarter</option>
<option value="3">Third Quarter</option>
<option value="4">Fourth Quarter</option>
        </select>
            
         <select name="year" id="month" required>
<option value="0">Select Year</option>
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
            
          <a href="quarter_print.php?start=<?php echo $start_date; ?> & end=<?php echo $end_date; ?> & quarter=<?php echo $quarter; ?>">   <button class="prt"><i class="fa-solid fa-print"></i> Print</button></a>
          <div class ="table-section1"  id="table2">
               

           <table class="table2">
             <colgroup>
                    <col width="5%">
					<col width="35%">
					<col width="25%">
					<col width="35%">
				</colgroup>



            <tbody  id="myTable">
<?php
if(isset($_POST['sort']))
{
   
    $year=$_POST['year'];
    $quarter = $_POST['quarter'];
    $sn=1;

   

    $query = "SELECT date as date, count(*) as total_sales, sum(total_amount) as t_amount FROM orders 
          WHERE date between '$start_date' AND '$end_date' and status != 0 group by date";
          $result=mysqli_query($conn, $query);
        $count=mysqli_num_rows($result);
        if($count > 0)
        
        {
            ?>
            <thead>  
                          
                          <th>No.</th>
                          <th>Date</th>
                          <th>Total Orders</th>
                          <th>Total Sales</th>
                      
              </thead>
            <?php
            while($row=mysqli_fetch_assoc($result))
            {
              $date = $row['date'];
              $date1 = new DateTime($date);
              $date1 =$date1->format('F d, Y');
            ?>
  
  
                                      <tr>
                                          <td><?php echo $sn++; ?></td>
                                          <td><?php echo $date1; ?></td>
                                          <td><?php echo $row['total_sales']; ?></td>
                                          <td><?php echo number_format($row['t_amount'],2); ?></td>
                                        
                                      </tr>
                                       
                                
  <?php
            }
        }
        else{
            ?>
                <div class = 'i'>'' No Quarter Sales Yet ''</div>
           <?php 
        }
         
}
else
{
    $sn=1;

    $start_date = date('Y-m-d', strtotime("$year-01-01 + " . (($quarter-1)*3) . " months"));
    $end_date = date('Y-m-d', strtotime("$start_date + 2 months + 30 day"));

    $query = "SELECT date as date, count(*) as total_sales, sum(total_amount) as t_amount FROM orders 
          WHERE date >= '$start_date' AND date <= '$end_date' and status != 0 group by date";
          $result=mysqli_query($conn, $query);
           ?>
            <thead>  
                          
                          <th>No.</th>
                          <th>Date</th>
                          <th>Total Orders</th>
                          <th>Total Sales</th>
                      
              </thead>
            <?php
          while($row=mysqli_fetch_assoc($result))
          {
            $date = $row['date'];
            $date1 = new DateTime($date);
            $date1 =$date1->format('F d, Y');
          ?>


                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $date1; ?></td>
                                        <td><?php echo $row['total_sales']; ?></td>
                                        <td><?php echo number_format($row['t_amount'],2); ?></td>
                                      
                                    </tr>
                                     
                              
<?php
          }
}

?>

</tbody>

               


  
               
           </table>
          
       
                </div>
              <?php
                 $start_date = date('Y-m-d', strtotime("$year-01-01 + " . (($quarter-1)*3) . " months"));
                 $end_date = date('Y-m-d', strtotime("$start_date + 2 months + 30 day"));
                 $query1 = "SELECT SUM(total_amount) as total_sales FROM orders  WHERE date >= '$start_date' AND date <= '$end_date' and status != 0 ";
                 $res1 = mysqli_query($conn, $query1);
                 $row1 = mysqli_fetch_assoc($res1);
                 ?>
       
           <div class="ta">
   <span> <h3>Total Sales</h3></span>
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