<?php

namespace app\Routes;

include "../app/Controller/BookController.php";


use app\Controller\BookController;


class BookRoutes
{
    public function handle($method, $path)
    {
        if ($method == "GET" && $path == '/api/books') {
            $controller = new BookController();
            echo $controller->index();
        }

        if ($method == "GET" && strpos($path, "/api/books/") === 0) {
            $pathParts = explode("/", $path);
            $id = $pathParts[count($pathParts) - 1];
            $controller = new BookController();
            echo $controller->getById($id);
        }

        if ($method == "POST" && $path == "/api/books") {
            $controller = new BookController();
            echo $controller->insert();
        }

        if ($method == "PUT" && strpos($path, "/api/books/") === 0) {
            $pathParts = explode("/", $path);
            $id = $pathParts[count($pathParts) - 1];
            $controller = new BookController();
            echo $controller->update($id);
        }

        if ($method == "DELETE" && strpos($path, "/api/books/") === 0) {
            $pathParts = explode("/", $path);
            $id = $pathParts[count($pathParts) - 1];
            $controller = new BookController();
            echo $controller->delete($id);
        }


    }
}
