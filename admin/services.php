<?php

session_start();

if (!isset($_SESSION['admin'])) {

    header("Location: ../login.php");
    exit();

}

include "../db.php";


$result = mysqli_query(
    $conn,
    "SELECT * FROM services ORDER BY id DESC"
);

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Services</title>

    <link rel="stylesheet"
          href="admin.css">

</head>


<body>


<div class="admin-wrapper">


    <!-- ================= SIDEBAR ================= -->

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


    <!-- ================= CONTENT ================= -->

    <main class="admin-content">


        <div class="page-header">

            <h1>
                Services
            </h1>


            <a
                href="add_service.php"
                class="add-btn">

                + Add Service

            </a>

        </div>


        <!-- ================= TABLE ================= -->

        <div class="table-container">

            <table>


                <thead>

                    <tr>

                        <th>
                            ID
                        </th>

                        <th>
                            Image
                        </th>

                        <th>
                            Title
                        </th>

                        <th>
                            Description
                        </th>

                        <th>
                            Action
                        </th>

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


                        <!-- ID -->

                        <td>

                            <?php
                            echo $row['id'];
                            ?>

                        </td>


                        <!-- IMAGE -->

                        <td>

                            <?php

                            if (
                                !empty(
                                    $row['image']
                                )
                            ) {

                            ?>

                                <img
                                    src="../uploads/<?php
                                        echo htmlspecialchars(
                                            $row['image']
                                        );
                                    ?>"
                                    alt="<?php
                                        echo htmlspecialchars(
                                            $row['title']
                                        );
                                    ?>"
                                    class="service-thumb">

                            <?php

                            } else {

                            ?>

                                <span>
                                    No Image
                                </span>

                            <?php

                            }

                            ?>

                        </td>


                        <!-- TITLE -->

                        <td>

                            <?php
                            echo htmlspecialchars(
                                $row['title']
                            );
                            ?>

                        </td>


                        <!-- DESCRIPTION -->

                        <td>

                            <?php
                            echo htmlspecialchars(
                                $row['description']
                            );
                            ?>

                        </td>


                        <!-- ACTION -->

                        <td>


                            <a
                                href="edit_service.php?id=<?php
                                    echo $row['id'];
                                ?>"
                                class="edit-btn">

                                Edit

                            </a>


                            <a
                                href="delete_service.php?id=<?php
                                    echo $row['id'];
                                ?>"
                                class="delete-btn"

                                onclick="return confirm('Delete this service?');">

                                Delete

                            </a>


                        </td>


                    </tr>


                <?php

                }

                ?>


                </tbody>


            </table>

        </div>


    </main>


</div>


</body>

</html>