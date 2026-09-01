<?php

session_start();

if (!isset($_SESSION['admin'])) {

    header("Location: ../login.php");

    exit();

}

include "../db.php";


if (isset($_POST['add_project'])) {

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


    $image = $_FILES['image']['name'];

    $tmp_name = $_FILES['image']['tmp_name'];


    if (!empty($image)) {

        $allowed = [
            'jpg',
            'jpeg',
            'png',
            'webp'
        ];

        $extension =
            strtolower(
                pathinfo(
                    $image,
                    PATHINFO_EXTENSION
                )
            );


        if (!in_array(
            $extension,
            $allowed
        )) {

            die("Invalid image type.");

        }


        $new_image =
            time() . "_" . basename($image);


        move_uploaded_file(
            $tmp_name,
            "../images/" . $new_image
        );

    } else {

        $new_image = "";

    }


    $sql = "INSERT INTO projects
            (title, location, description, image)
            VALUES
            ('$title',
             '$location',
             '$description',
             '$new_image')";


    if (mysqli_query($conn, $sql)) {

        header(
            "Location: projects.php"
        );

        exit();

    }

}

?>

<!DOCTYPE html>

<html>

<head>

    <title>Add Project</title>

    <link rel="stylesheet"
          href="admin.css">

</head>

<body>


<div class="form-page">

    <div class="form-box">

        <h1>
            Add Project
        </h1>


        <form method="POST"
              enctype="multipart/form-data">


            <label>
                Project Title
            </label>

            <input
                type="text"
                name="title"
                required>


            <label>
                Location
            </label>

            <input
                type="text"
                name="location"
                required>


            <label>
                Description
            </label>

            <textarea
                name="description"
                rows="5"></textarea>


            <label>
                Project Image
            </label>

            <input
                type="file"
                name="image"
                accept="image/*"
                required>


            <button
                type="submit"
                name="add_project">

                Add Project

            </button>


            <a href="projects.php">
                Cancel
            </a>

        </form>

    </div>

</div>


</body>

</html>