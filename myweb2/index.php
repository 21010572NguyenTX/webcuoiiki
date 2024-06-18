<?php
require_once("model/productModel.php");

use MYWEB2\ProductModels;

$view = "";
$data = [];
$message = "";
$uri = [];
$para = [];
$controller = "product";
$action = "index";

// ... (Your existing URI parsing logic remains the same)

include "controllers/" . $controller . ".php";
$action .= "_action";

try {
    $productModel = new ProductModel();

    if (empty($para)) {
        [$view, $data] = $action($productModel); 
    } else {
        [$view, $data] = $action($productModel, ...$para);
    }

    include("views/view.php");
} catch (Exception $e) {
    // Handle exceptions (e.g., database errors)
    $view = "views/error.php";
    $data = ['message' => 'An error occurred: ' . $e->getMessage()];
    include("views/view.php");
}
