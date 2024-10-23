<html>
   
   <head>
      <title>Delete a record from MySQL Database</title>
   </head>
   
   <body>
   
   <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $record_date = $_POST['record_date'];

    // Database connection
    $username = "root";
    $password = "%4zml54zml";
    $hostname = "localhost";
    $dbname = "myHealthyData";

    $conn = new mysqli($hostname, $username, $password, $dbname);
    // Execute the SQL query and check if it is successful
    if ($conn->connect_error) {
        die("ERROR: Could not connect. " . $conn->connect_error);
    }
    // Build the SQL query to delete the record
    $sql = "DELETE FROM DailyHealthRecords WHERE record_date='$record_date'";
    // Execute the SQL query and check if it is successful
    if ($conn->query($sql) === TRUE) {
        $message = "Record deleted successfully for $record_date.";
        header("Location: home.php?message=" . urlencode($message));
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>


    </body>
</html>