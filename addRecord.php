<!DOCTYPE html>
<!-- These HTML and PHP script implementation that allows a user to input health data through a form, 
 submit it to the server, and store it in a MySQL database. -->
<head>
    <meta charset="utf-8" />
    <title>Add a New Record</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <header>
        <h1>My Healthy Data - Add a New Record</h1>
        <button onclick="window.location.href='home.php'" class="nav-button">Back to Home</button>
    </header>
    
    <div class="form" id="regForm">
        <fieldset>
            <legend>Input My Data Today</legend>
            <form name="register" action="addRecord.php" method="post">
                <input
                    name="time"
                    type="date"
                    placeholder="please select the record time"
                    required
                /><br />
                <input
                    name="bloodGlucose"
                    type="number"
                    placeholder="please enter your blood glucose level"
                    required
                /><br />
                <input
                    name="bloodPressure"
                    type="text"
                    placeholder="please enter your blood pressure"
                    required
                /><br />
                <input
                    name="weight"
                    type="number"
                    placeholder="please enter your weight"
                    required
                /><br />
                <input
                    name="exerciseDuration"
                    type="number"
                    placeholder="please enter your exercise duration"
                    required
                /><br />
                <input
                    name="eat"
                    type="text"
                    placeholder="What did you eat today?"
                    required
                /><br />
                <input name="submit" type="submit" />
            </form>
        </fieldset>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $time = $_POST['time'];
        $bloodGlucose = $_POST['bloodGlucose'];
        $bloodPressure = $_POST['bloodPressure'];
        $weight = $_POST['weight'];
        $exerciseDuration = $_POST['exerciseDuration'];
        $eat = $_POST['eat'];

        // Database connection
        $username = "root";
        $password = "%4zml54zml";
        $hostname = "localhost";
        $dbname = "myHealthyData";

        $conn = new mysqli($hostname, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("ERROR: Could not connect. " . $conn->connect_error);
        }

        $sql = "INSERT INTO DailyHealthRecords (record_date, blood_glucose_level, blood_pressure, weight_kg, exercise_duration_minutes, dietary_intake)
                VALUES ('$time', '$bloodGlucose', '$bloodPressure', '$weight', '$exerciseDuration', '$eat')";

        if ($conn->query($sql) === TRUE) {
            $message = "Record added successfully for $time.";
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
