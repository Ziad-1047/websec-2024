
<?php
include 'db_connection.php';

//$conn is the database connection object

$sql = "SELECT * FROM artworks";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/artworks_style.css">

    <title>Artworks</title>
</head>

<body>

    <h2>Artworks</h2>

    <table>
        <tr>
            <th>Title</th>
            <th>Artist</th>
            <th>Description</th>
            <th>Price</th>
        </tr>

        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row['title'] . "</td>
                <td>" . $row['artist'] . "</td>
                <td>" . $row['description'] . "</td>
                <td>" . $row['price'] . "</td>
            </tr>";
        }
        ?>

    </table>

</body>

</html>

<!-- <td><button onclick=\"addToCart(" . $row['id'] . ")\">Add to Cart</button></td>
