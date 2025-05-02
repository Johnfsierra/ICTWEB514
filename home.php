<?php
// Connect to new database
include 'home_db.php';

// Fetch products from the new DB
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Real Estate Style Page</title>
  <link rel="stylesheet" href="home_style.css">
</head>
<body>

<header class="hero">
  <div class="hero-content">
    <h1>FIND YOUR PERFECT PROPERTY</h1>
    <p>Browse listings, explore properties, and more</p>
  </div>
</header>

<main class="container">
  <section class="product-grid">
    <?php
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '<div class="card">';
        echo '<img src="' . htmlspecialchars($row["image"]) . '" alt="' . htmlspecialchars($row["name"]) . '">';
        echo '<div class="card-body">';
        echo '<h2>' . htmlspecialchars($row["name"]) . '</h2>';
        echo '<p>' . htmlspecialchars($row["description"]) . '</p>';
        echo '<p class="price">$' . number_format($row["price"], 2) . '</p>';
        echo '</div>';
        echo '</div>';
      }
    } else {
      echo '<p>No products found.</p>';
    }
    $conn->close();
    ?>
  </section>
</main>

<footer>
  <p>&copy; 2024 Real Estate Demo. All rights reserved.</p>
</footer>

</body>
</html>
