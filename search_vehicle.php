<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Vehicle</title>
    <link rel="stylesheet" href="search_vehicle.css">
</head>
<body>
    <div class="container">
        <h2>Search Vehicle</h2>
        <form action="search_result.php" method="POST">
            <label for="searchTerm">Search by License Plate:</label>
            <input type="text" id="searchTerm" name="searchTerm" required>
            <button type="submit" name="search">Search</button>
        </form>
    </div>
</body>
</html>
