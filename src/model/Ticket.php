<?php
require_once(__DIR__ . '/../utils/Database.php');

class Ticket
{
    private $db;
    private $table = 'ticket';

    private $id;
    private $user_id;
    private $description;
    private $type;
    private $attachment;
    private $created_at;
    private $updated_at;

    public function __construct($id = null, $user_id = null, $description = null, $type = null, $attachment = null, $created_at = null, $updated_at = null)
    {
        $this->db = (new Database())->connection;
        $this->id = $id;
        $this->user_id = $user_id;
        $this->description = $description;
        $this->type = $type;
        $this->attachment = $attachment;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    // Save or update ticket information
    public function save()
    {
        if ($this->id === null) {
            $sql = "INSERT INTO $this->table (user_id, description, type, attachment, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("issbss", $this->user_id, $this->description, $this->type, $this->attachment, $this->created_at, $this->updated_at);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            // TODO updateTicket
        }
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $this->id = $row['id'];
            $this->user_id = $row['user_id'];
            $this->description = $row['description'];
            $this->type = $row['type'];
            $this->created_at = $row['created_at'];
            $this->updated_at = $row['updated_at'];
            return true;
        } else {
            return false;
        }
    }
}
