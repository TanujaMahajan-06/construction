<?php
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Customer Feedback | BM Construction</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet"
          href="style.css">

    <style>

        /* FEEDBACK PAGE */

        .feedback-page {
            padding: 100px 20px 80px;
            background: #f7f7f7;
            min-height: 75vh;
        }

        .feedback-wrapper {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 45px;
            border-radius: 8px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        }

        .feedback-title {
            text-align: center;
            margin-bottom: 35px;
        }

        .feedback-title .line {
            width: 50px;
            height: 4px;
            background: #ffc000;
            margin: 0 auto 15px;
        }

        .feedback-title h1 {
            font-size: 38px;
            margin-bottom: 10px;
            color: #111a29;
        }

        .feedback-title p {
            color: #777;
            font-size: 16px;
        }

        .feedback-form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .feedback-form label {
            font-weight: bold;
            color: #111a29;
            margin-bottom: -10px;
        }

        .feedback-form input,
        .feedback-form select,
        .feedback-form textarea {
            width: 100%;
            padding: 14px;
            border: 1px solid #ddd;
            outline: none;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
            border-radius: 4px;
        }

        .feedback-form input:focus,
        .feedback-form select:focus,
        .feedback-form textarea:focus {
            border-color: #ffc000;
        }

        .feedback-form textarea {
            min-height: 150px;
            resize: vertical;
        }

        .feedback-submit {
            width: fit-content;
            padding: 14px 30px;
            background: #ffc000;
            color: #111a29;
            border: none;
            font-weight: bold;
            cursor: pointer;
            border-radius: 4px;
            font-size: 15px;
        }

        .feedback-submit:hover {
            background: #111a29;
            color: white;
        }

        @media(max-width:600px) {

            .feedback-page {
                padding: 60px 15px;
            }

            .feedback-wrapper {
                padding: 25px;
            }

            .feedback-title h1 {
                font-size: 30px;
            }

        }

    </style>

</head>

<body>


<!-- ================= NAVBAR ================= -->

<header class="navbar">

    <div class="container nav-container">

        <div class="brand">

            <img src="images/logo.png"
                 alt="BM Construction Logo"
                 class="logo">

            <div class="company-name">

                <h2>
                    <span>CONSTRUCTION</span>
                </h2>

                <p>BUILDING YOUR FUTURE</p>

            </div>

        </div>


        <nav>

            <a href="index.php">
                HOME
            </a>

            <a href="index.php#about">
                ABOUT US
            </a>

            <a href="index.php#services">
                SERVICES
            </a>

            <a href="index.php#projects">
                PROJECTS
            </a>

            <a href="index.php#gallery">
                GALLERY
            </a>

            <a href="feedback.php" class="active">
                FEEDBACK
            </a>

            <a href="index.php#contact">
                CONTACT
            </a>

            <a href="login.php"
               class="admin-login">

                <i class="fa-solid fa-user"></i>
                ADMIN LOGIN

            </a>

        </nav>

    </div>

</header>


<!-- ================= FEEDBACK FORM ================= -->

<section class="feedback-page">

    <div class="feedback-wrapper">

        <div class="feedback-title">

            <div class="line"></div>

            <h1>Customer Feedback</h1>

            <p>
                We would love to hear from you
            </p>

        </div>


        <form
            action="submit_feedback.php"
            method="POST"
            class="feedback-form">


            <label for="customer_name">
                Your Name
            </label>

            <input
                type="text"
                id="customer_name"
                name="customer_name"
                placeholder="Enter your name"
                required>


            <label for="email">
                Email
            </label>

            <input
                type="email"
                id="email"
                name="email"
                placeholder="Enter your email"
                required>


            <label for="rating">
                Rating
            </label>

            <select
                id="rating"
                name="rating"
                required>

                <option value="">
                    Select Rating
                </option>

                <option value="5">
                    ★★★★★ - Excellent
                </option>

                <option value="4">
                    ★★★★☆ - Very Good
                </option>

                <option value="3">
                    ★★★☆☆ - Good
                </option>

                <option value="2">
                    ★★☆☆☆ - Average
                </option>

                <option value="1">
                    ★☆☆☆☆ - Poor
                </option>

            </select>


            <label for="message">
                Your Feedback
            </label>

            <textarea
                id="message"
                name="message"
                placeholder="Write your feedback..."
                required></textarea>


            <button
                type="submit"
                name="submit_feedback"
                class="feedback-submit">

                SUBMIT FEEDBACK

            </button>

        </form>

    </div>

</section>

<?php include "footer.php"; ?>

</body>

</html>