<?php

class Database {
    private $host = "localhost";
    private $dbname = "event_app_db";
    private $username = "pmaUser";
    private $password = "pma";
    private $conn;


    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // echo "Connection Successfull";
        } catch(PDOException $e) {
            // echo "Connection failed: " . $e->getMessage();
        }

        return $this->conn;
    }

    public function create($table, $data) {

        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";

        $statement = $this->conn->prepare($sql);

        foreach ($data as $key => &$value) {
            $statement->bindParam(":$key", $value);
        }

        return $stmt->execute();
    }

    public function read($table, $conditions = [], $columns = '*') {
        $sql = "SELECT $columns FROM $table";

        if (!empty($conditions)) {
            $conditionStrings = [];

            foreach ($conditions as $key => $value) {
                $conditionStrings[] = "$key = :$key";
            }
            $sql .= " WHERE " . implode(" AND ", $conditionStrings);
        }

        $stmt = $this->conn->prepare($sql);
        foreach ($conditions as $key => &$value) {
            $stmt->bindParam(":$key", $value);
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($table, $data, $conditions){

        foreach($data as $keys => $value){
            $setStrings[] = "$key = :$key";
        }

        $setString = implode(", ", $setString);

        $conditionStrings = [];
        foreach ($conditions as $key => $value) {

            $conditionStrings[] = "$key = :cond_$key";
        }
        $conditionString = implode(" AND ", $conditionStrings);

        $sql = "UPDATE $table SET $setString WHERE $conditionString";

        $statement = $this->conn->prepare($sql);
        foreach ($data as $key => &$value) {
            $statement->bindParam(":$key", $value);
        }


        foreach ($conditions as $key => &$value) {
            $statement->bindParam(":cond_$key", $value);
        }

        return $stmt->execute();

    }

    public function delete($table, $conditions) {
        $conditionStrings = [];
        foreach ($conditions as $key => $value) {
            $conditionStrings[] = "$key = :$key";
        }
        $conditionString = implode(" AND ", $conditionStrings);

        $sql = "DELETE FROM $table WHERE $conditionString";

        $stmt = $this->conn->prepare($sql);
        foreach ($conditions as $key => &$value) {
            $stmt->bindParam(":$key", $value);
        }

        return $stmt->execute();
    }

}
?>
