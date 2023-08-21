<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="user_footer_style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,700&display=swap">
    <link rel="icon" href="Photos/Black mini logo.png">
    <title>User Page</title>
    <!-- Add any CSS and JavaScript files here -->
    <style>
        /* Add your CSS styles here */
        body {
            background-color: black;
        }

        .logo_A {
            border-radius: 100%;
            border: 2PX solid;
            width: auto;
            height: auto;
            border-image-outset: 6px;
        }
        .h1U {
            border: 2px;
            position: center;
            color: #E2C353;
            text-align: center !important;

            /* CSS styles for h1 with class h1U */
        }

        .h3U {


            /* CSS styles for h3 with class h3U */
        }

        .h2U {
            border: 3px;
            border-color: #E2C353;
            /* CSS styles for h2 with class h2U */
        }

        /* Existing styles for nav bar (header) and other elements are here ... */

        /* Styling for the user information and rental information sections */
        .user-rental-sections {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }

        .user-info-section,
        .rental-info-section {
            margin-bottom: 20px;
            width: 40%;
            margin: 60px;
            padding: 20px;
            color: white;
            background-color: black;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Add box shadow to each box */
            /* Add transition for smooth hover effect */
            justify-content: center;
            align-items: center;
        }

        /* Apply hover effect to both user info and rental info sections */
        .user-info-section:hover,
        .rental-info-section:hover {
            width: 45%;
            box-shadow: 0 8px 16px white;
            /* Modify box shadow on hover */
        }

        /* Table styling for rental details */
        #rentalTable {
            width: 100%;
            border-collapse: collapse;
        }

        #rentalTable th,
        #rentalTable td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid white;
        }

        #rentalTable th {
            background-color: #3230C0;
            color: white;
        }

        /* Media query for responsive layout */
        @media (max-width: 768px) {

            .user-info-section,
            .rental-info-section {
                width: 100%;
            }
        }
       
    </style>
</head>

<body>
    <?php
    // Check if the user is logged in
    session_start();
    if (isset($_SESSION['user'])) {
        // Retrieve user information from the session or database
        $user = $_SESSION['user'];

        // Retrieve user rental information from the database
        $email = $user['email']; // Assuming the email is stored in the session or database
        $servername = "localhost";
        $db_username = "root";
        $password_db = "";
        $dbname = "ucr";
        $conn = new mysqli($servername, $db_username, $password_db, $dbname);

        // Replace with your database credentials
        $query = "SELECT car, model, Return_Date, Pickup_Date FROM reservations WHERE email='$email'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {

            echo "<img src='Photos/UCR Logo (S).png'alt='Unbelievable Car Rentels Logo' id='logo_A' style='border-reduis:100%'>";
                echo "<div class='center'>";
            echo "<div class='user-info-section'>";
            echo "<h1 class='h1U'>User Information</h1>";
            echo "<h3 class='h3U'>Name: " . $user['name'] . "</h3>";
            echo "<h3 class='h3U'>CIN: " . $user['CIN'] . "</h3>";
            echo "<h3 class='h3U'>Phone Number: " . $user['phone'] . "</h3>";
            echo "<h3 class='h3U'>Email: " . $user['email'] . "</h3>";
            echo "</div>";
            echo "<div class='rental-info-section'>";
            echo "<h1 class='h1U'>Rental Information</h2>";
            echo "<table id='rentalTable'>
        <tr>
            <th>Car</th>
            <th>Car Model</th>
            <th>Pickup Date</th>
            <th>Return Date</th>    
        </tr>";
            // Output each rental row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['car'] . "</td>";
                echo "<td>" . $row['model'] . "</td>";

                echo "<td>" . $row['Pickup_Date'] . "</td>";
                echo "<td>" . $row['Return_Date'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
            echo "</div>";
            echo "</div>";
        } else {
            echo "No rental information found for this user.";
        }

        // Close the database connection
        mysqli_close($conn);

    } else {
        echo "Please log in to view this page.";
    }
    ?>
    

    <div class="footer_A">

<div class="want-cont_A">

    <h1>We want to hear from you!</h1>
    <DIV class='contact'><a href='index.html'>Home</a></DIV>
    <DIV class='contact'><a href='logout.php'>LogOut</a></DIV>
                
</div>

<div class="social-media_A">

    <h3>You can contact us through the following channels:</h3>

    <div class="email">

        <img src="Photos/golden email.png" alt="">
        <h3>Email : <span class="span3_A">UnbelievableCarRentals@gmail.com</span></h3>

    </div>

    <div class="facebook">

        <img src="Photos/golden fb.png" alt="">
        <h3>facebook : <a href="#">www.facebook.com\UnbelievableCarRentals</a></h3>

    </div>

    <div class="twitter">

        <img src="Photos/golden twitt.png" alt="">
        <h3>twitter : <a href="#">www.twitter.com\UnbelievableCarRentals</a></h3>

    </div>

    <div class="instagram">

        <img src="Photos/golden insta.png" alt="">
        <h3>instagram: <a href="#">www.instagram.com\UnbelievableCarRentals</a></h3>

    </div>

    <DIv class="text_A">
        <h3> OR CLICK HERE :</h3>
    </DIv>
    <DIV class="contact"><a href="contacthtml.html">contact us</a></DIV>

</div>

<h4 id="last_slogon_A">UCR here for you</h4>
<div id="line9_A"></div>

<h4 id="copyright">UCR : Unbelievable Car Rentals - © 2023 All rights reserved</h4>

</div>










</html>