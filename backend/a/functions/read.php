<?php

function reviews($mysqli){
    $stmt = $mysqli->prepare("SELECT * FROM `REVIEWS`");
$stmt->execute();
$result = $stmt->get_result();

$reviews = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }

}
 return json_encode($reviews);
}

function getStarsAvg($mysqli){

    //
 return 3;
}

function reviewsByID($mysqli, $eventID){
    $stmt = $mysqli->prepare("SELECT * FROM `REVIEWS` WHERE `EVENTID` = ?");
    $stmt->bind_param("i", $eventID);
    $stmt->execute();
    $result = $stmt->get_result();

    $reviews = [];

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $reviews[] = $row;
        }

    }
    return json_encode($reviews);
    }


function eventByID($mysqli, $eventID){
    $stmt = $mysqli->prepare("SELECT * FROM `EVENTS` WHERE `EVENT_ID` = ?");
    $stmt->bind_param("i", $eventID);
    $stmt->execute();
    $result = $stmt->get_result();

    $reviews = [];

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $reviews[] = $row;
        }

    }
    return json_encode($reviews);
    }




function getReplybyReviewtID($mysqli, $reviewtId){
    // Prepare the SQL statement to select comments for a specific event
    $stmt = $mysqli->prepare("SELECT * FROM `REPLY` WHERE `REVIEWID` = ?");

    // Bind the event ID parameter to the SQL query
    $stmt->bind_param("i", $reviewtId);

    // Execute the query
    $stmt->execute();

    // Get the result set from the executed query
    $result = $stmt->get_result();

    // Initialize an array to hold the comments
    $comments = [];

    // Check if the result set contains any rows
    if ($result) {
        // Fetch associative array of the rows and add them to the comments array
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
    }

    // Return the comments as a JSON-encoded string
    return json_encode($comments);
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
    console.log($user);
    // Return the comments as a JSON-encoded string
    return json_encode($user);
}

?>
