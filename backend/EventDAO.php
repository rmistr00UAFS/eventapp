<?php

class EventDAO extends DAO {

    public function __construct($db) {
        parent::__construct($db);
    }

    public function createEvent($title, $event_descr, $date, $time, $location, $categoryid, $organizerid) {
        $data = [
            'title' => $title,
            'event_descr' => $event_descr,
            'date' => $date,
            'time' => $time,
            'location' => $location,
            'categoryid' => $categoryid,
            'organizerid' => $organizerid
        ];
        return $this->create('events', $data);
    }

    public function getEvents($conditions = []) {
        return $this->read('events', $conditions);
    }

    public function updateEvent($data, $conditions) {
        return $this->update('events', $data, $conditions);
    }

    public function deleteEvent($conditions) {
        return $this->delete('events', $conditions);
    }
}

?>
