```php
<?php

include "db.php";

if (isset($_POST['submit_feedback'])) {

    $customer_name = mysqli_real_escape_string(
        $conn,
        $_POST['customer_name']
    );

    $email = mysqli_real_escape_string(
        $conn,
        $_POST['email']
    );

    $rating = intval($_POST['rating']);

    $message = mysqli_real_escape_string(
        $conn,
        $_POST['message']
    );

    // Validate rating
    if ($rating < 1 || $rating > 5) {
        die("Invalid rating.");
    }

    // Save feedback as Approved
    $sql = "INSERT INTO feedback
        (customer_name, email, rating, message, status)
        VALUES
        ('$customer_name', '$email', '$rating', '$message', 'Approved')";
    if (mysqli_query($conn, $sql)) {

        echo "<script>
                alert('Thank you! Your feedback has been submitted successfully.');
                window.location.href = 'feedback.php';
              </script>";

    } else {

        echo "Error: " . mysqli_error($conn);

    }

} else {

    header("Location: feedback.php");
    exit();

}

?>
