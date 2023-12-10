<?php
include 'db_connection.php';
session_start();

// Handle the artwork submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve artwork details from the database
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
    $artist = htmlspecialchars($_POST['artist'], ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
    $price = floatval($_POST['price']); // Convert to float to ensure it's a valid number

    // Insert the artwork into the database
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO artworks (title, artist, description, price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssd", $title, $artist, $description, $price);

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/add-style.css">
    <title>Add Artwork</title>
</head>
<body>
    <h1>Add Artwork</h1>

    <!-- Artwork submission form -->
    <form action="add-artwork.php" method="post">
        <label for="title">Title:</label>
        <input type="text" name="title" required><br>

        <label for="artist">Artist:</label>
        <input type="text" name="artist" required><br>

        <label for="description">Description:</label>
        <textarea name="description" rows="4" required></textarea><br>

        <label for="price">Price:</label>
        <input type="number" name="price" step="5" required><br>

        <button type="submit">Add Artwork</button>
    </form>
</body>
</html>



