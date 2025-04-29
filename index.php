<?php
// Include the database connection file
include 'db.php';

// Prepare the SQL query to get all products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Product Page - ICTWEB514</title>
    <link rel="stylesheet" href="style.css"> <!-- Optional external stylesheet -->
    <style>
        /* Simple internal styling */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .product {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 15px;
            background-color: #f9f9f9;
        }

        .product img {
            max-width: 150px;
            border-radius: 5px;
        }

        .product-details {
            flex: 1;
        }

        .product h2 {
            margin: 0;
        }

        .product p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

<h1>Our Products</h1>

<!-- Add product link -->
<p>
    <a href="add.php" style="padding: 10px 15px; background-color: blue; color: white; text-decoration: none; border-radius: 5px;">
        + Add New Product
    </a>
</p>

<?php
// Show success message if present in URL
if (isset($_GET['success'])) {
    echo '<p style="color: green; background-color: #e0ffe0; padding: 10px; border: 1px solid #b2d8b2; border-radius: 5px; max-width: 600px; margin: auto;">'
         . htmlspecialchars($_GET['success']) . 
         '</p>';
}
?>
<?php
// Show error message if present in URL
if (isset($_GET['error'])) {
    echo '<p style="color: red; background-color: #ffe0e0; padding: 10px; border: 1px solid #d8b2b2; border-radius: 5px; max-width: 600px; margin: auto;">'
         . htmlspecialchars($_GET['error']) . 
         '</p>';
}
?>

<?php
// Check if the query returned any results
if ($result->num_rows > 0) {
    // Output data for each product
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product">';
        echo '<img src="' . htmlspecialchars($row["image"]) . '" alt="' . htmlspecialchars($row["name"]) . '">';
        echo '<div class="product-details">';
        echo '<h2>' . htmlspecialchars($row["name"]) . '</h2>';
        echo '<p>' . htmlspecialchars($row["description"]) . '</p>';
        echo '<p><strong>Price: $' . number_format($row["price"], 2) . '</strong></p>';

        // Delete form
        echo '<form method="POST" action="delete.php" onsubmit="return confirm(\'Are you sure you want to delete this product?\');">';
        echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
        echo '<button type="submit" style="background-color:red;color:white;border:none;padding:5px 10px;border-radius:4px;">Delete</button>';
        echo '</form>';
        echo '<br>';
        echo '<a href="edit.php?id=' . $row["id"] . '" style="display:inline-block;margin-top:10px;padding:5px 10px;background-color:orange;color:white;text-decoration:none;border-radius:4px;">Edit</a>';

        echo '</div>';
        echo '</div>';
    }
} else {
    echo "<p>No products found.</p>";
}

// Close the database connection
$conn->close();
?>

</body>
</html>
