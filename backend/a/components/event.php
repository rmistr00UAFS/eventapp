<?php
class Event {
    private int $event_ID;
    private string $event_name;
    private string $event_descr;
    private string $street_add;
    private string $city;
    private int $zipcode;
    private int $creator;
    private int $category;
    private DateTime $date_time;
    private string $website;
    private float $latitude;
    private float $longitude;


    public function __construct(
        int $event_ID,
        string $event_name,
        string $event_descr,
        string $street_add,
        string $city,
        int $zipcode,
        int $creator,
        int $category,
        DateTime $date_time,
        string $website,
        float $latitude,
        float $longitude
    ) {
        $this->event_ID = $event_ID;
        $this->event_name = $event_name;
        $this->event_descr = $event_descr;
        $this->street_add = $street_add;
        $this->city = $city;
        $this->zipcode = $zipcode;
        $this->creator = $creator;
        $this->category = $category;
        $this->date_time = $datetime;
        $this->website = $website;
        $this->latitude = $latitude;
        $this->longitude = $longitude;

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
                <p><strong>Date and Time:</strong> ' . htmlspecialchars($this->date_time) . '</p>
                <p><strong>Website:</strong> ' . htmlspecialchars($this->website) . '</p>
                <p><strong>Location:</strong> ' . htmlspecialchars($this->latitude) . ', ' . htmlspecialchars($this->longitude) . '</p>
            </div>
        ';
    }

}

?>
