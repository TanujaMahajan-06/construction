<?php

include "db.php";

$services = mysqli_query(
    $conn,
    "SELECT * FROM services ORDER BY id DESC"
);

$projects = mysqli_query(
    $conn,
    "SELECT * FROM projects ORDER BY id DESC"
);

$gallery = mysqli_query(
    $conn,
    "SELECT * FROM gallery ORDER BY id DESC"
);

$feedback_result = mysqli_query(
    $conn,
    "SELECT * FROM feedback ORDER BY id DESC LIMIT 6"
);

if (!$feedback_result) {
    die("Feedback Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>BM Construction | Building Your Future</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet"
          href="style.css">

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

            <a href="#home" class="active">
                HOME
            </a>

            <a href="#about">
                ABOUT US
            </a>

            <a href="#services">
                SERVICES
            </a>

            <a href="#projects">
                PROJECTS
            </a>

            <a href="#gallery">
                GALLERY
            </a>

            <a href="feedback.php" >
                FEEDBACK
            </a>

            <a href="#contact">
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


<!-- ================= HERO ================= -->

<section class="hero" id="home">

    <div class="overlay"></div>

    <div class="container hero-container">

        <div class="hero-content">

            <p class="small-title">
                WE BUILD YOUR
            </p>

            <h1>

                <span class="white-text">
                    DREAM
                </span>

                <span class="yellow-text">
                    TOGETHER
                </span>

            </h1>

            <p class="description">

                BM Construction provides high-quality
                construction services for residential,
                commercial and industrial projects.

            </p>


            <div class="hero-buttons">

                <a href="#services"
                   class="btn yellow-btn">

                    OUR SERVICES

                </a>

                <a href="#projects"
                   class="btn outline-btn">

                    OUR PROJECTS

                </a>

            </div>

        </div>

    </div>

</section>


<!-- ================= ABOUT ================= -->

<section class="about" id="about">

    <div class="container about-container">

        <div class="about-content">

            <div class="section-line"></div>

            <h2>ABOUT US</h2>

            <p>

                BM Construction is a professional
                construction company providing reliable
                and high-quality construction services.

            </p>

            <p>

                We specialize in residential, commercial
                and industrial construction projects with
                a strong focus on quality, safety and
                customer satisfaction.

            </p>

            <a href="#contact"
               class="read-more">

                READ MORE

            </a>

        </div>


        <div class="about-image">

            <img src="images/about-construction.jpg"
                 alt="Construction Project">

        </div>

    </div>

</section>


<!-- ================= SERVICES ================= -->

<section class="services" id="services">

    <div class="container">

        <div class="section-title">

            <div class="section-line"></div>

            <h2>OUR SERVICES</h2>

            <p>
                Professional construction solutions
                for every requirement.
            </p>

        </div>


        <div class="service-container">

            <?php

            while ($service = mysqli_fetch_assoc($services)) {

            ?>

                <div class="service-box">

                    <!-- SERVICE IMAGE -->

                    <div class="service-image">

                        <img
                            src="uploads/<?php
                                echo htmlspecialchars(
                                    $service['image']
                                );
                            ?>"
                            alt="<?php
                                echo htmlspecialchars(
                                    $service['title']
                                );
                            ?>">

                    </div>


                    <!-- SERVICE CONTENT -->

                    <div class="service-content">

                        <h3>

                            <?php
                            echo htmlspecialchars(
                                $service['title']
                            );
                            ?>

                        </h3>


                        <p>

                            <?php
                            echo htmlspecialchars(
                                $service['description']
                            );
                            ?>

                        </p>

                    </div>

                </div>


            <?php

            }

            ?>

        </div>

    </div>

</section>

<!-- ================= PROJECTS ================= -->

<section class="projects" id="projects">

    <div class="container">

        <div class="section-title">

            <div class="section-line"></div>

            <h2>OUR PROJECTS</h2>

            <p>
                Some of our completed construction projects.
            </p>

        </div>


        <div class="project-container">

            <?php

            while ($project =
                   mysqli_fetch_assoc($projects)) {

            ?>

                <div class="project-card">

                    <img
                        src="images/<?php
                        echo htmlspecialchars(
                            $project['image']
                        );
                        ?>"
                        alt="<?php
                        echo htmlspecialchars(
                            $project['title']
                        );
                        ?>">


                    <div class="project-info">

                        <h3>

                            <?php
                            echo htmlspecialchars(
                                $project['title']
                            );
                            ?>

                        </h3>


                        <p>

                            <i class="fa-solid
                               fa-location-dot">
                            </i>

                            <?php
                            echo htmlspecialchars(
                                $project['location']
                            );
                            ?>

                        </p>

                    </div>

                </div>

            <?php } ?>

        </div>

    </div>

</section>


<!-- ================= GALLERY ================= -->

<section class="gallery" id="gallery">

    <div class="container">

        <div class="section-title">

            <div class="section-line"></div>

            <h2>OUR GALLERY</h2>

            <p>
                Explore our construction work.
            </p>

        </div>


        <div class="gallery-container">

            <?php

            while ($item =
                   mysqli_fetch_assoc($gallery)) {

            ?>

                <img
                    src="uploads/<?php
                    echo htmlspecialchars(
                        $item['image']
                    );
                    ?>"
                    alt="<?php
                    echo htmlspecialchars(
                        $item['title']
                    );
                    ?>">

            <?php } ?>

        </div>

    </div>

</section>

<!-- ================= CUSTOMER FEEDBACK ================= -->

<section class="customer-reviews" id="feedback">

    <div class="container">

        <div class="section-title">

            <div class="section-line"></div>

            <h2>What Our Customers Say</h2>

            <p>
                Feedback from our valued customers
            </p>

        </div>


        <div class="feedback-grid">

            <?php

            if (
                $feedback_result &&
                mysqli_num_rows($feedback_result) > 0
            ) {

                while ($row = mysqli_fetch_assoc($feedback_result)) {

                    $rating = (int)$row['rating'];

            ?>

                    <div class="feedback-card">

                        <!-- GOLDEN STARS -->

                        <div class="feedback-rating">

                            <?php

                            for ($i = 1; $i <= 5; $i++) {

                                if ($i <= $rating) {

                                    echo '<i class="fa-solid fa-star"></i>';

                                } else {

                                    echo '<i class="fa-regular fa-star"></i>';

                                }

                            }

                            ?>

                        </div>


                        <!-- FEEDBACK MESSAGE -->

                        <p class="feedback-message">

                            "<?php
                            echo htmlspecialchars($row['message']);
                            ?>"

                        </p>


                        <!-- CUSTOMER NAME -->

                        <div class="feedback-customer">

                            <h4>
                                <?php
                                echo htmlspecialchars(
                                    $row['customer_name']
                                );
                                ?>
                            </h4>

                            <span>Customer</span>

                        </div>

                    </div>

            <?php

                }

            } else {

            ?>

                <div class="no-feedback">

                    <p>
                        No customer feedback available yet.
                    </p>

                </div>

            <?php

            }

            ?>

        </div>

    </div>

</section>

<!-- ================= CONTACT ================= -->

<section class="contact" id="contact">

    <div class="container">

        <div class="section-title">

            <div class="section-line"></div>

            <h2>CONTACT US</h2>

            <p>
                Get in touch with BM Construction.
            </p>

        </div>


        <div class="contact-container">


            <div class="contact-info">


                <div class="contact-item">

                    <i class="fa-solid fa-phone"></i>

                    <div>

                        <h3>Phone</h3>

                        <p>
                            +91 98765 43210
                        </p>

                    </div>

                </div>


                <div class="contact-item">

                    <i class="fa-solid fa-envelope"></i>

                    <div>

                        <h3>Email</h3>

                        <p>
                            info@bmconstruction.com
                        </p>

                    </div>

                </div>


                <div class="contact-item">

                    <i class="fa-solid fa-location-dot"></i>

                    <div>

                        <h3>Address</h3>

                        <p>
                            Nashik, Maharashtra, India
                        </p>

                    </div>

                </div>

            </div>


            <form
                class="contact-form"
                action="send_message.php"
                method="POST">


                <input
                    type="text"
                    name="name"
                    placeholder="Your Name"
                    required>


                <input
                    type="email"
                    name="email"
                    placeholder="Your Email"
                    required>


                <input
                    type="text"
                    name="subject"
                    placeholder="Subject"
                    required>


                <textarea
                    name="message"
                    placeholder="Your Message"
                    rows="5"
                    required></textarea>


                <button
                    type="submit"
                    name="send_message"
                    class="submit-btn">

                    SEND MESSAGE

                </button>

            </form>

        </div>

    </div>

</section>

<?php include "footer.php"; ?>

</body>

</html>