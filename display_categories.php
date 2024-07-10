<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Categories</title>
    <link rel="stylesheet" href="manage_categories.css">
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
        .message {
            text-align: center;
            margin: 20px 0;
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Existing Categories</h2>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "vehicle_parking_db";

        $conn = new mysqli($servername, $username, $password, $dbname);


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['categoryName'])) {

            $categoryName = $conn->real_escape_string($_POST['categoryName']);


            $sql = "INSERT INTO categories (category_name) VALUES ('$categoryName')";

            if ($conn->query($sql) === TRUE) {
                echo "<p class='message'>New category added successfully</p>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        $sql_fetch_categories = "SELECT * FROM categories";
        $result = $conn->query($sql_fetch_categories);

        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Category ID</th>";
        echo "<th>Category Name</th>";
        echo "<th>Created At</th>";
        echo "<th>Actions</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["category_id"] . "</td>";
                echo "<td>" . $row["category_name"] . "</td>";
                echo "<td>" . $row["created_at"] . "</td>";
                echo "<td>Actions Here</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No categories found</td></tr>";
        }

        echo "</tbody>";
        echo "</table>";

        $conn->close();
        ?>
    </div>
</body>
</html>
