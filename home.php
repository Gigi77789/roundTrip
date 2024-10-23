<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>My Healthy Data - Home</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    
</head>
<body>
    <header>
        <h1>My Healthy Data Record</h1>
        <button id="homeBtn" class="nav-button">My Healthy Data</button>
        <button id="addBtn" class="nav-button" onclick="window.location.href='addRecord.php'">Add a New Record</button>
        <button id="deleteBtn" class="nav-button">Delete a Record</button>
    </header>

    <?php
    // If 'message' parameter exists in URL, display the message (the feedback of adding data or deleting data)
    if (isset($_GET['message'])) {
        echo '<div class="message">' . htmlspecialchars($_GET['message']) . '</div>';
    }
    ?>
    <!-- Delete record form, hidden by default -->
    <div class="form" id="deleteForm" style="display:none;">
        <fieldset>
            <legend>Deleting a Row</legend>
             <!-- Input field to select the record date to delete -->
            <form name="delRow" action="deleteRow.php" method="post">
                <input
                    name="record_date"
                    type="date"
                    placeholder="Select a date you want to delete"
                    required
                /><br />
                <input name="submitDelete" type="submit" />
            </form>
        </fieldset>
    </div>

    <div>
        <h2>My Healthy Data</h2>
        <table>
            <thead>
                <tr>
                    <th>Record Date</th>
                    <th>Blood Glucose Level(preprandial)</th>
                    <th>Blood Pressure</th>
                    <th>Weight (kg)</th>
                    <th>Exercise Duration (minutes)</th>
                    <th>Dietary Intake</th>
                </tr>
            </thead>
            <tbody>
            <?php
    // Database connection parameters
    $username = "root";
    $password = "%4zml54zml";
    $hostname = "localhost";
    $dbname = "myHealthyData";

    // Create database connection
    $conn = new mysqli($hostname, $username, $password, $dbname);
    // Check if connection is successful
    if ($conn->connect_error) {
        die("ERROR: Could not connect. " . $conn->connect_error);
    }
     // Select record date, blood glucose level, blood pressure, weight, exercise duration, and dietary intake, ordered by record date in ascending order
    $sqlquery = "SELECT record_date, blood_glucose_level, blood_pressure, weight_kg, exercise_duration_minutes, dietary_intake FROM DailyHealthRecords ORDER BY record_date ASC";
    if ($result = $conn->query($sqlquery)) {
        // Loop through query results
        while ($row = $result->fetch_assoc()) {
             // Get the blood glucose level 
            $glucoseLevel = $row['blood_glucose_level'];
            $bloodPressure = $row['blood_pressure'];
            // Parse the blood pressure value into two parts: systolic and diastolic
            list($systolic, $diastolic) = explode('/', $bloodPressure);
            
            // Set blood glucose color: early diabetes target is fasting 80-130 mg/dL, postprandial less than 180 mg/dL， I learned from https://brightwhiz.com/php-ternary-operator-examples/
            $glucoseColor = ($glucoseLevel < 80 || $glucoseLevel > 180) ? 'red' : 'black';

            // Set blood pressure color: early diabetes target is less than 140/90 mmHg
            $pressureColor = ($systolic >= 140 || $diastolic >= 90) ? 'red' : 'black';
            // Output table row, displaying record date, blood glucose level, blood pressure, weight, exercise duration, and dietary intake. 
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['record_date']) . "</td>";
            echo "<td style='color: $glucoseColor'>" . htmlspecialchars($glucoseLevel) . "</td>";
            echo "<td style='color: $pressureColor'>" . htmlspecialchars($row['blood_pressure']) . "</td>";
            echo "<td>" . htmlspecialchars($row['weight_kg']) . "</td>";
            echo "<td>" . htmlspecialchars($row['exercise_duration_minutes']) . "</td>";
            echo "<td>" . htmlspecialchars($row['dietary_intake']) . "</td>";
            echo "</tr>";
        }
        // Releasing these resources allows the database to handle other requests more efficiently.
        $result->free();
    }
    // Close database connection
    $conn->close();
?>

            </tbody>
        </table>
    </div>

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <!-- Include DataTables JavaScript： To prevent users from having difficulty finding their desired data among many records, 
     I introduced DataTables, a jQuery plugin. It enables table sorting, adds search functionality, pagination, and dynamic display of row counts.
     I learned from：https://datatables.net/manual/ https://riptutorial.com/datatables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    
    <script src="script.js"></script>
</body>
</html>
