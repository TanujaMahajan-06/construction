<?php

session_start();

include "db.php";

$error = "";

if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string(
        $conn,
        $_POST['username']
    );

    $password = mysqli_real_escape_string(
        $conn,
        $_POST['password']
    );


    $sql = "SELECT * FROM admin
            WHERE username='$username'
            AND password='$password'";


    $result = mysqli_query(
        $conn,
        $sql
    );


    if (mysqli_num_rows($result) == 1) {

        $_SESSION['admin'] = $username;

        header(
            "Location: admin/dashboard.php"
        );

        exit();

    } else {

        $error = "Invalid username or password.";

    }

}

?>

<!DOCTYPE html>

<html>

<head>

    <title>Admin Login</title>

    <link rel="stylesheet"
          href="admin/admin.css">

</head>

<body>


<div class="login-container">

    <div class="login-box">

        <h2>BM CONSTRUCTION</h2>

        <p>ADMIN LOGIN</p>


        <?php if ($error != "") { ?>

            <div class="error">
                <?php echo $error; ?>
            </div>

        <?php } ?>


        <form method="POST">

            <input
                type="text"
                name="username"
                placeholder="Username"
                required>


            <input
                type="password"
                name="password"
                placeholder="Password"
                required>


            <button
                type="submit"
                name="login">

                LOGIN

            </button>

        </form>


        <a href="index.php">
            ← Back to Website
        </a>

    </div>

</div>


</body>

</html>