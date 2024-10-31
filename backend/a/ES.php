<?php
include_once("config.php");
require_once("./functions/read.php");



session_start();
if (isset($_SESSION['user_id']))
{
  $user_id = $_SESSION['user_id'];
}
else
{
  header("Location: SE.php");
  exit();
}
// When someone first logs in or creates an account, the DB needs to delete all events that have already happened.
// This code collects the current date and selects all events that have already happened.
// $currentDate = date('Y-m-d');
// $sql = "SELECT * FROM EVENTS WHERE DATETIME < ?";
// $stmt = $mysqli->prepare($sql);
// $stmt->bind_param('s', $currentDate);
//
// // Once it has those events, it loops through them and deletes any RSVPs there might be tied to those events.
// // It then deletes the event.
//
// if ($stmt->execute())
// {
//
//     $result = $stmt->get_result();
//
//     while ($row = $result->fetch_assoc())
//     {
//       $delete = "DELETE FROM EVENT_STATUS WHERE EVENT_ID = ?";
//       $id = $row['EVENT_ID'];
//       $cool = $mysqli->prepare($delete);
//       $cool->bind_param('i', $id);
//       $cool->execute();
//
//       $deleteRecord = "DELETE FROM EVENTS WHERE EVENT_ID = ?";
//       $wassup = $mysqli->prepare($deleteRecord);
//       $wassup->bind_param('i', $id);
//       $wassup->execute();
//     }
// }
// else
// {
//     echo "Error";
// }
// # Will display errors
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// ?>

<!DOCTYPE html>
<html lang="en">
<!--Home page for user if not in creator mode here they will see all events nearby-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventHub</title>
    <link rel="stylesheet" href="bootstrap-2.css">
</head>

