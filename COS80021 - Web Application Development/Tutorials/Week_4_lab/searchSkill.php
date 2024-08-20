<?php
// Database connection parameters
$host = 'feenix-mariadb.swin.edu.au';
$user = 's104837257';
$pwd = '220899';
$sql_db = 's104837257_db';

$conn = new mysqli($host, $user, $pwd, $sql_db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch distinct cities, languages, and years for the select boxes
$cities = $conn->query("SELECT DISTINCT city FROM Employees");
$languages = $conn->query("SELECT DISTINCT language FROM Languages");
$years = $conn->query("SELECT DISTINCT years FROM Experience ORDER BY years");

if (isset($_POST['city']) && isset($_POST['language']) && isset($_POST['years'])) {
    // Get the selected values from the form
    $city = $_POST['city'];
    $language = $_POST['language'];
    $years = $_POST['years'];

    // SQL query to search for employees based on city, language, and years of experience
    $sql = "SELECT e.employee_id, e.last_name, e.first_name, e.city, l.language, exp.years
            FROM Employees e
            JOIN Experience exp ON e.employee_id = exp.employee_id
            JOIN Languages l ON exp.language_id = l.language_id
            WHERE e.city = '$city' AND l.language = '$language' AND exp.years >= $years";

    $result = $conn->query($sql);

    // Output the search results in a table
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>City</th>
                    <th>Language</th>
                    <th>Years of Experience</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['employee_id'] . "</td>
                    <td>" . $row['first_name'] . " " . $row['last_name'] . "</td>
                    <td>" . $row['city'] . "</td>
                    <td>" . $row['language'] . "</td>
                    <td>" . $row['years'] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No results found.";
    }
}

$conn->close();
?>

<!-- HTML form -->
<form action="SearchSkill.php" method="post">
    City: 
    <select name="city">
        <?php
        if ($cities->num_rows > 0) {
            while ($row = $cities->fetch_assoc()) {
                echo "<option value='" . $row['city'] . "'>" . $row['city'] . "</option>";
            }
        }
        ?>
    </select><br>

    Language: 
    <select name="language">
        <?php
        if ($languages->num_rows > 0) {
            while ($row = $languages->fetch_assoc()) {
                echo "<option value='" . $row['language'] . "'>" . $row['language'] . "</option>";
            }
        }
        ?>
    </select><br>

    Years of Experience: 
    <select name="years">
        <?php
        if ($years->num_rows > 0) {
            while ($row = $years->fetch_assoc()) {
                echo "<option value={$row['years']}>{$row['years']}</option>";
            }
        }
        ?>
    </select><br>

    <input type="submit" value="Search">
</form>
