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
    "SELECT image FROM projects
     WHERE id=$id"
);


$project =
    mysqli_fetch_assoc($result);


if ($project) {

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


    mysqli_query(
        $conn,
        "DELETE FROM projects
         WHERE id=$id"
    );

}


header(
    "Location: projects.php"
);

exit();

?>