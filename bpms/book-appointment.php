<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsuid'] == 0)) {
    header('location:logout.php');
} else {

    if (isset($_POST['submit'])) {

        $uid = $_SESSION['bpmsuid'];
        $adate = $_POST['adate'];
        $atime = $_POST['atime'];
        $msg = $_POST['message'];
        $aptnumber = mt_rand(100000000, 999999999);

        $query = mysqli_query($con, "insert into tblbook(UserID,AptNumber,AptDate,AptTime,Message) value('$uid','$aptnumber','$adate','$atime','$msg')");

        if ($query) {
            $ret = mysqli_query($con, "select AptNumber from tblbook where tblbook.UserID='$uid' order by ID desc limit 1;");
            $result = mysqli_fetch_array($ret);
            $_SESSION['aptno'] = $result['AptNumber'];
            echo "<script>window.location.href='thank-you.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }


    }
    ?>
    <!doctype html>
    <html lang="en">

    <head>


        <title>Beauty Parlour Management System | Appointment Page</title>

        <!-- Template CSS -->
        <link rel="stylesheet" href="assets/css/style-starter.css">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700,700i&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    </head>

    <body id="home">
        <?php include_once('includes/header.php'); ?>

        <script src="assets/js/jquery-3.3.1.min.js"></script> <!-- Common jquery plugin -->
        <!--bootstrap working-->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- //bootstrap working-->
        <!-- disable body scroll which navbar is in active -->
        <script>
            $(function () {
                $('.navbar-toggler').click(function () {
                    $('body').toggleClass('noscroll');
                })
            });
        </script>
        <!-- disable body scroll which navbar is in active -->

        <!-- breadcrumbs -->
        <section class="w3l-inner-banner-main">
            <div class="about-inner contact ">
                <div class="container">
                    <div class="main-titles-head text-center">
                        <h3 class="header-name ">

                            Book Parlour
                        </h3>
                    </div>
                </div>
            </div>
            <div class="breadcrumbs-sub">
                <div class="container">
                    <ul class="breadcrumbs-custom-path">
                        <li class="right-side propClone"><a href="index.php" class="">Home <span class="fa fa-angle-right"
                                    aria-hidden="true"></span></a>
                            <p>
                        </li>
                        <li class="active ">
                            Book Parlour</li>
                    </ul>
                </div>
            </div>
            </div>
        </section>
        <!-- breadcrumbs //-->
        <section class="w3l-contact-info-main" id="contact">
            <div class="contact-sec	">
                <div class="container">

                    <div class="d-grid contact-view">
                        <div class="cont-details">
                            <?php

                            $ret = mysqli_query($con, "select * from tblpage where PageType='contactus' ");
                            $cnt = 1;
                            while ($row = mysqli_fetch_array($ret)) {

                                ?>
                                <div class="cont-top">
                                    <div class="cont-left text-center">
                                        <span class="fa fa-phone text-primary"></span>
                                    </div>
                                    <div class="cont-right">
                                        <h6>Call Us</h6>
                                        <p class="para"><a href="tel:+9779810837339">+<?php echo $row['MobileNumber']; ?></a>
                                        </p>
                                    </div>
                                </div>
                                <div class="cont-top margin-up">
                                    <div class="cont-left text-center">
                                        <span class="fa fa-envelope-o text-primary"></span>
                                    </div>
                                    <div class="cont-right">
                                        <h6>Email Us</h6>
                                        <p class="para"><a href="mailto:example@mail.com"
                                                class="mail"><?php echo $row['Email']; ?></a></p>
                                    </div>
                                </div>
                                <div class="cont-top margin-up">
                                    <div class="cont-left text-center">
                                        <span class="fa fa-map-marker text-primary"></span>
                                    </div>
                                    <div class="cont-right">
                                        <h6>Address</h6>
                                        <p class="para"> <?php echo $row['PageDescription']; ?></p>
                                    </div>
                                </div>
                                <div class="cont-top margin-up">
                                    <div class="cont-left text-center">
                                        <span class="fa fa-map-marker text-primary"></span>
                                    </div>
                                    <div class="cont-right">
                                        <h6>Time</h6>
                                        <p class="para"> <?php echo $row['Timing']; ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="map-content-9 mt-lg-0 mt-4">
                            <form method="post">
                                <div style="padding-top: 30px;">
                                    <label>Appointment Date</label>
                                    <input type="date" class="form-control appointment_date" placeholder="Date" name="adate"
                                        id="adate" required>
                                </div>

                                <div style="padding-top: 30px;">
                                    <label>Appointment Time</label>
                                    <input type="time" class="form-control appointment_time" name="atime" id="atime"
                                        required min="08:00" max="19:00">
                                </div>

                                <div style="padding-top: 30px;">
                                    <textarea class="form-control" id="message" name="message" placeholder="Message"
                                        required></textarea>
                                </div>

                                <button type="submit" class="btn btn-contact" name="submit">Make an Appointment</button>
                            </form>
                        </div>

                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                const dateInput = document.getElementById('adate');
                                const timeInput = document.getElementById('atime');

                                function validateTime() {
                                    const inputTime = timeInput.value;
                                    const selectedDate = dateInput.value;

                                    if (!inputTime || !selectedDate) return;

                                    const [hours, minutes] = inputTime.split(':').map(Number);
                                    const selectedTimeInMinutes = hours * 60 + minutes;

                                    const minTime = 8 * 60;
                                    const maxTime = 19 * 60;

                                    // Check if time is within allowed range
                                    if (selectedTimeInMinutes < minTime || selectedTimeInMinutes > maxTime) {
                                        alert("Please select a time between 08:00 AM and 07:00 PM.");
                                        timeInput.value = "";
                                        return;
                                    }

                                    // Check if date is today and time is in the past
                                    const now = new Date();
                                    const todayStr = now.toISOString().split("T")[0];

                                    if (selectedDate === todayStr) {
                                        const selectedTime = new Date();
                                        selectedTime.setHours(hours, minutes, 0, 0);

                                        if (selectedTime <= now) {
                                            alert("You cannot select a past time for today's appointment.");
                                            timeInput.value = "";
                                            return;
                                        }
                                    }
                                }

                                timeInput.addEventListener('change', validateTime);
                                dateInput.addEventListener('change', validateTime); // Optional: recheck time if date changes
                            });
                        </script>

                    </div>

                </div>
            </div>
        </section>
        <?php include_once('includes/footer.php'); ?>
        <!-- move top -->
        <button onclick="topFunction()" id="movetop" title="Go to top">
            <span class="fa fa-long-arrow-up"></span>
        </button>
        <script>
            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function () {
                scrollFunction()
            };

            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    document.getElementById("movetop").style.display = "block";
                } else {
                    document.getElementById("movetop").style.display = "none";
                }
            }

            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
            $(function () {
                var dtToday = new Date();

                var month = dtToday.getMonth() + 1;
                var day = dtToday.getDate();
                var year = dtToday.getFullYear();
                if (month < 10)
                    month = '0' + month.toString();
                if (day < 10)
                    day = '0' + day.toString();

                var maxDate = year + '-' + month + '-' + day;
                $('#adate').attr('min', maxDate);
            });</script>
        <script>
            document.getElementById('timeForm').addEventListener('submit', function (e) {
                const selectedDate = document.getElementById('date').value;
                const selectedTime = document.getElementById('time').value;

                const now = new Date();
                const currentDate = now.toISOString().split('T')[0]; // format: yyyy-mm-dd

                if (selectedDate === currentDate) {
                    const [hours, minutes] = selectedTime.split(':');
                    const selectedDateTime = new Date();
                    selectedDateTime.setHours(hours);
                    selectedDateTime.setMinutes(minutes);
                    selectedDateTime.setSeconds(0);

                    if (selectedDateTime < now) {
                        e.preventDefault();
                        document.getElementById('error').textContent = "You cannot select a past time for today.";
                        return;
                    }
                }

                document.getElementById('error').textContent = "";
            });
        </script>

        <!-- /move top -->
    </body>

    </html><?php } ?>