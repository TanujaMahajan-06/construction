<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include "../db.php";

$result = mysqli_query(
    $conn,
    "SELECT * FROM feedback ORDER BY id DESC"
);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Feedback | BM Construction Admin</title>

    <link rel="stylesheet" href="admin.css">

</head>

<body>

<div class="admin-wrapper">

    <!-- SIDEBAR -->

    <aside class="sidebar">

        <h2>BM CONSTRUCTION</h2>

        <div class="admin-title">
            ADMIN PANEL
        </div>

        <ul>

            <li>
                <a href="dashboard.php">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="projects.php">
                    Projects
                </a>
            </li>

            <li>
                <a href="services.php">
                    Services
                </a>
            </li>

            <li>
                <a href="gallery.php">
                    Gallery
                </a>
            </li>

            <li>
                <a href="messages.php">
                    Messages
                </a>
            </li>

            <li>
                <a href="feedback.php" class="active">
                    Feedback
                </a>
            </li>

            <li>
                <a href="../index.php">
                    View Website
                </a>
            </li>

            <li>
                <a href="logout.php">
                    Logout
                </a>
            </li>

        </ul>

    </aside>


    <!-- MAIN CONTENT -->

    <main class="admin-content">

        <h1>Customer Feedback</h1>

        <p>
            Feedback received from customers
        </p>


        <div class="feedback-table-container">

            <table class="feedback-table">

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Rating</th>
                        <th>Feedback</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>

                </thead>

                <tbody>

                    <?php

                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_assoc($result)) {

                    ?>

                    <tr>

                        <td>
                            <?php echo $row['id']; ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $row['customer_name']
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

                            <span class="rating">

                                <?php

                                for ($i = 1; $i <= 5; $i++) {

                                    echo ($i <= $row['rating'])
                                        ? "★"
                                        : "☆";

                                }

                                ?>

                            </span>

                        </td>

                        <td class="feedback-message">

                            <?php
                            echo htmlspecialchars(
                                $row['message']
                            );
                            ?>

                        </td>

                        <td>

                            <span class="status">

                                <?php
                                echo htmlspecialchars(
                                    $row['status']
                                );
                                ?>

                            </span>

                        </td>

                        <td>

                            <?php
                            echo date(
                                "d-m-Y",
                                strtotime(
                                    $row['created_at']
                                )
                            );
                            ?>

                        </td>

                    </tr>

                    <?php

                        }

                    } else {

                    ?>

                    <tr>

                        <td
                            colspan="7"
                            class="no-feedback">

                            No customer feedback received yet.

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