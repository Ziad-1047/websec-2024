
// Hash the password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);







//old action.php vulnerable to sql injection
<?php
include 'db_connection.php';
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if (empty($username)) {
        header("Location: index.html?error=User Name is required");
        exit();
    }
    if (empty($password)) {
        header("Location: index.html?error=Password is required");
        exit();
    }

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['username'] = $row['username'];
        $_SESSION['id'] = $row['id'];

        // Redirect based on user role
        switch ($row['role']) {
            case 'admin':
                header("Location: admin_dashboard.php");
                exit();
            case 'artist':
                header("Location: add-artwork.php");
                exit();
            case 'regular':
                header("Location: artworks.php");
                exit();
            default:
                header("Location: index.html?error=Invalid role");
                exit();
        }
    } else {
        header("Location: index.html?error=Incorrect User Name or Password");
        exit();
    }
}
?>











// old add-artwork.php code  vulnerable to xss
<?php
include 'db_connection.php';

session_start();

// Handle the artwork submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve artwork details from the database
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $description = $_POST['description'];
    $price = $_POST['price'];


    //Insert the artwork into the database

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO artworks (title, artist, description, price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssd", $title, $artist, $description, $price);

    if ($stmt->execute()) {
        // Artwork added successfully
        $_SESSION['success'] = "Artwork added successfully";
    }
    
    


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
