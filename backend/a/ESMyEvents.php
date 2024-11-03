<?php
include_once("config.php");

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

# Will display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>

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
            <button class="btn btn-primary dropdown-toggle" > Account</button>
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
        <div >
        <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
            <div class="container-fluid">
            <img style="width: 4%; height: 4%; margin-left: 0%;" src="2.png">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="ES.php">Home</a>
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
               
                    // Querying for all events the user is interested in or going to
                    $stmt = $mysqli->prepare("

                    SELECT E.EVENT_ID, E.EVENT_NAME, E.STREET_ADD, E.ZIPCODE, E.DATETIME, R.STATUS_ID, E.CATEGORY, E.EVENT_DESCR
        
                    FROM EVENTS E
        
                    LEFT JOIN EVENT_STATUS R ON E.EVENT_ID = R.EVENT_ID
        
                    WHERE R.USER_ID = ? AND (R.STATUS_ID = 2 OR R.STATUS_ID = 3)
        
                    ORDER BY R.STATUS_ID DESC
        
                            ");

                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();            
                    $result = $stmt->get_result();
                    
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
                            $image_url = "sports.png";
                        }



                        echo '   <input type="hidden" id="eventid" value="'.$row['EVENT_ID'].'">
            <input type="hidden" id="userid" value="'.$user_id.'">';





                        echo '<img src="' . htmlspecialchars($image_url) . '"  class="card-img-top" alt="icon">';
                        echo '<div class="card-body">';
                        echo '</div>';
                        echo '<div class="card">';


                         echo '<button onclick="toggleReviewForm()">leave review</button>';


                        echo '<div id="reviewForm"
                        style="display:none;"
                        >


                         <textarea id="comment" required></textarea>
    <select id="stars" name="stars" required>
        <option value="1">⭐</option>
        <option value="2">⭐⭐</option>
        <option value="3">⭐⭐⭐</option>
        <option value="4">⭐⭐⭐⭐</option>
        <option value="5">⭐⭐⭐⭐⭐</option>
    </select>

            <button onclick="submitReview()">Submit Review</button>


                    <button onclick="toggleReviewForm()">cancel</button>


                        </div>';


                        echo '<ul class="list-group list-group-flush">';
                        echo '<div class="textAlign" style="font-size:25px">';
                        echo '<li class="list-group-item textAlign"> Description: ' . htmlspecialchars($row['EVENT_DESCR']) . '</li>';
                        echo '<li class="list-group-item textAlign"> Street: ' . htmlspecialchars($row['STREET_ADD']) . '</li>';
                        echo '<li class="list-group-item textAlign"> Date: ' . htmlspecialchars($row['DATETIME']) . '</li>';
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
      <p>{{currentDate}}   {{currentTime}}</p>
      
  </div>
  <script src="ES.js"></script>
</footer>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script>

 function toggleReviewForm() {
            var form = document.getElementById("reviewForm");
            form.style.display = form.style.display === "none" ? "block" : "none";
        }

 function submitReview(){
        var userid = document.getElementById("userid").value;
    var eventid = document.getElementById("eventid").value;
    var comment = document.getElementById("comment").value;
    var stars = document.getElementById("stars").value;



    let data={userid,eventid,comment,stars}


       fetch("./write/review.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    }).then(response => response.text()).then(x=>{
        console.log(x)
                    location.reload();
    })



            }


const app = Vue.createApp({
  data() {
    return {
      currentDate: '',  // Store the date string
      currentTime: ''   // Store the time string
    };
  },
  mounted() {
    // Update date and time when the component is mounted
    this.updateDateTime();
    // Set interval to update time every second
    setInterval(this.updateDateTime, 1000);
  },
  methods: {
    // Method to get the current date and time
    updateDateTime() {
      const now = new Date();
      this.currentDate = now.toLocaleDateString(); // e.g., "10/16/2024"
      this.currentTime = now.toLocaleTimeString(); // e.g., "9:45:12 PM"
    }
  }
});

app.mount('#vue-footer'); // Mount the Vue app
</script>
               

                       
