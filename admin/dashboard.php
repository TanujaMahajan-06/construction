<?php

session_start();

if (!isset($_SESSION['admin'])) {

    header("Location: ../login.php");

    exit();

}

include "../db.php";


$project_count =
    mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT COUNT(*) AS total
             FROM projects"
        )
    )['total'];


$service_count =
    mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT COUNT(*) AS total
             FROM services"
        )
    )['total'];


$gallery_count =
    mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT COUNT(*) AS total
             FROM gallery"
        )
    )['total'];


$message_count =
    mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT COUNT(*) AS total
             FROM contact_messages"
        )
    )['total'];

// Count Feedback
$feedback_result = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM feedback"
);

$feedback_data = mysqli_fetch_assoc($feedback_result);

$feedback_count = $feedback_data['total'];

?>

?>

<!DOCTYPE html>

<html>

<head>

    <title>Admin Dashboard</title>

    <link rel="stylesheet"
          href="admin.css">

</head>

<body>


<div class="admin-wrapper">


    <aside class="sidebar">

        <h2>
            BM CONSTRUCTION
        </h2>

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
            Dashboard
        </h1>

        <p>
            Welcome, <?php
            echo htmlspecialchars(
                $_SESSION['admin']
            );
            ?>
        </p>


        <div class="dashboard-cards">


            <div class="dashboard-card">

                <h3>
                    Projects
                </h3>

                <strong>
                    <?php
                    echo $project_count;
                    ?>
                </strong>

            </div>


            <div class="dashboard-card">

                <h3>
                    Services
                </h3>

                <strong>
                    <?php
                    echo $service_count;
                    ?>
                </strong>

            </div>


            <div class="dashboard-card">

                <h3>
                    Gallery
                </h3>

                <strong>
                    <?php
                    echo $gallery_count;
                    ?>
                </strong>

            </div>


            <div class="dashboard-card">

                <h3>
                    Messages
                </h3>

                <strong>
                    <?php
                    echo $message_count;
                    ?>
                </strong>

            </div>

            <div class="dashboard-card">

                <h3>
                    Feedback
                </h3>

                <strong>
                    <?php
                    echo $feedback_count;
                    ?>
                </strong>

            </div>



        </div>

    </main>

</div>


</body>

</html>