<?php
session_start();

if (isset($_SESSION['admin_ID'])) {
    if (
        ($_SESSION['userName'] == "Sulaiman" and $_SESSION['pass'] == "430833075a312085784b04e43dbdc5e996e83f76")
        or
        ($_SESSION['userName'] == "Rana" and $_SESSION['pass'] == "c8f998efe3f4741eb7a5c4835d6a54f716c1764c")
    ) {
?>
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
                <div class="admin-info">
                    <span>welcome <?php echo $_SESSION['userName'] ?></span>
                    <a href="../logout.php">logout</a>
                </div>
            </header>
            <main>
                <section>
                    <div class="heading-section">
                        <h2>all courses</h2>
                        <a href="addCourse.php">add new course</a>
                    </div>
                    <?php
                    require '../connect.php';
                    $sql = "SELECT * FROM courses";
                    $result = $conn->query($sql);

                    $counter = 1;
                    if ($result->num_rows > 0) {
                    ?>
                        <table class="show-courses">
                            <tr>
                                <th>#</th>
                                <th>course image</th>
                                <th>course title</th>
                                <th>controls</th>
                            </tr>
                            <?php
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $counter; ?></td>
                                    <td>
                                        <img src="<?php echo 'uploads/' . $row["coursePicture"]; ?>" alt="" style="width: 100px; height: 100px;" />
                                    </td>
                                    <td><?php echo $row['courseTitle']; ?></td>
                                    <td><a href="viewCourse.php?box=view_course&course_ID=<?php echo $row['course_ID']; ?>">view course</a></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>

                    <?php
                    } else {
                        echo "No courses have been added";
                    }
                    ?>
                </section>
            </main>
        </body>

        </html>
<?php
    } else {
        echo "403 Forbidden";
    }
} else {
    echo "403 Forbidden";
}
