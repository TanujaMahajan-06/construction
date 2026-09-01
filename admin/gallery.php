<?php

session_start();

if (!isset($_SESSION['admin'])) {

    header("Location: ../login.php");

    exit();

}

include "../db.php";


$result = mysqli_query(
    $conn,
    "SELECT * FROM gallery
     ORDER BY id DESC"
);

?>

<!DOCTYPE html>

<html>

<head>

    <title>Gallery</title>

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


        <div class="page-header">

            <h1>
                Gallery
            </h1>

            <a href="add_gallery.php"
               class="add-btn">

                + Add Image

            </a>

        </div>


        <div class="gallery-admin">


            <?php

            while (
                $row =
                mysqli_fetch_assoc($result)
            ) {

            ?>


                <div class="gallery-admin-card">


                    <img
                        src="../uploads/<?php
                        echo htmlspecialchars(
                            $row['image']
                        );
                        ?>">


                    <h3>

                        <?php
                        echo htmlspecialchars(
                            $row['title']
                        );
                        ?>

                    </h3>


                    <a
                        href="delete_gallery.php?id=<?php
                        echo $row['id'];
                        ?>"
                        class="delete-btn"
                        onclick="return confirm('Delete this image?');">

                        Delete

                    </a>


                </div>


            <?php } ?>


        </div>

    </main>

</div>


</body>

</html>