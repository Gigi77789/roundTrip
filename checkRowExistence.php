<html>
<!--To check if a specific date record exists in the MySQL database for the purpose of deleting it-->
   <head>
      <title>Check if a record exists in MySQL Database</title>
   </head>
   <body>
   
   <?php
$username = "root";
$password = "%4zml54zml";
$hostname = "localhost";
$dbname = "myHealthyData";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
echo "Successfully connected to the database.<br />";

if (!empty($_POST['record_date'])) {
    $record_date = mysqli_real_escape_string($conn, $_POST['record_date']);
    
    $result = mysqli_query($conn, "SELECT record_date FROM DailyHealthRecords WHERE record_date='$record_date'");
    $row_count = $result->num_rows;
    echo "Result set has $row_count number of rows.<br />";
    
    if ($row_count > 0) {
        echo "Row exists.";
    } else {
        echo "Sorry, $record_date does not exist in the database.";
    }
} else {
    echo "No record date provided.";
}

$conn->close();
?>

    </body>
</html>