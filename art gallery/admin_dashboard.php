<?php
include 'db_connection.php';
if(isset($_POST['delete_artwork'])) {
  $artwork_id = $_POST['artwork_id'];

  $delete_sql = "DELETE FROM artworks WHERE id = ?";
  $delete_stmt = $conn->prepare($delete_sql);
  $delete_stmt->bind_param("i", $artwork_id);
  $delete_stmt->execute();

  // Redirect to refresh the page after deletion
  header("Location: admin_dashboard.php");
  exit();
}

// Fetch Artworks
$sql = "SELECT * FROM artworks";
$result = $conn->query($sql);




?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/admin_style.css">
  <title>Admin Dashboard</title>
<!--              css                      -->
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #222;
    color: #fff;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    min-height: 100vh;
}

h1 {
    text-align: center;
    color: #4CAF50;
    margin: 20px 0;
}

table {
    width: 80%;
    border-collapse: collapse;
    margin: 20px auto;
    background-color: #333;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #555;
    color: #fff;
}

th {
    background-color: #4CAF50;
}

tr:hover {
    background-color: #555;
}

td input[type="submit"] {
    background-color: #ff5555;
    color: #fff;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
}

td input[type="submit"]:hover {
    background-color: #ff0000;
}


</style>
<!--                css     />                -->

</head>
<body>
  <h1>Welcome, Admin!</h1>


  <table>
        <tr>
            <th>Title</th>
            <th>Artist</th>
            <th>Description</th>
            <th>Price</th>
            <th>Action</th>
        </tr>

        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row['title'] . "</td>
                <td>" . $row['artist'] . "</td>
                <td>" . $row['description'] . "</td>
                <td>" . $row['price'] . "</td>
                <td>
                    <form method='post' action=''>
                        <input type='hidden' name='artwork_id' value='" . $row['id'] . "'>
                        <input type='submit' name='delete_artwork' value='Delete'>
                    </form>
                </td>
            </tr>";
        }
        ?>

    </table>



  
</body>
</html>