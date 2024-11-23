<?php

namespace app\Controller;

include "../app/Traits/ApiResponseFormatter.php";
include "../app/Models/Book.php";

use app\Models\Book;
use app\Traits\ApiResponseFormatter;

class BookController
{
    use ApiResponseFormatter;

    public function index()
    {
        $bookModel = new Book();
        $response = $bookModel->findAll();
        return $this->apiResponse(200, "success", $response);
    }

    public function getById($id)
    {
        $bookModel = new Book();
        $response = $bookModel->findById($id);
        return $this->apiResponse(200, "success", $response);
    }

    public function insert()
    {
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->apiResponse(480, "Error: invalid input", null);
        }

        $bookModel = new Book();
        $bookModel->create($inputData);
        return $this->apiResponse(201, "Book created successfully", null);
    }

    public function update($id)
    {
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->apiResponse(480, "Error: invalid input", null);
        }

        $bookModel = new Book();
        $bookModel->update($inputData, $id);
        return $this->apiResponse(200, "Book updated successfully", null);
    }

    public function delete($id)
    {
        $bookModel = new Book();
        $bookModel->delete($id);
        return $this->apiResponse(200, "Book deleted successfully", null);
    }
}
