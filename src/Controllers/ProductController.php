<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new ProductModel();
        parent::__construct($this->model);
    }

    public function index()
    {
        $products = parent::index();
        include "src/Views/layout/page.php";
    }

    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            include "src/Views/Product/create.php";
        } else {
            $data = [
                "name" => $_POST["name"],
                "sector" => $_POST["sector"],
                "price" => $_POST["price"],
                "quantity" => $_POST["quantity"],
                "description" => $_POST["description"],
            ];
            $this->model->create($data);
            echo '<script type="text/javascript"> alert("Thêm thành công"); window.location.href = "index.php"  </script>';
        }
    }

    public function delete($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $product = $this->model->getById($id);
            include "src/Views/Product/delete.php";
        } else {
            $data = [
                "name" => $_POST["name"],
                "sector" => $_POST["sector"],
                "price" => $_POST["price"],
                "quantity" => $_POST["quantity"],
                "description" => $_POST["description"],
            ];
            $this->model->delete($id);
            echo '<script type="text/javascript"> alert("Xóa thành công"); window.location.href = "index.php"  </script>';
        }
    }

    public function update($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $product = $this->model->getById($id);
            include "src/Views/Product/update.php";
        } else {
            $data = [
                "name" => $_POST["name"],
                "sector" => $_POST["sector"],
                "price" => $_POST["price"],
                "quantity" => $_POST["quantity"],
                "description" => $_POST["description"],
            ];
            $this->model->update($id, $data);
            echo '<script type="text/javascript"> alert("Sửa thành công"); window.location.href = "index.php"  </script>';
        }
    }

    public function search($keyword)
    {
        $products = $this->model->search($keyword);
        include "src/Views/layout/page.php";
    }

}