<?php

session_start();

if (!isset($_SESSION['admin'])) {

    header("Location: ../login.php");
    exit();

}

include "../db.php";


$id = intval($_GET['id']);


/* Get existing service */

$result = mysqli_query(
    $conn,
    "SELECT * FROM services WHERE id=$id"
);

$service = mysqli_fetch_assoc($result);


/* If service doesn't exist */

if (!$service) {

    header("Location: services.php");
    exit();

}


/* ================= UPDATE SERVICE ================= */

if (isset($_POST['update_service'])) {

    $title = mysqli_real_escape_string(
        $conn,
        $_POST['title']
    );

    $description = mysqli_real_escape_string(
        $conn,
        $_POST['description']
    );


    /* Keep old image by default */

    $image_name = $service['image'];


    /* ================= NEW IMAGE ================= */

    if (
        isset($_FILES['image']) &&
        $_FILES['image']['error'] == 0
    ) {

        $image = $_FILES['image']['name'];

        $tmp_name = $_FILES['image']['tmp_name'];

        $extension = strtolower(
            pathinfo($image, PATHINFO_EXTENSION)
        );


        $allowed = array(
            "jpg",
            "jpeg",
            "png",
            "webp"
        );


        if (!in_array($extension, $allowed)) {

            die(
                "Only JPG, JPEG, PNG and WEBP images are allowed."
            );

        }


        /* Upload folder */

        $upload_folder = "../uploads/";


        if (!is_dir($upload_folder)) {

            mkdir(
                $upload_folder,
                0777,
                true
            );

        }


        /* Create unique name */

        $new_image_name =
            time() . "_" .
            uniqid() . "." .
            $extension;


        /* Upload new image */

        move_uploaded_file(
            $tmp_name,
            $upload_folder . $new_image_name
        );


        /* Delete old image */

        if (
            !empty($service['image']) &&
            file_exists(
                $upload_folder . $service['image']
            )
        ) {

            unlink(
                $upload_folder . $service['image']
            );

        }


        $image_name = $new_image_name;

    }


    /* ================= UPDATE DATABASE ================= */

    mysqli_query(
        $conn,

        "UPDATE services SET

        title='$title',

        description='$description',

        image='$image_name'

        WHERE id=$id"
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

    <title>Edit Service</title>

    <link rel="stylesheet"
          href="admin.css">

</head>


<body>


<div class="form-page">

    <div class="form-box">


        <h1>
            Edit Service
        </h1>


        <form
            method="POST"
            enctype="multipart/form-data">


            <!-- TITLE -->

            <label>
                Service Title
            </label>

            <input
                type="text"
                name="title"
                value="<?php
                    echo htmlspecialchars(
                        $service['title']
                    );
                ?>"
                required>


            <!-- DESCRIPTION -->

            <label>
                Description
            </label>

            <textarea
                name="description"
                rows="5"
                required><?php
                    echo htmlspecialchars(
                        $service['description']
                    );
                ?></textarea>


            <!-- CURRENT IMAGE -->

            <label>
                Current Image
            </label>


            <?php if (!empty($service['image'])) { ?>

                <div class="current-image">

                    <img
                        src="../uploads/<?php
                            echo htmlspecialchars(
                                $service['image']
                            );
                        ?>"
                        alt="Current Service Image">

                </div>

            <?php } else { ?>

                <p>
                    No image uploaded.
                </p>

            <?php } ?>


            <!-- NEW IMAGE -->

            <label>
                Change Service Image
            </label>

            <input
                type="file"
                name="image"
                accept="image/*">


            <small>
                Leave empty if you want to keep
                the current image.
            </small>


            <!-- BUTTON -->

            <button
                type="submit"
                name="update_service">

                Update Service

            </button>


            <a href="services.php">
                Cancel
            </a>


        </form>


    </div>

</div>


</body>

</html>