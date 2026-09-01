<?php

session_start();

if (!isset($_SESSION['admin'])) {

    header("Location: ../login.php");

    exit();

}

include "../db.php";

$result = mysqli_query(
    $conn,
    "SELECT * FROM projects
     ORDER BY id DESC"
);

?>

<!DOCTYPE html>

<html>

<head>

    <title>Projects</title>

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

            <h1>Projects</h1>

            <a href="add_project.php"
               class="add-btn">

                + Add Project

            </a>

        </div>


        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Image</th>

                        <th>Title</th>

                        <th>Location</th>

                        <th>Action</th>

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

                            <?php if (
                                !empty($row['image'])
                            ) { ?>

                                <img
                                    src="../images/<?php
                                    echo htmlspecialchars(
                                        $row['image']
                                    );
                                    ?>"
                                    class="table-image">

                            <?php } ?>

                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars(
                                $row['title']
                            );
                            ?>
                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars(
                                $row['location']
                            );
                            ?>
                        </td>


                        <td>

                            <a
                                href="edit_project.php?id=<?php
                                echo $row['id'];
                                ?>"
                                class="edit-btn">

                                Edit

                            </a>


                            <a
                                href="delete_project.php?id=<?php
                                echo $row['id'];
                                ?>"
                                class="delete-btn"
                                onclick="return confirm('Delete this project?');">

                                Delete

                            </a>

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