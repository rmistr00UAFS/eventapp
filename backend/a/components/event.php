<?php
class Event {
    private string $event_ID;
    private string $event_name;
    private string $event_descr;
    private string $street_add;
    private string $city;
    private string $zipcode;
    private string $creator;
    private string $category;
    private string $datetime;
    private string $website;
    private string $latitude;
    private string $longitude;


    public function __construct(
        string $event_ID,
        string $event_name,
        string $event_descr,
        string $street_add,
        string $city,
        string $zipcode,
        string $creator,
        string $category,
        string $datetime,
        string $website,
        string $latitude,
        string $longitude
    ) {
        $this->event_ID = $event_ID;
        $this->event_name = $event_name;
        $this->event_descr = $event_descr;
        $this->street_add = $street_add;
        $this->city = $city;
        $this->zipcode = $zipcode;
        $this->creator = $creator;
        $this->category = $category;
        $this->datetime = $datetime;
        $this->website = $website;
        $this->latitude = $latitude;
        $this->longitude = $longitude;

        displayEventDetails();
    }

    public function displayEventDetails(): string {
        return "Event ID: " . htmlspecialchars($this->event_ID) . "<br>" .
               "Event Name: " . htmlspecialchars($this->event_name) . "<br>" .
               "Description: " . htmlspecialchars($this->event_descr) . "<br>" .
               "Address: " . htmlspecialchars($this->street_add) . ", " . htmlspecialchars($this->city) . ", " . htmlspecialchars($this->zipcode) . "<br>" .
               "Creator: " . htmlspecialchars($this->creator) . "<br>" .
               "Category: " . htmlspecialchars($this->category) . "<br>" .
               "Date and Time: " . htmlspecialchars($this->datetime) . "<br>" .
               "Website: " . htmlspecialchars($this->website) . "<br>" .
               "Location: " . htmlspecialchars($this->latitude) . ", " . htmlspecialchars($this->longitude) . "<br>";
    }

    public function displayEventDetails(): string {
        return '
            <div class="event-card">
                <h2 class="event-name">' . htmlspecialchars($this->event_name) . '</h2>
                <p><strong>Event ID:</strong> ' . htmlspecialchars($this->event_ID) . '</p>
                <p><strong>Description:</strong> ' . htmlspecialchars($this->event_descr) . '</p>
                <p><strong>Address:</strong> ' . htmlspecialchars($this->street_add) . ', ' . htmlspecialchars($this->city) . ', ' . htmlspecialchars($this->zipcode) . '</p>
                <p><strong>Creator:</strong> ' . htmlspecialchars($this->creator) . '</p>
                <p><strong>Category:</strong> ' . htmlspecialchars($this->category) . '</p>
                <p><strong>Date and Time:</strong> ' . htmlspecialchars($this->datetime) . '</p>
                <p><strong>Website:</strong> ' . htmlspecialchars($this->website) . '</p>
                <p><strong>Location:</strong> ' . htmlspecialchars($this->latitude) . ', ' . htmlspecialchars($this->longitude) . '</p>
            </div>
        ';
    }

}
