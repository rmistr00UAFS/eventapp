<?php
class UserDAO extends DAO{

    public function __construct($db) {
        parent::__construct($db);
    }

    public function createUser($firstname, $lastname, $password, $email, $phone, $address) {
        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'email' => $email,
            'phone' => $phone,
            'address' => $address
        ];
        return $this->create('USER', $data);
    }

    public function getUsers($conditions = []) {
        return $this->read('USER', $conditions, '*');
    }


    public function updateUser($data, $conditions) {
        return $this->update('USER', $data, $conditions);
    }

    public function deleteUser($conditions) {
        return $this->delete('USER', $conditions);
    }


    public function login($email, $password) {
        $query = "SELECT * FROM USER WHERE EMAIL = :EMAIL LIMIT 1";
        $stmt = $this->conn->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return null;
    }
}

}
?>
