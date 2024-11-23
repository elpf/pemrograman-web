<?php

namespace app\Controller;

include "../app/Models/Testimoni.php";

use app\Models\Testimoni;
use app\Traits\ApiResponseFormatter;

class TestimoniController
{
    use ApiResponseFormatter;

    public function index()
    {
        $testimoniModel = new Testimoni();
        $response = $testimoniModel->findAll();
        return $this->apiResponse(200, "success", $response);
    }

    public function getById($id)
    {
        $testimoniModel = new Testimoni();
        $response = $testimoniModel->findById($id);
        return $this->apiResponse(200, "success", $response);
    }

    public function insert()
    {
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->apiResponse(480, "Error: invalid input", null);
        }

        $testimoniModel = new Testimoni();
        $testimoniModel->create([
            "name" => $inputData['name'],
            "description" => $inputData['description']
        ]);

        return $this->apiResponse(200, "success", null);
    }

    public function update($id)
    {
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->apiResponse(480, "Error: invalid input", null);
        }

        $testimoniModel = new Testimoni();
        $testimoniModel->update([
            "name" => $inputData['name'],
            "description" => $inputData['description']
        ], $id);

        return $this->apiResponse(200, "success", null);
    }

    public function delete($id)
    {
        $testimoniModel = new Testimoni();
        $testimoniModel->delete($id);

        return $this->apiResponse(200, "success", null);
    }
}
