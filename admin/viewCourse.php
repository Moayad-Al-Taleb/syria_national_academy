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
            <link rel="stylesheet" href="css/forms.css">
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
                <?php
                if (isset($_GET['box'])) {
                    if ($_GET['box'] == "view_course") {
                        $course_ID = intval($_GET['course_ID']);

                        require '../connect.php';
                        $sql = "SELECT * FROM courses WHERE course_ID = '$course_ID'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();

                ?>
                        <section>
                            <div class="heading-section">
                                <h2>course details</h2>
                                <a class="delete-btn" href="viewCourse.php?box=delete&course_ID=<?php echo $row['course_ID']; ?>">delete</a>
                                <a href="viewCourse.php?box=edit_info&course_ID=<?php echo $row['course_ID']; ?>">edit info</a>
                            </div>
                            <div class="course-header-content">
                                <img class="course-img" src="<?php echo 'uploads/' . $row["coursePicture"]; ?>" alt="">
                                <div class="overflow"></div>
                                <div class="course-img-content">
                                    <h2><?php echo $row['courseTitle']; ?></h2>
                                    <div>
                                        <span>course teacher:</span> <?php echo $row['teacherName'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="course-details">
                                <h3>course description</h3>
                                <div class="col-75">
                                    <p>
                                        <?php echo $row['courseDetails']  ?>
                                    </p>
                                </div>
                                <div class="col-25">
                                    <div class="course-info">
                                        <span>start date:</span> <?php echo $row['courseStartDate'] ?>
                                    </div>
                                    <div class="course-info">
                                        <span>end date:</span> <?php echo $row['courseEndDate'] ?>
                                    </div>
                                    <div class="course-info">
                                        <span>price:</span> <?php echo $row['coursePrice'] ?>
                                    </div>
                                    <div class="course-info">
                                        <span>sessions:</span> <?php echo $row['numberSessions'] ?>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php
                    } elseif ($_GET['box'] == "edit_info") {
                        $course_ID = intval($_GET['course_ID']);

                        require '../connect.php';

                        $sql = "SELECT * FROM courses WHERE course_ID = '$course_ID'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();

                        // ________________________________________
                        $courseTitle = $courseDetails = $coursePrice = $teacherName = $numberSessions = $courseStartDate = $courseEndDate = $coursePicture = "";
                        $courseTitle_err = $courseDetails_err = $coursePrice_err = $teacherName_err = $numberSessions_err = $courseStartDate_err = $courseEndDate_err = $coursePicture_err = "";
                        $update_state = "";
                        function data($word)
                        {
                            $word = trim($word);
                            $word = htmlspecialchars($word);

                            return $word;
                        }
                        // ________________________________________
                        if (isset($_POST['BTN_MODIFY_COURSE'])) {
                            // courseTitle
                            if (empty($_POST['courseTitle'])) {
                                $courseTitle_err = " *The field is required";
                            } else {
                                $courseTitle = data($_POST['courseTitle']);
                            }

                            // courseDetails
                            if (empty($_POST['courseDetails'])) {
                                $courseDetails_err = " *The field is required";
                            } else {
                                $courseDetails = data($_POST['courseDetails']);
                            }

                            // coursePrice
                            if (empty($_POST['coursePrice'])) {
                                $coursePrice_err = " *The field is required";
                            } else {
                                if ($_POST['coursePrice'] <= 0) {
                                    $coursePrice_err = "The value of the course should be between 1000 and 1000000";
                                } else {
                                    $coursePrice = data($_POST['coursePrice']);
                                }
                            }

                            // teacherName
                            if (empty($_POST['teacherName'])) {
                                $teacherName_err = " *The field is required";
                            } else {
                                $teacherName = data($_POST['teacherName']);
                            }

                            // numberSessions
                            if (empty($_POST['numberSessions'])) {
                                $numberSessions_err = " *The field is required";
                            } else {
                                if ($_POST['numberSessions'] <= 0) {
                                    $numberSessions_err = "The number of sessions must be at least 3 or more for 25";
                                } else {
                                    $numberSessions = data($_POST['numberSessions']);
                                }
                            }

                            // courseStartDate
                            if (empty($_POST['courseStartDate'])) {
                                $courseStartDate_err = " *The field is required";
                            } else {
                                $courseStartDate = data($_POST['courseStartDate']);
                            }

                            // courseEndDate
                            if (empty($_POST['courseEndDate'])) {
                                $courseEndDate_err = " *The field is required";
                            } else {
                                $courseEndDate = data($_POST['courseEndDate']);
                            }

                            // coursePicture
                            // if (empty($_FILES["coursePicture"]["name"])) {
                            //     $coursePicture_err = " *The field is required";
                            // } else {
                            //     // File upload path
                            //     $targetDir = "uploads/";
                            //     $fileName = basename($_FILES["coursePicture"]["name"]);
                            //     $targetFilePath = $targetDir . $fileName;
                            //     $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                            //     $_FILES["coursePicture"]["tmp_name"];

                            //     // Allow certain file formats
                            //     $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
                            //     if (in_array($fileType, $allowTypes)) {
                            //         // Upload file to server
                            //         if (move_uploaded_file($_FILES["coursePicture"]["tmp_name"], $targetFilePath)) {
                            //             $coursePicture = $fileName;
                            //         } else {
                            //             $coursePicture_err = "Sorry, there was an error uploading your file.";
                            //         }
                            //     } else {
                            //         $coursePicture_err = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
                            //     }
                            // }
                            if (!empty($_FILES["coursePicture"]["name"])) {
                                // File upload path
                                $targetDir = "uploads/";
                                $fileName = basename($_FILES["coursePicture"]["name"]);
                                $targetFilePath = $targetDir . $fileName;
                                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                                $_FILES["coursePicture"]["tmp_name"];

                                // Allow certain file formats
                                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
                                if (in_array($fileType, $allowTypes)) {
                                    // Upload file to server
                                    if (move_uploaded_file($_FILES["coursePicture"]["tmp_name"], $targetFilePath)) {
                                        $coursePicture = $fileName;
                                    } else {
                                        $coursePicture_err = "Sorry, there was an error uploading your file.";
                                    }
                                } else {
                                    $coursePicture_err = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
                                }
                            }


                            // ________________________________________
                            if (!empty($courseTitle) && !empty($courseDetails) && !empty($coursePrice) && !empty($teacherName) && !empty($numberSessions) && !empty($courseStartDate) && !empty($courseEndDate) && !empty($coursePicture)) {
                                require '../connect.php';

                                $sql = "UPDATE courses SET courseTitle = '$courseTitle', courseDetails = '$courseDetails', coursePrice = '$coursePrice', teacherName = '$teacherName', numberSessions = '$numberSessions', courseStartDate = '$courseStartDate', courseEndDate = '$courseEndDate', coursePicture = '$fileName' WHERE course_ID = '$course_ID'";

                                if ($conn->query($sql) === true) {
                                    $update_state =  "Record updated successfully";
                                    if (file_exists('uploads/' . $row['coursePicture'])) {
                                        unlink('uploads/' . $row['coursePicture']);
                                    }
                                } else {
                                    $update_state =  "Error: " . $sql . "<br>" . $conn->error;
                                }
                                $conn->close();
                                header("REFRESH:2, URL=index.php");
                            } elseif (!empty($courseTitle) && !empty($courseDetails) && !empty($coursePrice) && !empty($teacherName) && !empty($numberSessions) && !empty($courseStartDate) && !empty($courseEndDate)) {
                                require '../connect.php';

                                $sql = "UPDATE courses SET courseTitle = '$courseTitle', courseDetails = '$courseDetails', coursePrice = '$coursePrice', teacherName = '$teacherName', numberSessions = '$numberSessions', courseStartDate = '$courseStartDate', courseEndDate = '$courseEndDate' WHERE course_ID = '$course_ID'";

                                if ($conn->query($sql) === true) {
                                    $update_state =  "Record updated successfully";
                                } else {
                                    $update_state =  "Error: " . $sql . "<br>" . $conn->error;
                                }
                                $conn->close();
                                header("REFRESH:2, URL=index.php");
                            }
                        }
                    ?>
                        <div class="container">
                            <h2>enter course details</h2>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="input-field">
                                        <label for="courseTitle">title</label>
                                        <input type="text" name="courseTitle" id="courseTitle" value="<?php echo $row['courseTitle']; ?>"><?php echo $courseTitle_err; ?>
                                    </div>
                                    <div class="input-field">
                                        <label for="teacherName">teacher name:</label>
                                        <input type="text" name="teacherName" id="teacherName" value="<?php echo $row['teacherName']; ?>"><?php echo $teacherName_err; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field">
                                        <label for="coursePrice">price</label>
                                        <input type="number" name="coursePrice" id="coursePrice" value="<?php echo $row['coursePrice']; ?>"> <?php echo $coursePrice_err; ?>
                                    </div>
                                    <div class="input-field">
                                        <label for="courseDetails">details</label>
                                        <textarea name="courseDetails" id="courseDetails"> <?php echo $row['courseDetails']; ?></textarea> <?php echo $courseDetails_err; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field">
                                        <label for="numberSessions">sessions numbers</label>
                                        <input type="number" name="numberSessions" id="numberSessions" value="<?php echo $row['numberSessions']; ?>"><?php echo $numberSessions_err; ?>
                                    </div>
                                    <div class="input-field">
                                        <label for="coursePicture">image</label>
                                        <input type="file" name="coursePicture" id="coursePicture"> <?php echo $coursePicture_err; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field">
                                        <label for="courseStartDate">start date</label>
                                        <input type="date" name="courseStartDate" id="courseStartDate" value="<?php echo $row['courseStartDate']; ?>"><?php echo $courseStartDate_err; ?>
                                    </div>
                                    <div class="input-field">
                                        <label for="courseEndDate">end date</label>
                                        <input type="date" name="courseEndDate" id="courseEndDate" value="<?php echo $row['courseEndDate']; ?>"><?php echo $courseEndDate_err; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <input class="add-btn" type="submit" name="BTN_MODIFY_COURSE" value="edit info">
                                </div>
                                <?php echo $update_state ?>
                            </form>
                        </div>
                <?php
                    } elseif ($_GET['box'] == "delete") {
                        $course_ID = intval($_GET['course_ID']);
                        require '../connect.php';

                        $sql = "SELECT coursePicture FROM courses WHERE course_ID = '$course_ID'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();

                        $sql = "DELETE FROM courses WHERE course_ID = '$course_ID'";
                        if ($conn->query($sql) === TRUE) {
                            echo "Record deleted successfully";
                            if (file_exists('uploads/' . $row['coursePicture'])) {
                                unlink('uploads/' . $row['coursePicture']);
                            }
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                        $conn->close();
                        header("REFRESH:2, URL=index.php");
                    }
                }
                ?>
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