<body>
    <header class=".center">
        <div class="topBtn" style="padding-top: 1%;">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle"> Account</button>
                <div class="dropdown-content">
                    <a href="userSettings.php">My Profile</a>
                    <a href="ESManageer.php">Creator Mode</a>
                    <a href="ESMyEvents.php">My Events</a>
                    <a href="Confirm_Logout.php">Logout</a>
                </div>
            </div>
        </div>
    </header>
    <main class="box2">
        <div>
            <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
                <div class="container-fluid">
                <img style="width: 4%; height: 4%; margin-left: 0%;" src="2.png">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarColor01">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="ES.php">Home
                                    <span class="visually-hidden">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="FilterLocation.php">Filter by Location</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="FilterCategory.php">Filter by Category</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="FilterDate.php">Filter by Date</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div>



            <div class="row">
                <?php




                $stmt = $mysqli->prepare("SELECT * FROM EVENTS");
                $stmt->execute();
                $result = $stmt->get_result();


                echo(reviews($mysqli));





                // Array mapping categories to image URLs
                $category_images = array(
                    "sport" => "sports.png",
                    "gaming" => "gaming.png",
                    "movies" => "movies.png",
                    "music" => "music.png",
                    "meetup" => "meetup.png",
                    "studying" => "studying.png",
                    "pets" => "pets.png",
                    "dancing" => "dancing.png",
                    "reading" => "reading.png",
                    "cosplay" => "cosplay.png",
                    "sewing" => "sewing.png",
                    "hiking" => "hiking.png",
                    "quilting" => "quilting.png",
                    "tableTop" => "tabletop.png",
                    "cardGame" => "cardgame.png"
                );

                function displayStars($num) {
                $maxStars = 5; // maximum stars to show
                $fullStar = "⭐";
                $emptyStar = "☆";

                    // Make sure the number doesn't exceed the max
                $num = min($num, $maxStars);

                    // Generate full stars
                $stars = str_repeat($fullStar, $num);

                    // Add empty stars for the remaining
                $stars .= str_repeat($emptyStar, $maxStars - $num);
                    return $stars;
                }



                while ($row = $result->fetch_assoc()) {

                    echo '<div class="col-lg-4 mb-3">'; // "mb-3" adds margin-bottom for spacing between cards
                    echo '<div class="card">';
                    echo '<h3 class="card-header" style="font-size:35px; color:white">'. htmlspecialchars($row['EVENT_NAME']). '</h3>';
                    echo '<div class="card-body">';
                    echo '</div>'; // Closing the card-body div correctly
                    $cat_id = $row['CATEGORY'];
                    $testing = "SELECT CATEGORY_NAME FROM CATEGORIES WHERE CATEGORY_ID = ?";
                    $wassup = $mysqli->prepare($testing);
                    $wassup->bind_param('i', $cat_id);
                    $wassup->execute();
                    $yippee = $wassup->get_result();

                    // Finding the category image
                    while ($uwu = $yippee->fetch_assoc())
                    {
                        $category = $uwu['CATEGORY_NAME'];
                    }
                    if (array_key_exists($category, $category_images)) {
                        $image_url = $category_images[$category];
                    } else {
                        $image_url = "sports.png";  // INSERT DEFAULT IMAGE?????
                    }

                    echo '<img src="' . htmlspecialchars($image_url) . '"  class="card-img-top" alt="icon">';
                    echo '<div class="card-body">';
                    echo  '<div class="stars">' . displayStars(getStarsAvg(2)) . '</div>';
                    echo '</div>';
                    echo '<div class="card">';
                    echo '<ul class="list-group list-group-flush">';
                    echo '<div class="textAlign" style="font-size:25px">';
                    echo '<li class="list-group-item textAlign"> Description: ' . htmlspecialchars($row['EVENT_DESCR']) . '</li>';
                    echo '<li class="list-group-item textAlign"> Street: ' . htmlspecialchars($row['STREET_ADD']) . '</li>';
                    $date = new DateTime(($row['DATETIME']));
                    echo '<li class="list-group-item textAlign"> Date: ' . $date->format('m-d-y H:i A') . '</li>';
                    echo '<li class="list-group-item textAlign"> Zip: ' . htmlspecialchars($row['ZIPCODE']) . '</li>';
                    echo '</div>';
                    echo '</ul>';
                    echo '<form action="save_RSVP.php" method="POST">
                            <input type="hidden" name="event_id" value="' . $row["EVENT_ID"] . '">
                            <input type="hidden" name="user_id" value="' . $user_id . '">
                            <div style="display: flex; align-items: center;">
                                <label>
                                <input type="radio" name="rsvp" value="3"> Going
                                </label>
                                <label style="margin-left: 5%;">
                                <input type="radio" name="rsvp" value="1"> Not Going
                                </label>
                                <label style="margin-left: 5%;">
                                <input type="radio" name="rsvp" value="2"> Interested
                                </label>
                                <button type="submit" class="btn btn-primary" style="margin-left: 5%;">Submit</button>
                            </div>
                            </form>';
                    echo '</div>'; // Closing the card div
                    echo '</div>';
                    echo '<div class="card-footer">';
                    echo '</div>';
                    echo '</div>'; // Closing the col-lg-4 div
                }
                ?>
            </div>
        </div>
    </main>

</body>
<footer id="vue-footer">
    <div style="text-align:center;">
        <em>&copy; 2024 EventHub </br></em>
        <em> CS 4003 Software Engineering</em>
        <p>{{currentDate}} {{currentTime}}</p>

    </div>
    <script src="ES.js"></script>
</footer>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script>

 const MyComponent = {
        props: ['message'],
        template: `<div><h1>{{ message }}</h1></div>`
    };

    // Create and mount the Vue app
    const app = Vue.createApp({
        components: {
            MyComponent
        }
    });
    app.mount('#app');

// const app = Vue.createApp({
//     data() {
//         return {
//             currentDate: '', // Store the date string
//             currentTime: '' // Store the time string
//         };
//     },
//     mounted() {
//         // Update date and time when the component is mounted
//         this.updateDateTime();
//         // Set interval to update time every second
//         setInterval(this.updateDateTime, 1000);
//     },
//     methods: {
//         // Method to get the current date and time
//         updateDateTime() {
//             const now = new Date();
//             this.currentDate = now.toLocaleDateString(); // e.g., "10/16/2024"
//             this.currentTime = now.toLocaleTimeString(); // e.g., "9:45:12 PM"
//         }
//     }
// });
//
// app.mount('#vue-footer'); // Mount the Vue app
</script>
