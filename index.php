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
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f2f2f2;
            margin: 0;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2em;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .product {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .product img {
            width: 150px;
            height: auto;
            border-radius: 5px;
            object-fit: cover;
        }

        .product-details {
            flex: 1;
        }

        .product h2 {
            margin: 0 0 5px;
        }

        .product p {
            margin: 5px 0;
        }

        .button-link {
            display: inline-block;
            padding: 10px 15px;
            background-color: blue;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .success-msg, .error-msg {
            padding: 10px;
            border-radius: 5px;
            max-width: 600px;
            margin: 10px auto;
            border: 1px solid;
        }

        .success-msg {
            background-color: #e0ffe0;
            color: green;
            border-color: #b2d8b2;
        }

        .error-msg {
            background-color: #ffe0e0;
            color: red;
            border-color: #d8b2b2;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Our Products</h1>

    <p><a class="button-link" href="add.php">+ Add New Product</a></p>

    <?php
    // Show success message if present in URL
    if (isset($_GET['success'])) {
        echo '<p class="success-msg">' . htmlspecialchars($_GET['success']) . '</p>';
    }

    // Show error message if present in URL
    if (isset($_GET['error'])) {
        echo '<p class="error-msg">' . htmlspecialchars($_GET['error']) . '</p>';
    }

    // Display products
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="product">';
            echo '<img src="' . htmlspecialchars($row["image"]) . '" alt="' . htmlspecialchars($row["name"]) . '">';
            echo '<div class="product-details">';
            echo '<h2>' . htmlspecialchars($row["name"]) . '</h2>';
            echo '<p>' . htmlspecialchars($row["description"]) . '</p>';
            echo '<p><strong>Price: $' . number_format($row["price"], 2) . '</strong></p>';
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

    $conn->close();
    ?>

</div>

</body>
</html>
