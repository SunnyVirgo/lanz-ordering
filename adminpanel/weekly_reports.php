<?php include 'parts/menu2.php'; ?>
       
     
<div class ="wrapper" id="wrapper">  
<?php
// Connect to the database

// Check if week, month and year input were submitted
if(isset($_POST['submit'])) {
  // Get the start and end dates for the selected week
  $week = $_POST['week'];
  $month = $_POST['month'];
  $year = $_POST['year'];
  $start_date = date('Y-m-d', strtotime("$year-$month-W$week"));
  $end_date = date('Y-m-d', strtotime("$year-$month-W$week +6 days"));

  // Retrieve data for the selected week
  $sql = "SELECT * FROM orders WHERE date >= '$start_date' AND date <= '$end_date'";
  $result = mysqli_query($conn, $sql);

  // Display the report
  echo "<h1>Weekly Report for Week $week of $month $year</h1>";
  echo "<table>";
  echo "<tr><th>Column 1</th><th>Column 2</th></tr>";

  // Process the data
  while ($row = mysqli_fetch_assoc($result)) {
    // process the row as needed
    echo "<tr><td>{$row['tcode']}</td><td>{$row['total_amount']}</td></tr>";
  }
  echo "</table>";
}

// Display the form to input the week, month, and year
echo "<h1>Select a Week, Month, and Year</h1>";
echo "<form method='post'>";
echo "<label for='week'>Week:</label>";
echo "<input type='week' name='week' required>";
echo "<br>";
echo "<label for='month'>Month:</label>";
echo "<input type='month' name='month' required>";
echo "<br>";
echo "<label for='year'>Year:</label>";
echo "<input type='number' name='year' min='1900' max='2100' step='1' value='".date("Y")."' required>";
echo "<br>";
echo "<input type='submit' name ='submit' value='Generate Report'>";
echo "</form>";
?>

</div>