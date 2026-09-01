<?php

session_start();

if (!isset($_SESSION['admin'])) {

    header("Location: ../login.php");
    exit();

}

include "../db.php";


if (isset($_POST['add_service'])) {

    $title = mysqli_real_escape_string(
        $conn,
        $_POST['title']
    );

    $description = mysqli_real_escape_string(
        $conn,
        $_POST['description']
    );


    /* ================= IMAGE UPLOAD ================= */

    $image = $_FILES['image']['name'];

    $image_tmp = $_FILES['image']['tmp_name'];

    $image_size = $_FILES['image']['size'];


    $upload_folder = "../uploads/";


    /* Create uploads folder if it doesn't exist */

    if (!is_dir($upload_folder)) {

        mkdir($upload_folder, 0777, true);

    }


    /* Get file extension */

    $extension = strtolower(
        pathinfo($image, PATHINFO_EXTENSION)
    );


    /* Allowed image types */

    $allowed = array(
        "jpg",
        "jpeg",
        "png",
        "webp"
    );


    if (!in_array($extension, $allowed)) {

        die("Only JPG, JPEG, PNG and WEBP images are allowed.");

    }


    /* Create unique image name */

    $new_image_name =
        time() . "_" . uniqid() . "." . $extension;


    /* Upload image */

    move_uploaded_file(
        $image_tmp,
        $upload_folder . $new_image_name
    );


    /* ================= INSERT DATA ================= */

    mysqli_query(
        $conn,

        "INSERT INTO services
        (title, description, image)
        VALUES
        ('$title',
         '$description',
         '$new_image_name')"
    );


    header(
        "Location: services.php"
    );

    exit();

}

?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Add Service</title>

    <link rel="stylesheet"
          href="admin.css">

</head>


<body>


<div class="form-page">

    <div class="form-box">


        <h1>
            Add Service
        </h1>


        <form
            method="POST"
            enctype="multipart/form-data">


            <!-- SERVICE TITLE -->

            <label>
                Service Title
            </label>

            <input
                type="text"
                name="title"
                placeholder="Building Construction"
                required>


            <!-- DESCRIPTION -->

            <label>
                Description
            </label>

            <textarea
                name="description"
                rows="5"
                placeholder="Enter service description"
                required></textarea>


            <!-- SERVICE IMAGE -->

            <label>
                Service Image
            </label>

            <input
                type="file"
                name="image"
                accept="image/*"
                required>


            <small>
                Allowed: JPG, JPEG, PNG, WEBP
            </small>


            <!-- BUTTON -->

            <button
                type="submit"
                name="add_service">

                Add Service

            </button>


            <a href="services.php">
                Cancel
            </a>


        </form>


    </div>

</div>


</body>

</html>