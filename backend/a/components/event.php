<?php

function eventCard($mysqli, $event) {
    $date = new DateTime($event['DATETIME']);
    echo '
    <div class="card mb-4">

        <h3 class="card-header">' . htmlspecialchars($event['EVENT_NAME']) . '</h3>

        <div class="card-body text-center">
                <span class="stars">' .
                    displayStars(getStarsAvg($mysqli, $event['EVENT_ID'])) .
                '</span>

        </div>

        <ul class="list-group list-group-flush">
            <li class="list-group-item textAlign">' . htmlspecialchars($event['EVENT_DESCR']) . '</li>
            <li class="list-group-item textAlign">' . htmlspecialchars($event['STREET_ADD']) . '</li>

            <li class="list-group-item textAlign">' . htmlspecialchars($event['ZIPCODE']) . '</li>
            <li class="list-group-item textAlign">' . $date->format('m-d-y H:i A') . '</li>
        </ul>

    </div>';
}

?>

<!-- CSS Styling -->
<style>
.card {
    width: 600px;
    margin: 0 auto; /* Centers the card */
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    background-color: #fff;
}

.card-header {

    color: white;
    padding: 15px;
    font-size: 1.5rem;
    text-align: center;
    word-wrap: break-word; /* Ensures long words wrap to the next line */
}

.card-body {
    padding: 15px;
    text-align: center;
}


.stars {
    margin-left: 10px;
    font-size: 1rem;
    color: #ffd700; /* Gold color for stars */
}

.list-group-item {
    background-color: #f8f9fa;
    border: none;
    color: #333;
    text-align: center;
    font-size: 1rem;
    padding: 10px 15px;
    word-wrap: break-word; /* Forces text to wrap within the width limit */
}
</style>
