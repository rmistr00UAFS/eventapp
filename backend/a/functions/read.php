<?php

function getReviews($mysqli){
    $stmt = $mysqli->prepare("SELECT * FROM `REVIEWS`");
$stmt->execute();
$result = $stmt->get_result();

return $result;
}

function getStarsAvg($mysqli, $eventID){
    $stmt = $mysqli->prepare("SELECT `STARS` FROM `REVIEWS` WHERE `EVENTID` = ?");
    $stmt->bind_param("i", $eventID);
    $stmt->execute();
    $result = $stmt->get_result();

    $reviews = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $reviews[] = intval($row['STARS']);
        }

    }

    $avg=0;

    if(count($reviews)>0){



    $sum = array_sum($reviews);

    $c = count($reviews);

    $avg = $sum / $c;

    return $avg;
}
}

function reviewsByID($mysqli, $eventID){
    $stmt = $mysqli->prepare("SELECT * FROM `REVIEWS` WHERE `EVENTID` = ?");
    $stmt->bind_param("i", $eventID);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
    }


function eventByID($mysqli, $eventID){
    $stmt = $mysqli->prepare("SELECT * FROM `EVENTS` WHERE `EVENT_ID` = ?");
    $stmt->bind_param("i", $eventID);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
    }




function getRepliesByReviewID($mysqli, $reviewid){
    // Prepare the SQL statement to select comments for a specific event
    $stmt = $mysqli->prepare("SELECT * FROM `REPLY` WHERE `REVIEWID` = ?");

    // Bind the event ID parameter to the SQL query
    $stmt->bind_param("i", $reviewid);

    // Execute the query
    $stmt->execute();

    // Get the result set from the executed query
    $result = $stmt->get_result();

    return $result;

}

function getUserbyID($mysqli, $userID){
    $stmt = $mysqli->prepare("SELECT * FROM `USERS` WHERE `USER_ID` = ?");

    // Bind the event ID parameter to the SQL query
    $stmt->bind_param("i", $userID);

    // Execute the query
    $stmt->execute();

    // Get the result set from the executed query
    $result = $stmt->get_result();

    // Initialize an array to hold the comments
    $user = [];

    // Check if the result set contains any rows
    if ($result) {
        // Fetch associative array of the rows and add them to the comments array
        while ($row = $result->fetch_assoc()) {
            $user[] = $row;
        }
    }
    // Return the comments as a JSON-encoded string
    return $user[0];
}

?>
