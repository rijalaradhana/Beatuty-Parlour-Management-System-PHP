<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);

if (isset($_POST['submit'])) {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $contno = $_POST['mobilenumber'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $ret = mysqli_query($con, "select Email from tbluser where Email='$email' || MobileNumber='$contno'");
    $result = mysqli_fetch_array($ret);
    if ($result > 0) {

        echo "<script>alert('This email or Contact Number already associated with another account!.');</script>";
    } else {
        $query = mysqli_query($con, "insert into tbluser(FirstName, LastName, MobileNumber, Email, Password) value('$fname', '$lname','$contno', '$email', '$password' )");
        if ($query) {

            echo "<script>alert('You have successfully registered.');</script>";
            echo '<script>window.location.href=login.php</script>';
        } else {

            echo "<script>alert('Something Went Wrong. Please try again.');</script>";
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>


    <title>Beauty Parlour Management System | Signup Page</title>

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
    <script type="text/javascript">
        function checkpass() {
            if (document.signup.password.value != document.signup.repeatpassword.value) {
                alert('Password and Repeat Password field does not match');
                document.signup.repeatpassword.focus();
                return false;
            }
            return true;
        } 
    </script>
    <!-- disable body scroll which navbar is in active -->

    <!-- breadcrumbs -->
    <section class="w3l-inner-banner-main">
        <div class="about-inner contact ">
            <div class="container">
                <div class="main-titles-head text-center">
                    <h3 class="header-name ">

                        Signup
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
                        Signup</li>
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
                                    <p class="para"><a href="tel:+44 99 555 42">+<?php echo $row['MobileNumber']; ?></a></p>
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
                        <h3>Register with us!!</h3>
                        <form method="post" name="signup" onsubmit="return checkpass();">
                            <!-- first name starts here -->
                            <div style="padding-top: 30px;">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="firstname" id="firstname"
                                    placeholder="First Name" required>
                                <span id="name-error" style="color: red; display: none;">First name must contain only
                                    alphabets</span>
                            </div>

                            <script>
                                document.getElementById("firstname").addEventListener("input", function () {
                                    let firstName = this.value;
                                    let errorMessage = document.getElementById("name-error");

                                    if (!/^[A-Za-z]+$/.test(firstName)) {
                                        errorMessage.style.display = "block";
                                    } else {
                                        errorMessage.style.display = "none";
                                    }
                                });
                            </script>
                            <!-- first name ends here -->


                            <!-- last name starts here -->
                            <div style="padding-top: 30px;">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="lastname" id="lastname"
                                    placeholder="Last Name" required>
                                <span id="lastname-error" style="color: red; display: none;">Last name must contain only
                                    alphabets</span>
                            </div>

                            <script>
                                document.getElementById("lastname").addEventListener("input", function () {
                                    let lastName = this.value;
                                    let errorMessage = document.getElementById("lastname-error");

                                    if (!/^[A-Za-z]+$/.test(lastName)) {
                                        errorMessage.style.display = "block";
                                    } else {
                                        errorMessage.style.display = "none";
                                    }
                                });
                            </script>
                            <!-- last name ends here -->


                            <!-- mobile number starts here -->
                            <div style="padding-top: 30px;">
                                <label>Mobile Number</label>
                                <input type="number" id="mobilenumber" class="form-control" placeholder="Mobile Number"
                                    name="mobilenumber" maxlength="10" required>
                                <span id="error-message" style="color: red; display: none;">Mobile number must be
                                    exactly 10 digits</span>
                            </div>

                            <script>
                                document.getElementById("mobilenumber").addEventListener("input", function () {
                                    let mobileNumber = this.value;
                                    let errorMessage = document.getElementById("error-message");

                                    if (!/^\d{10}$/.test(mobileNumber)) {
                                        errorMessage.style.display = "block";
                                    } else {
                                        errorMessage.style.display = "none";
                                    }
                                });
                            </script>

                            <script>
                                document.getElementById("mobilenumber").addEventListener("input", function () {
                                    let mobileNumber = this.value;
                                    let errorMessage = document.getElementById("error-message");

                                    if (!/^\d{10}$/.test(mobileNumber)) {
                                        errorMessage.style.display = "block";
                                    } else {
                                        errorMessage.style.display = "none";
                                    }
                                });
                            </script>

                            <script>
                                document.getElementById("mobilenumber").addEventListener("input", function () {
                                    let input = this.value;
                                    let errorMessage = document.getElementById("error-message");

                                    if (input.length === 10 && /^\d{10}$/.test(input)) {
                                        errorMessage.style.display = "none"; // Hide error message if valid
                                    } else {
                                        errorMessage.style.display = "block"; // Show error message if invalid
                                    }
                                });
                            </script>
                            <!-- mobile number ends here -->



                            <!-- email starts here -->
                            <div style="padding-top: 30px;">
                                <label>Email address</label>
                                <input type="email" class="form-control" class="form-control"
                                    placeholder="Email address" required="" name="email">
                            </div>
                            <!-- email ends here -->
                            <!-- password starts here -->

                            <div style="padding-top: 30px;">
                                <label>Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" required minlength="8" maxlength="20">
                                <small id="password-error" style="color: red; display: none;">Password must be 8-20
                                    characters long, include at least one uppercase letter, one number, and one special
                                    character (@$!%*?&).</small>
                            </div>

                            <script>
                                document.getElementById("password").addEventListener("input", function () {
                                    let password = this.value;
                                    let errorMessage = document.getElementById("password-error");

                                    // Regular expression to validate password
                                    let passwordPattern = /^(?=.*\d)(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/;

                                    if (passwordPattern.test(password)) {
                                        this.style.border = "2px solid green"; // Show success border
                                        errorMessage.style.display = "none"; // Hide error message
                                    } else {
                                        this.style.border = "2px solid red"; // Show error border
                                        errorMessage.style.display = "block"; // Show error message
                                    }
                                });
                            </script>
                            <!-- password ends here -->

                            <div style="padding-top: 30px;">
                                <label>Repeat password</label>
                                <input type="password" class="form-control" name="repeatpassword"
                                    placeholder="Repeat password" required="true">
                            </div>

                            <button type="submit" class="btn btn-contact" name="submit">Signup</button>
                        </form>
                    </div>
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
    </script>
    <!-- /move top -->
</body>

</html>