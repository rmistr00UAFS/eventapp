 
<?php
class DAO {
    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($table, $data) {

        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";

        $statement = $this->conn->prepare($sql);

        foreach ($data as $key => &$value) {
            $statement->bindParam(":$key", $value);
        }

        return $statement->execute();
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
