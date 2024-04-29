<?php
require_once(__DIR__ . '/../utils/Database.php');

class User
{
    private $db;
    private $table = 'user';

    private $id;
    private $fullName;
    private $email;
    private $password;
    private $birthdate;
    private $phone;
    private $whatsapp;
    private $state;
    private $city;

    public function __construct($id = null, $fullName = null, $email = null, $password = null, $birthdate = null, $phone = null, $whatsapp = null, $state = null, $city = null)
    {
        $this->db = (new Database())->connection;
        $this->id = $id;
        $this->fullName = $fullName;
        $this->email = $email;
        $this->password = $password;
        $this->birthdate = $birthdate;
        $this->phone = $phone;
        $this->whatsapp = $whatsapp;
        $this->state = $state;
        $this->city = $city;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFullName()
    {
        return $this->fullName;
    }

    public function getPasswordHash()
    {
        return $this->password;
    }

    private function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function save()
    {
        if ($this->id === null) {
            $this->password = $this->hashPassword($this->password);
            $stmt = $this->db->prepare("INSERT INTO $this->table (fullName, email, password, birthdate, phone, whatsapp, state, city) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $this->fullName, $this->email, $this->password, $this->birthdate, $this->phone, $this->whatsapp, $this->state, $this->city);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $this->id = $stmt->insert_id;
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        } else {
            // TODO updateUser
        }
    }

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT id, fullName, email, password, birthdate, phone, whatsapp, state, city FROM $this->table WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            return new self($user_data['id'], $user_data['fullName'], $user_data['email'], $user_data['password'], $user_data['birthdate'], $user_data['phone'], $user_data['whatsapp'], $user_data['state'], $user_data['city']);
        } else {
            return null;
        }
    }
}
