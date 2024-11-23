<?php

namespace app\Models;



use app\Config\DatabaseConfig;
use mysqli;

class Testimoni extends DatabaseConfig
{
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->databaseName, $this->port);
        if ($this->conn->connect_error) {
            die("Connection Failed: " . $this->conn->connect_error);
        }
    }

    public function findAll()
    {
        $sql = "SELECT * FROM testimoni";
        $result = $this->conn->query($sql);

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $this->conn->close();
        return $data;
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM testimoni WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        $stmt->close();
        $this->conn->close();
        return $data;
    }

    public function create($data)
    {
        $query = "INSERT INTO testimoni (name, description, created_at, updated_at) VALUES (?, ?, NOW(), NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $data['name'], $data['description']);
        $stmt->execute();

        $stmt->close();
        $this->conn->close();
    }

    public function update($data, $id)
    {
        $query = "UPDATE testimoni SET name = ?, description = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $data['name'], $data['description'], $id);
        $stmt->execute();

        $stmt->close();
        $this->conn->close();
    }

    public function delete($id)
    {
        $query = "DELETE FROM testimoni WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $stmt->close();
        $this->conn->close();
    }
}
