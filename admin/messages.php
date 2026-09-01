<?php

session_start();

if (!isset($_SESSION['admin'])) {

    header("Location: ../login.php");

    exit();

}

include "../db.php";


$result = mysqli_query(
    $conn,
    "SELECT * FROM contact_messages
     ORDER BY id DESC"
);

?>

<!DOCTYPE html>

<html>

<head>

    <title>Contact Messages</title>

    <link rel="stylesheet"
          href="admin.css">

</head>

<body>


<div class="admin-wrapper">


    <aside class="sidebar">

        <h2>BM CONSTRUCTION</h2>

        <p class="admin-title">
            ADMIN PANEL
        </p>


        <a href="dashboard.php">
            Dashboard
        </a>

        <a href="projects.php">
            Projects
        </a>

        <a href="services.php">
            Services
        </a>

        <a href="gallery.php">
            Gallery
        </a>

        <a href="messages.php">
            Messages
        </a>

        <a href="feedback.php">
            Feedback
        </a>

        <a href="../index.php">
            View Website
        </a>

        <a href="../logout.php">
            Logout
        </a>

    </aside>


    <main class="admin-content">


        <h1>
            Contact Messages
        </h1>


        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Subject</th>

                        <th>Message</th>

                        <th>Date</th>

                    </tr>

                </thead>


                <tbody>

                <?php

                while (
                    $row =
                    mysqli_fetch_assoc($result)
                ) {

                ?>

                    <tr>

                        <td>
                            <?php
                            echo $row['id'];
                            ?>
                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars(
                                $row['name']
                            );
                            ?>
                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars(
                                $row['email']
                            );
                            ?>
                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars(
                                $row['subject']
                            );
                            ?>
                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars(
                                $row['message']
                            );
                            ?>
                        </td>


                        <td>
                            <?php
                            echo $row['created_at'];
                            ?>
                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </main>

</div>


</body>

</html>