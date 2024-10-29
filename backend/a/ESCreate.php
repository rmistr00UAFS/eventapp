<!DOCTYPE html>
<html lang="en">

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


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    # Initializing variables from the site
    $eventName = $_POST['event_name'];
    $eventDescr = $_POST['event_descr'];
    $eventStreet = $_POST['event_street'];
    $eventCity = $_POST['event_city'];
    $eventZip = $_POST['event_zip'];
    $eventCat = $_POST['event_cat'];
    $eventDate = $_POST['event_date'];
    $website = $_POST['website'];

    # Verifying that none of the values are empty
    if (empty($website) || empty($eventName) || empty($eventDescr) || empty($eventStreet) || empty($eventCity) || empty($eventZip) || empty($eventCat) || empty($eventDate))
    {
        echo "One or more of the values is empty";
    }
    # Checking to make sure zipcode is the correct length
    else if (strlen((string)$eventZip) != 5)
    {
        echo "Invalid zipcode";
    }
    else
    {
      # Finding value from the categories dropdown and querying for its ID # in the DB
      $sql = "SELECT CATEGORY_ID FROM CATEGORIES WHERE CATEGORY_NAME = ?";
      $result = $mysqli->prepare($sql);
      $result->bind_param('s',$eventCat);
      $result->execute();
      $wassup = $result->get_result();

      if ($wassup->num_rows > 0)
      {
        $row = $wassup->fetch_assoc();

        $category = $row['CATEGORY_ID'];
      }

      $address = $eventStreet . " " . $eventCity . ", AR " . $eventZip;

      $apiKey = "CR638URQ0VGqkceCO0a4fDSAk9Xe0hwv";
      $origin = urlencode($address);

      $url = "https://api.tomtom.com/search/2/geocode/%7B$origin%7D.json?key={$apiKey}";

      $reply = file_get_contents($url);

      $info = json_decode($reply);
          
      if (empty($info->results))
      {
          return null;
      }
      else
      {
          $latOrig = $info->results[0]->position->lat;
          $longOrig = $info->results[0]->position->lon;
      }

      # Executing insert statement to create the event
      $stmt = $mysqli->prepare("INSERT INTO EVENTS (EVENT_NAME,EVENT_DESCR,STREET_ADD,CITY,ZIPCODE,CREATOR,CATEGORY,DATETIME,WEBSITE,LATITUDE,LONGITUDE) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
      $stmt->bind_param("sssssiissdd",$eventName,$eventDescr,$eventStreet,$eventCity,$eventZip,$user_id,$category,$eventDate,$website,$latOrig,$longOrig);
      $stmt->execute();
    }
}
?>

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
              <a href="ES.php">Customer Mode</a>
              <a href="ESMyEvents.php">My Events</a>
              <a href="Confirm_Logout.php">Logout</a>
          </div>
         </div>
      </div>
      
    </header>
    <main>
        <div class="box2">
        <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
            <div class="container-fluid">
            <img style="width: 4%; height: 4%; margin-left: 0%;" src="2.png">
                <ul class="navbar-nav me-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="ESManageer.php">Home</a>
                    <li class = "nav-item">
                    <a class="nav-link active" href="ESCreate.php">Create
                        <span class="visually-hidden">(current)</span>
                    </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ESManage.php">Manage</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="FilterLocationManager.php">Filter by Location</a>
                    </li>
                    <li class="nav-item">
                            <a class="nav-link" href="FilterCategoryManager.php">Filter by Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="FilterDateManager.php">Filter by Date</a>
                        </li>
                </ul>
                
            </div>
          </nav>
        </div>
          <div class="box3">
            <fieldset>
                <legend> Event Creation </legend>

                <!-- Form -->
                <form method="POST" action="">
    
                <label class="col-form-label mt-4" for="inputDefault">Event Name:</label>
                <input type="text" class="form-control-2" placeholder="Event Name" id="eName" name="event_name">
                <span>*</span>
                <br>

                <label class="col-form-label mt-4" for="inputDefault">Event Description:</label>
                <input type="text" class="form-control-2" placeholder="Description" id="Desc" name="event_descr">
                <span>*</span>
                <br>
                
                <label class="col-form-label mt-4" for="inputDefault">Street Address:</label>
                <input type="text" class="form-control-2" placeholder="Street" id="strtAdd" name="event_street" >
                <span>*</span>
                <br>

                <label class="col-form-label mt-4" for="inputDefault">City:</label>
                <input type="text" class="form-control-2" placeholder="City" id="city" name="event_city">
                <span>*</span>
                <br>

                <label class="col-form-label mt-4" for="inputDefault">Zip Code:</label>
                <input type="text" class="form-control-2" placeholder="Zip" id="zip" name="event_zip">
                <span>*</span>
                <br>
                
                <label for="Cat">Category</label>
                <select class="col-form-label mt-4" style="border-radius: var(--bs-border-radius); color: rgba(135,137,158,255);" id="Cat" name="event_cat">
                    <option value="sport">Sports</option>>
                    <option value="gaming">Gaming</option>                  
                    <option value="movies">Movies</option> 
                    <option value="music">Music</option>
                    <option value="meetup">Meetup</option> 
                    <option value="studying">Studying</option> 
                    <option value="pets">Pets</option> 
                    <option value="dancing">Dancing</option> 
                    <option value="reading">Reading</option> 
                    <option value="cosplay">Cosplay</option> 
                    <option value="sewing">Sewing</option> 
                    <option value="hiking">Hiking</option>
                    <option value="quilting">Quilting</option> 
                    <option value="tableTop">Table Top</option> 
                    <option value="cardGame">Card Game</option> 
                </select>
                <span>*</span>
                <br>

                <label class="col-form-label mt-4" for="inputDefault">Event Date:</label>
                <input type="datetime-local" class="form-control-2" style = "color: rgba(135,137,158,255);"id="Date" name="event_date">
                <span>*</span>
                <br>

                <label class="col-form-label mt-4" for="inputDefault">Website:</label>
                <input type="text" class="form-control-2" placeholder="Website" id="Date" name="website">
                <span>*</span>
                <br>
                <div class="botBtn1">
                  <br>
                 <button type="submit" class="btn btn-primary" id="createBtn">Create Event</button>
                </div>
                </form>

            </fieldset>
            
            <br>

                
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
