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
                <button class="btn btn-primary dropdown-toggle"> Account</button>
                <div class="dropdown-content">
                    <a href="userSettings.php">My Profile</a>
                    <a href="ES.php">Customer Mode</a>
                    <a href="ESMyEvents.php">My Events</a>
                    <a href="Confirm_Logout.php">Logout</a>
                </div>
            </div>
        </div>

    </header>
    <main class="box2">
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
            <div class="container-fluid">
            <img style="width: 4%; height: 4%; margin-left: 0%;" src="2.png">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="ESManageer.php">Home</a>
                    <li class="nav-item">
                        <a class="nav-link" href="ESCreate.php">Create
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
                            <a class="nav-link active" href="FilterDateManager.php">Filter by Date</a>
                            <span class="visually-hidden">(current)</span>
                        </li>
                </ul>
               
            </div>
            </div>
            </nav>
        <table class="table table-hover" id="ET">
            <thead>
                <tr class="table-active">
                    <th scope="col">Event Name</th>
                    <th scope="col">Event Location</th>
                    <th scope="col">Event Time</th>
                    <th scope="col"></th>
                    
                    
                </tr>
            </thead>
            <tbody>

                <!-- Form -->
                <form method="POST" action="">

                <label class="col-form-label mt-4" for="inputDefault">Start Date:</label>
                <input type="datetime-local" class="form-control-2"  id="Date" name="event_start_date">
                <span>*</span>
                <br>

                <label class="col-form-label mt-4" for="inputDefault">End Date:</label>
                <input type="datetime-local" class="form-control-2"  id="Date" name="event_end_date">
                <span>*</span>
                <br>

                <div class="botBtn1">
                        <br>
                        <button type="submit" class = "btn btn-primary" id="address">Filter</button>
                    </div>
                </form>

                <?php
                    // Querying for events between the chosen dates
                    if ($_SERVER["REQUEST_METHOD"] == "POST")
                    {  
                        $start_date = $_POST['event_start_date'];
                        $end_date = $_POST['event_end_date'];
                        $sql = "SELECT * FROM EVENTS WHERE DATETIME BETWEEN ? AND ?";
                        
                        $stmt = $mysqli->prepare($sql);

                        $stmt->bind_param('ss', $start_date, $end_date);
                        $stmt->execute();
                        
                        $yippee = $stmt->get_result();   
                        while ($row = $yippee->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['EVENT_NAME']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['STREET_ADD']) . ", " . htmlspecialchars($row['CITY']) . ", AR " . htmlspecialchars($row['ZIPCODE']) . "</td>";
                                $date = new DateTime(($row['DATETIME']));
                                echo '<td>'. $date->format('m-d-y H:i A') . '</li></td>';
                                
                                echo '<td>
                                <form action="save_RSVP.php" method="POST">
                        <input type="hidden" name="event_id" value="' . $row["EVENT_ID"] . '">
                        <input type="hidden" name="user_id" value="' . $user_id . '">
                        
                        <div style="display: flex; align-items: center;">
                        
                            <input type="radio"  name="rsvp" value="3"> Going
                            
                            <input type="radio" style = "margin-left:5%" name="rsvp" value="1"> Not Going
                            
                            <input type="radio" style = "margin-left:5%" name="rsvp" value="2"> Interested
                            
                            <button type="submit" class="btn btn-primary" style = "margin-left:10%" ">Submit</button>
                            </form>
                        </td>
                        </tr>
                        </div>';
                        }                    
                }
                ?>
            </tbody>
        </table>

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