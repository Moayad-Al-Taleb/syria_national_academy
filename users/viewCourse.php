<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/viewCourse.css">

</head>

<body>

    <header>
        <div class="logo">
            s.n.a
        </div>
        <nav class="navbar">
            <a href="index.php">home</a>
        </nav>
        <div class="header-btns">
            <a class="btn1" href="#">log in</a>
            <a class="btn2" href="#">sign up</a>
        </div>
    </header>
    <?php
    if (isset($_GET['box'])) {
        if ($_GET['box'] == "view_course") {
            $course_ID = intval($_GET['course_ID']);

            require '../connect.php';
            $sql = "SELECT * FROM courses WHERE course_ID = '$course_ID'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

    ?>
            <main>
                <section>
                    <div class="course-header-content">
                        <img class="course-img" src="<?php echo '../admin/uploads/' . $row["coursePicture"]; ?>" alt="">
                        <div class="overflow"></div>
                        <div class="course-img-content">
                            <h2><?php echo $row['courseTitle']; ?></h2>
                            <div>
                                <span>course teacher:</span> <?php echo $row['teacherName']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="course-details">
                        <h3>course description</h3>
                        <div class="col-75">
                            <p>
                                <?php echo $row['courseDetails']; ?>
                            </p>
                        </div>
                        <div class="col-25">
                            <div class="course-info">
                                <span>start date:</span> <?php echo $row['courseStartDate']; ?>
                            </div>
                            <div class="course-info">
                                <span>end date:</span> <?php echo $row['courseEndDate']; ?>
                            </div>
                            <div class="course-info">
                                <span>price:</span> <?php echo $row['coursePrice']; ?> S.P
                            </div>
                            <div class="course-info">
                                <span>sessions:</span> <?php echo $row['numberSessions']; ?>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
            <footer>
                powered by <span>
                    syrian national academy
                </span>
            </footer>
    <?php
        }
    }
    ?>
</body>

</html>