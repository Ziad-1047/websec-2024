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

    
    $sql = "SELECT * FROM users WHERE username=? AND password=?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    //  result
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['username'] = $row['username'];
        $_SESSION['id'] = $row['id'];

        
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
