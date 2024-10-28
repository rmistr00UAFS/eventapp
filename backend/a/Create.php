<?php
include_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){


        $email = $_POST['email'];

        // Verifying the user doesn't already exist
        $sql = "SELECT * FROM USERS WHERE EMAIL = ?"; 
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $email);

        $stmt->execute();

        $result = $stmt->get_result();

      
        if ($result->num_rows > 0) {
            echo "Account already exists in the database.";
        } else {
        
            // Getting data from site
            $fName = $_POST['fName'];
            $lName =  $_POST['lName'];
            $pass = $_POST['pass'];
            $org = $_POST['Organization'];
            $admin = $_POST['Admin'];
            $notif = $_POST['Notif'];
            $hashed = password_hash($pass, PASSWORD_DEFAULT);   // Hashing password
            
            
            if ($org === "yOrg") {
                $org = 1;
            } else {
                $org = 0;
            }
            
          
            if ($admin === "yAdmin") {
                $admin = 1;
            } else {
                $admin = 0;
            }
            
            if ($notif === "yNotif") {
                $notif = 1;
            } else {
                $notif = 0;
            }
            
             
            // Ensuring none of the vital fields are empty
           if (empty($fName)|| empty($lName) || empty($pass)){
                echo "One or more of the values is empty";
            } else{
             
            // Creating the account
            $stmt = $mysqli->prepare("INSERT INTO USERS (F_NAME,L_NAME,EMAIL,PASSWORD,ORGANIZATION,ADMIN,NOTIFICATIONS) VALUES (?,?,?,?,?,?,?)");
            $stmt->bind_param("ssssiii",$fName,$lName,$email,$hashed,$org,$admin,$notif);
            $stmt->execute();

            // Starting the user's session so user ID can be used across the site.
            session_start();
            $email = $_POST['email'];
            $sql = "SELECT USER_ID FROM USERS WHERE EMAIL = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $user_id = $row['USER_ID'];
                }
            } else {
                echo "No users found.";
            }

            $_SESSION['user_id'] = $user_id;
            header("Location: ES.php");
            }          
        }   
}

?>


<!DOCTYPE html>
<html lang="en">
<!-- PHP for the user creation page will send itself back to login page if account was created-->

<head class="form-group">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventHub</title>
    <link rel="stylesheet" href="bootstrap-2.css">
</head>

<body class="form-group">
    <header>
        <img class=".img1" src="2.png">
        <h1>Welcome to EventHub</h1>
    </header>
    <main>

        <div class="box11">
            <fieldset>
                <legend> Create Account </legend>

                <form method="POST" action="">

                    <label class="col-form-label mt-4" for="inputDefault">First Name:</label>
                    <input type="text" class="form-control-2" placeholder="Name" id="fName" name="fName">
                    <span>*</span>
                    <br>

                    <label class="col-form-label mt-4" for="inputDefault">Last Name:</label>
                    <input type="text" class="form-control-2" placeholder="Name" id="lName" name="lName">
                    <span>*</span>
                    <br>

                    <label for="exampleInputEmail1" class="form-label mt-4">Email address:</label>
                    <input type="email" class="form-control-2" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter email" name="email">
                    <span>*</span>
                    <br>
                    <label for="password" class="col-form-label mt-4" type="form-label">Password:</label>
                    <input type="password" class="form-control-2" id="floatingPassword" placeholder="Password"
                        autocomplete="off" name="pass">
                    <span>*</span>
                    <br>
                    <label for="password" class="col-form-label mt-4" type="form-label">Confirm Password:</label>
                    <input type="password" class="form-control-2" id="confirmPassword" placeholder="Confirm Password"
                        autocomplete="off">
                    <span>*</span>
                    <br>

                    <label class="col-form-label mt-4" for="Organization">Are You an Organization?</label>
                    <select name="Organization" s id="Org">
                        <option value="yOrg">Yes</option>>
                        <option value="nOrg">No</option>
                    </select>
                    <span>*</span>
                    <br>

                    <label class="col-form-label mt-4" for="Admin">Are You an Admin?</label>
                    <select name="Admin" s id="Admin">
                        <option value="yAdmin">Yes</option>>
                        <option value="nAdmin">No</option>
                    </select>
                    <span>*</span>
                    <br>

                    <label class="col-form-label mt-4" for="Notif">Do You Want to Receive Notifications?</label>
                    <select name="Notif" s id="Notif">
                        <option value="yNotif">Yes</option>>
                        <option value="nNotif">No</option>
                    </select>
                    <span>*</span>
                    <br>
                    <div class="botBtn1">
                        <br>
                        <button type="submit" class="btn btn-primary" id="createBtn">Create Account</button>

                    </div>
                    <br>
                </form>
            </fieldset>
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
const app = Vue.createApp({
    data() {
        return {
            currentDate: '', // Store the date string
            currentTime: '' // Store the time string
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

</html>