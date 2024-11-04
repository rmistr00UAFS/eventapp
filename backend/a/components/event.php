<?php



function eventCard($mysqli,$event){

    // echo "teswlksnlwsknts";
       // echo '<div class="col-lg-4 mb-3">'; // "mb-3" adds margin-bottom for spacing between cards
                    // echo '<div class="card">';
                    echo '<h3 class="card-header">'. htmlspecialchars($event['EVENT_NAME']). '</h3>';
                    // echo '<div class="card-body">';
                    // echo '</div>'; // Closing the card-body div correctly
                    // $cat_id = $row['CATEGORY'];
                    // $testing = "SELECT CATEGORY_NAME FROM CATEGORIES WHERE CATEGORY_ID = ?";
                    // $wassup = $mysqli->prepare($testing);
                    // $wassup->bind_param('i', $cat_id);
                    // $wassup->execute();
                    // $yippee = $wassup->get_result();
                    //
                    // // Finding the category image
                    // while ($uwu = $yippee->fetch_assoc())
                    // {
                    //     $category = $uwu['CATEGORY_NAME'];
                    // }
                    // if (array_key_exists($category, $category_images)) {
                    //     $image_url = $category_images[$category];
                    // } else {
                    //     $image_url = "sports.png";  // INSERT DEFAULT IMAGE?????
                    // }
                    //
                    // echo '<img src="' . htmlspecialchars($image_url) . '"  class="card-img-top" alt="icon">';
                    // echo '<div class="card-body">';
                    //
                    echo '
                    <button
                    class="btn btn-primary" "
                    >REVIEWS
                        <div class="stars">' .
                            displayStars(getStarsAvg($mysqli, $event['EVENT_ID'])) .
                        '</div>
                    </button>';
                    //
                    // echo '</div>';
                    // echo '<div class="card">';
                    // echo '<ul class="list-group list-group-flush">';
                    // echo '<div class="textAlign" style="font-size:25px">';
                    echo '<li class="list-group-item textAlign">' . htmlspecialchars($event['EVENT_DESCR']) . '</li>';
                    echo '<li class="list-group-item textAlign">' . htmlspecialchars($event['STREET_ADD']) . '</li>';
                    $date = new DateTime(($event['DATETIME']));
                    echo '<li class="list-group-item textAlign">' . $date->format('m-d-y H:i A') . '</li>';
                    echo '<li class="list-group-item textAlign">' . htmlspecialchars($event['ZIPCODE']) . '</li>';
                    // echo '</div>';
                    // echo '</ul>';
                    // echo '<form action="save_RSVP.php" method="POST">
                    //         <input type="hidden" name="event_id" value="' . $row["EVENT_ID"] . '">
                    //         <input type="hidden" name="user_id" value="' . $user_id . '">
                    //         <div style="display: flex; align-items: center;">
                    //             <label>
                    //             <input type="radio" name="rsvp" value="3"> Going
                    //             </label>
                    //             <label style="margin-left: 5%;">
                    //             <input type="radio" name="rsvp" value="1"> Not Going
                    //             </label>
                    //             <label style="margin-left: 5%;">
                    //             <input type="radio" name="rsvp" value="2"> Interested
                    //             </label>
                    //             <button type="submit" class="btn btn-primary" style="margin-left: 5%;">Submit</button>
                    //         </div>
                    //         </form>';
                    // echo '</div>'; // Closing the card div
                    // echo '</div>';
                    // echo '<div class="card-footer">';
                    // echo '</div>';
                    // echo '</div>'; // Closing the col-lg-4 div
}

?>
