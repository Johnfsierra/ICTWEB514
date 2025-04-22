<?php
// Include database connection
include 'db.php';

// Check if the product ID is set and is a valid number
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = intval($_POST['id']);

    // Prepare and execute the delete query
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect back to the index page
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting product: " . $conn->error;
    }
} else {
    echo "Invalid product ID.";
}

// Close connection
$conn->close();
?>
