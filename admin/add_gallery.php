<?php

session_start();

if (!isset($_SESSION['admin'])) {

    header("Location: ../login.php");

    exit();

}

include "../db.php";


if (isset($_POST['add_gallery'])) {

    $title = mysqli_real_escape_string(
        $conn,
        $_POST['title']
    );


    $image =
        $_FILES['image']['name'];


    $tmp_name =
        $_FILES['image']['tmp_name'];


    if (empty($image)) {

        die("Please select an image.");

    }


    $extension =
        strtolower(
            pathinfo(
                $image,
                PATHINFO_EXTENSION
            )
        );


    $allowed = [
        'jpg',
        'jpeg',
        'png',
        'webp'
    ];


    if (!in_array(
        $extension,
        $allowed
    )) {

        die("Invalid image type.");

    }


    $new_image =
        time() . "_" .
        basename($image);


    move_uploaded_file(
        $tmp_name,
        "../uploads/" . $new_image
    );


    mysqli_query(
        $conn,
        "INSERT INTO gallery
        (title, image)
        VALUES
        ('$title',
         '$new_image')"
    );


    header(
        "Location: gallery.php"
    );

    exit();

}

?>

<!DOCTYPE html>

<html>

<head>

    <title>Add Gallery Image</title>

    <link rel="stylesheet"
          href="admin.css">

</head>

<body>


<div class="form-page">

    <div class="form-box">

        <h1>
            Add Gallery Image
        </h1>


        <form
            method="POST"
            enctype="multipart/form-data">


            <label>
                Image Title
            </label>

            <input
                type="text"
                name="title">


            <label>
                Select Image
            </label>

            <input
                type="file"
                name="image"
                accept="image/*"
                required>


            <button
                type="submit"
                name="add_gallery">

                Upload Image

            </button>


            <a href="gallery.php">
                Cancel
            </a>

        </form>

    </div>

</div>


</body>

</html>