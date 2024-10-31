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

}

function eventByID($mysqli, $eventID){
    $stmt = $mysqli->prepare("SELECT * FROM `EVENT` WHERE `EVENTID` = ?");
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

}

?>
