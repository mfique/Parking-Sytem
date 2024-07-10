<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="search_vehicle.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: auto;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        h3 {
            margin-top: 40px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        td {
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Search Results</h2>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "vehicle_parking_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
            $searchTerm = $conn->real_escape_string($_POST['searchTerm']);

            $sql = "SELECT * FROM vehicles WHERE license_plate LIKE '%$searchTerm%'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<h3>Search Results:</h3>";
                echo "<table>";
                echo "<tr><th>Owner's Name</th><th>License Plate</th><th>Vehicle Type</th><th>Manufactured Country</th><th>Entry Time</th><th>Exit Time</th><th>Parking Charge</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['owner_name']}</td>";
                    echo "<td>{$row['license_plate']}</td>";
                    echo "<td>{$row['vehicle_type']}</td>";
                    echo "<td>{$row['manufactured_country']}</td>";
                    echo "<td>{$row['entry_time']}</td>";
                    echo "<td>{$row['exit_time']}</td>";
                    echo "<td>{$row['parking_charge']}</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No vehicles found with the license plate: " . htmlspecialchars($searchTerm) . "</p>";
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
