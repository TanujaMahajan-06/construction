<?php

include "db.php";

if (isset($_POST['send_message'])) {

    $name = mysqli_real_escape_string(
        $conn,
        $_POST['name']
    );

    $email = mysqli_real_escape_string(
        $conn,
        $_POST['email']
    );

    $subject = mysqli_real_escape_string(
        $conn,
        $_POST['subject']
    );

    $message = mysqli_real_escape_string(
        $conn,
        $_POST['message']
    );


    $sql = "INSERT INTO contact_messages
            (name, email, subject, message)
            VALUES
            ('$name', '$email', '$subject', '$message')";


    if (mysqli_query($conn, $sql)) {

        echo "<script>

            alert('Message sent successfully!');

            window.location='index.php#contact';

        </script>";

    } else {

        echo "Error: " .
             mysqli_error($conn);

    }

}

?>