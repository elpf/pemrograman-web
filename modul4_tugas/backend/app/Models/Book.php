<?php

namespace app\Models;

include "../app/Config/DatabaseConfig.php";

use app\Config\DatabaseConfig;
use mysqli;

class Book extends DatabaseConfig
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
        $sql = "SELECT * FROM book";
        $result = $this->conn->query($sql);

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM book WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        return $data;
    }

    public function create($data)
    {
        $sql = "INSERT INTO book (title, author, description, genre, price, image) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "ssssds",
            $data['title'],
            $data['author'],
            $data['description'],
            $data['genre'],   // Tambahkan parameter untuk genre
            $data['price'],
            $data['image']
        );
        $stmt->execute();
    }

    public function update($data, $id)
    {
        $sql = "UPDATE book SET title = ?, author = ?, description = ?, genre = ?, price = ?, image = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "ssssdsi",
            $data['title'],
            $data['author'],
            $data['description'],
            $data['genre'],   // Tambahkan parameter untuk genre
            $data['price'],
            $data['image'],
            $id
        );
        $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM book WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
