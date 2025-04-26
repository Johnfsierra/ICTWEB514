<?php
include 'db.php';

// Check if product ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php?error=Invalid+product+ID");
    exit();
}

$id = intval($_GET['id']);

// Get current product data
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: index.php?error=Product+not+found");
    exit();
}

$product = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $price = floatval($_POST["price"]);
    $image = trim($_POST["image"]);

    if (!empty($name) && $price > 0) {
        $updateSql = "UPDATE products SET name = ?, description = ?, price = ?, image = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ssdsi", $name, $description, $price, $image, $id);

        if ($updateStmt->execute()) {
            header("Location: index.php?success=Product+updated+successfully");
            exit();
        } else {
            header("Location: index.php?error=Failed+to+update+product");
            exit();
        }
    } else {
        header("Location: index.php?error=Invalid+input+values");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product - ICTWEB514</title>
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
            background-color: orange;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: darkorange;
        }
    </style>
</head>
<body>

<h2>Edit Product</h2>

<form method="POST" action="">
    <label>Product Name</label>
    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

    <label>Description</label>
    <textarea name="description"><?= htmlspecialchars($product['description']) ?></textarea>

    <label>Price</label>
    <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>

    <label>Image path</label>
    <input type="text" name="image" value="<?= htmlspecialchars($product['image']) ?>">

    <button type="submit">Update Product</button>
</form>

</body>
</html>
