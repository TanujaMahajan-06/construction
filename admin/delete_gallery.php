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
    "SELECT image FROM gallery
     WHERE id=$id"
);


$row =
    mysqli_fetch_assoc($result);


if ($row) {

    if (
        !empty($row['image']) &&
        file_exists(
            "../uploads/" .
            $row['image']
        )
    ) {

        unlink(
            "../uploads/" .
            $row['image']
        );

    }


    mysqli_query(
        $conn,
        "DELETE FROM gallery
         WHERE id=$id"
    );

}


header(
    "Location: gallery.php"
);

exit();

?>