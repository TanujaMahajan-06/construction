<?php

session_start();

if (!isset($_SESSION['admin'])) {

    header("Location: ../login.php");

    exit();

}

include "../db.php";


$id = intval($_GET['id']);


$result = mysqli_query(
    $conn,
    "SELECT * FROM projects
     WHERE id=$id"
);


$project = mysqli_fetch_assoc($result);


if (!$project) {

    die("Project not found.");

}


if (isset($_POST['update_project'])) {

    $title = mysqli_real_escape_string(
        $conn,
        $_POST['title']
    );

    $location = mysqli_real_escape_string(
        $conn,
        $_POST['location']
    );

    $description = mysqli_real_escape_string(
        $conn,
        $_POST['description']
    );


    $image = $project['image'];


    if (!empty($_FILES['image']['name'])) {

        $new_image =
            time() . "_" .
            basename(
                $_FILES['image']['name']
            );


        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../images/" . $new_image
        );


        if (
            !empty($project['image']) &&
            file_exists(
                "../images/" .
                $project['image']
            )
        ) {

            unlink(
                "../images/" .
                $project['image']
            );

        }


        $image = $new_image;

    }


    $sql = "UPDATE projects SET

            title='$title',
            location='$location',
            description='$description',
            image='$image'

            WHERE id=$id";


    mysqli_query(
        $conn,
        $sql
    );


    header(
        "Location: projects.php"
    );

    exit();

}

?>

<!DOCTYPE html>

<html>

<head>

    <title>Edit Project</title>

    <link rel="stylesheet"
          href="admin.css">

</head>

<body>


<div class="form-page">

    <div class="form-box">

        <h1>
            Edit Project
        </h1>


        <form method="POST"
              enctype="multipart/form-data">


            <label>
                Project Title
            </label>

            <input
                type="text"
                name="title"
                value="<?php
                echo htmlspecialchars(
                    $project['title']
                );
                ?>"
                required>


            <label>
                Location
            </label>

            <input
                type="text"
                name="location"
                value="<?php
                echo htmlspecialchars(
                    $project['location']
                );
                ?>"
                required>


            <label>
                Description
            </label>

            <textarea
                name="description"
                rows="5"><?php
                echo htmlspecialchars(
                    $project['description']
                );
                ?></textarea>


            <label>
                Current Image
            </label>

            <?php if (
                !empty($project['image'])
            ) { ?>

                <img
                    src="../images/<?php
                    echo htmlspecialchars(
                        $project['image']
                    );
                    ?>"
                    class="preview-image">

            <?php } ?>


            <label>
                Change Image
            </label>

            <input
                type="file"
                name="image"
                accept="image/*">


            <button
                type="submit"
                name="update_project">

                Update Project

            </button>


            <a href="projects.php">
                Cancel
            </a>

        </form>

    </div>

</div>


</body>

</html>