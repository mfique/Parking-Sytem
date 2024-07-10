<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <link rel="stylesheet" href="manage_categories.css">
</head>
<body>
    <div class="container">
        <h2>Manage Categories</h2>
        <form action="display_categories.php" method="POST" class="category-form">
            <div class="form-group">
                <label for="categoryName">Category Name:</label>
                <input type="text" id="categoryName" name="categoryName" required>
            </div>
            <button type="submit">Add</button>
        </form>
    </div>
</body>
</html>
