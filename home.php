<?php
// Connect to new database
include 'home_db.php';

// Fetch properties from the new DB
$sql = "SELECT * FROM properties";
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
        echo '<img src="' . htmlspecialchars($row["image"]) . '" alt="' . htmlspecialchars($row["title"]) . '">';
        echo '<div class="card-body">';
        echo '<h2>' . htmlspecialchars($row["title"]) . '</h2>';
        echo '<p>' . htmlspecialchars($row["description"]) . '</p>';
        echo '<p><strong>Type:</strong> ' . htmlspecialchars($row["type"]) . ' | ';
        echo '<strong>Bedrooms:</strong> ' . htmlspecialchars($row["bedrooms"]) . '</p>';
        echo '<p class="price">$' . number_format($row["price"], 2) . '</p>';
        echo '</div>';
        echo '</div>';
      }
    } else {
      echo '<p>No properties found.</p>';
    }
    $conn->close();
    ?>
  </section>
</main>

<footer>
  <p>&copy; 2025 Real Estate Demo. All rights reserved.</p>
</footer>

</body>
</html>
