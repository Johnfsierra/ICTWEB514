<?php
include 'db.php';

// Check if the product ID is set and valid
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = intval($_POST['id']);

    // Prepare the delete query
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Successfully deleted
        header("Location: index.php?success=Product+deleted+successfully");
        exit();
    } else {
        // Failed to delete
        header("Location: index.php?error=Failed+to+delete+product");
        exit();
    }
} else {
    // Invalid ID
    header("Location: index.php?error=Invalid+product+ID");
    exit();
}

// Close the connection
$conn->close();
?>
