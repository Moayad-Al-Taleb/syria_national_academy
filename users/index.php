<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <div class="logo">
            s.n.a
        </div>
        <nav class="navbar">
            <a href="#hero">home</a>
            <a href="#courses">courses</a>
        </nav>
        <div class="header-btns">
            <a class="btn1" href="#">log in</a>
            <a class="btn2" href="#">sign up</a>
        </div>
    </header>
    <main>
        <section id="hero" class="hero">
            <img class="hero-img" src="images/home-img.jpg" alt="">
            <div class="overflow">
            </div>
            <div class="hero-content">
                <h1>find our best courses & become the master</h1>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit voluptatem commodi maxime quidem neque eligendi expedita unde quod sequi reiciendis! Facilis beatae animi impedit reprehenderit omnis odio temporibus laboriosam aperiam?
                </p>
                <a href="#">learn more</a>
            </div>
        </section>
        <section class="courses-sec" id="courses">
            <div class="section-heading">
                <h2>our courses</h2>
            </div>
            <div class="courses-container">
                <?php
                require '../connect.php';

                $sql = "SELECT * FROM courses";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <a href="viewCourse.php?box=view_course&course_ID=<?php echo $row['course_ID']; ?>" class="course">
                            <span class="price"> <?php echo $row['coursePrice']; ?> S.P</span>
                            <div class="course-img">
                                <img src="<?php echo '../admin/uploads/' . $row["coursePicture"]; ?>" alt="">
                            </div>
                            <div class="course-info">
                                <h4><?php echo $row['courseTitle']; ?></h4>
                                <span>teacher: <?php echo $row['teacherName']; ?> </span>
                                <span>sessions: <?php echo $row['numberSessions']; ?> </span>
                            </div>
                        </a>

                    <?php
                    }
                    ?>

                <?php
                } else {
                    echo "No courses have been added";
                }
                ?>
            </div>
        </section>
    </main>
    <footer>
        powered by <span>
            syrian national academy
        </span>
    </footer>
</body>

</html>