<html>
<head>
    <title>My Healthy Data</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

<?php
/*connect to the MySQL database, receive health data records from the user, 
insert those records into the database, and retrieve and display
 the records in a table format on a webpage using PHP.*/
 
// Database connection parameters
$username = "root";
$password = "%4zml54zml";
$hostname = "localhost";
$dbname = "myHealthyData";
// Create a database connection
$conn = new mysqli($hostname, $username, $password, $dbname);
// Check if the database connection is successful
if ($conn->connect_error) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
echo "Successfully connected to the database.<br />";
// Check if the POST request is not empty
if (!empty($_POST)) {
    // Get the data from the POST request
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $bloodGlucose = mysqli_real_escape_string($conn, $_POST['bloodGlucose']);
    $bloodPressure = mysqli_real_escape_string($conn, $_POST['bloodPressure']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $exerciseDuration = mysqli_real_escape_string($conn, $_POST['exerciseDuration']);
    $eat = mysqli_real_escape_string($conn, $_POST['eat']);
// Build the SQL query to insert the data
    $sql = "INSERT INTO DailyHealthRecords (record_date, blood_glucose_level, blood_pressure, weight_kg, exercise_duration_minutes, dietary_intake)
            VALUES ('$time', '$bloodGlucose', '$bloodPressure', '$weight', '$exerciseDuration', '$eat')";
    // Execute the SQL query and check if it is successful
    if (mysqli_query($conn, $sql)) {
        echo "Record inserted successfully.<br />";
        echo "You've successfully recorded your data on $time!<br />";
    } else {
        echo "Could not execute $sql. " . mysqli_error($conn);
    }
}

// Fetch data
$data = [];
// Build the SQL query to fetch data
$sqlquery = "SELECT record_date, blood_glucose_level, blood_pressure, weight_kg, exercise_duration_minutes, dietary_intake FROM DailyHealthRecords ORDER BY record_date ASC";
// Execute the SQL query and check if it is successful
if ($result = mysqli_query($conn, $sqlquery)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    mysqli_free_result($result);
}

mysqli_close($conn);
?>

<h2>Daily Health Records</h2>
<table>
    <tr>
        <th>Record Date</th>
        <th>Blood Glucose Level</th>
        <th>Blood Pressure</th>
        <th>Weight (kg)</th>
        <th>Exercise Duration (minutes)</th>
        <th>Dietary Intake</th>
    </tr>
    <?php foreach ($data as $row): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['record_date']); ?></td>
            <td><?php echo htmlspecialchars($row['blood_glucose_level']); ?></td>
            <td><?php echo htmlspecialchars($row['blood_pressure']); ?></td>
            <td><?php echo htmlspecialchars($row['weight_kg']); ?></td>
            <td><?php echo htmlspecialchars($row['exercise_duration_minutes']); ?></td>
            <td><?php echo htmlspecialchars($row['dietary_intake']); ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
