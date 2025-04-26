<?php
include 'db.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form values and sanitize
    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $price = floatval($_POST["price"]);
    $image = trim($_POST["image"]);

    // Basic validation: check if name is not empty and price is a positive number
    if (!empty($name) && $price > 0) {
        // Insert into database
        $sql = "INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssds", $name, $description, $price, $image);

        if ($stmt->execute()) {
            // Success: redirect with success message
            header("Location: index.php?success=Product+added+successfully");
            exit();
        } else {
            // Error inserting into database: redirect with error message
            header("Location: index.php?error=Failed+to+add+product");
            exit();
        }
    } else {
        // Validation failed: redirect with error message
        header("Location: index.php?error=Invalid+input+values");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product - ICTWEB514</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        form {
            max-width: 400px;
            margin: auto;
        }

        input, textarea {
            display: block;
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
        }

        button {
            background-color: green;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>

<h2>Add New Product</h2>

<form method="POST" action="add.php">
    <label>Product Name</label>
    <input type="text" name="name" required>

    <label>Description</label>
    <textarea name="description"></textarea>

    <label>Price</label>
    <input type="number" step="0.01" name="price" required>

    <label>Image path (e.g., img/product.jpg)</label>
    <input type="text" name="image">

    <button type="submit">Add Product</button>
</form>

</body>
</html>
