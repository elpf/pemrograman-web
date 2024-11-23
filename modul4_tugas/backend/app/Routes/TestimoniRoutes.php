<?php

namespace app\Routes;

include "../app/Controller/TestimoniController.php";


use app\Controller\TestimoniController;

class TestimoniRoutes
{
    public function handle($method, $path)
    {
        if ($method == "GET" && $path == '/api/testimoni') {
            $controller = new TestimoniController();
            echo $controller->index();
        }

        if ($method == "GET" && strpos($path, "/api/testimoni/") === 0) {
            $pathParts = explode("/", $path);
            $id = $pathParts[count($pathParts) - 1];
            $controller = new TestimoniController();
            echo $controller->getById($id);
        }

        if ($method == "POST" && $path == "/api/testimoni") {
            $controller = new TestimoniController();
            echo $controller->insert();
        }

        if ($method == "PUT" && strpos($path, "/api/testimoni/") === 0) {
            $pathParts = explode("/", $path);
            $id = $pathParts[count($pathParts) - 1];
            $controller = new TestimoniController();
            echo $controller->update($id);
        }

        if ($method == "DELETE" && strpos($path, "/api/testimoni/") === 0) {
            $pathParts = explode("/", $path);
            $id = $pathParts[count($pathParts) - 1];
            $controller = new TestimoniController();
            echo $controller->delete($id);
        }
    }
}
