<?php
// Connect to the database
include 'home_db.php';

$search_results = [];

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["query"])) {
    $search = $conn->real_escape_string($_GET["query"]);
    $sql = "SELECT * FROM properties WHERE title LIKE '%$search%' OR type LIKE '%$search%'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $search_results[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Search Properties</title>
  <link rel="stylesheet" href="home_style.css">
</head>
<body>

<div class="container">
  <h1>Search Properties</h1>

  <form method="GET" action="search.php" style="margin-bottom: 30px;">
    <input type="text" name="query" placeholder="Search by title or type..." style="padding: 10px; width: 300px;" required>
    <button type="submit" style="padding: 10px;">Search</button>
  </form>

  <section class="product-grid">
    <?php if (!empty($search_results)) {
        foreach ($search_results as $row) {
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
    } elseif (isset($_GET["query"])) {
        echo '<p>No properties found matching your search.</p>';
    } ?>
  </section>
</div>

</body>
</html>
