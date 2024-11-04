<?php
include_once("config.php");
require_once("./functions/read.php");
require_once("./functions/write.php");
require_once("./functions/display.php");

require_once("./components/event.php"); // Include the Event class file

$eventPull = eventByID($mysqli, 2)->fetch_assoc();


// Create an instance of the Event class
$event = new Event(
    intval($eventPull["EVENT_ID"]),                   // Event ID
    $eventPull["EVENT_NAME"],         // Event Name
    $eventPull["EVENT_DESCR"], // Event Description
    $eventPull["STREET_ADD"],          // City
    $eventPull["CITY"],                // Zipcode
    intval($eventPull["ZIPCODE"]),             // Creator
    intval($eventPull["CREATOR"]),
    intval($eventPull["CATEGORY"]),// Category
    DateTime($eventPull["DATETIME"]),  // Date and Time
    $eventPull["WEBSITE"],   // Website
    floatval($eventPull["LATITUDE"]),              // Latitude
    floatval($eventPull["LONGITUDE"])              // Longitude
);

// Display the event details
echo $event->displayEventDetails(); // Call the displayEventDetails method to output the event details
?>
