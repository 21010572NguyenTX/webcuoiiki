
<?php
$message ="";
$title = "Quản lý sản phẩm";

function view_action($id=0){
    if(isset($id) && $id!= "" && (int)$id){
        $id = (int)$id;
        $data = getById('products', $id);
    }
    if(!empty($data)){
        return ["views/products/view.php",$data];
    }else{
        $data = getAll('products');
        $message ="Sản phảm bạn muốn xem không tồn tại";
        $data['message'] = $message;
        return ["views/products/list.php", $data];
    }
}

function index_action(){
    if(isset($_GET['q']) && $_GET['q']!=''){
        $q = $_GET['q'];
        $sql = "select * from products where name like '%$q%' or description like '%$q%'";
        $data = exe_query($sql);
    }else{
        $data = getAll('products');
    }		
	return ["views/products/list.php", $data];
}

function add_action(){
    return [ "views/products/insertform.php", []];
}

function edit_action($id){
    // echo "hiển thị form update";
    if(isset($id) && $id!= "" && (int)$id){
        $id = (int)$id;
        $data = getById('products', $id);
    }
    if(!empty($data)){
        // echo "hiển thị chi tiết sản phẩm";
        return ["views/products/updateform.php",$data];
    }else{
        $data = getAll('products');
        $message ="Sản phảm bạn muốn xem không tồn tại";
        $data['message'] = $message;
        return ["views/products/list.php", $data];
    }
}

function insert_action(){
    if(isset($_POST['name']) && $_POST['name']!=""){
        $product['name'] = $_POST['name'];
        $product['price'] = ($_POST['price'])??0;
        $product['description'] = ($_POST['description'])??'';
        $product['active'] = ($_POST['active'])??0;
        $uploadDir = './upload/';
        $product['image'] = "";
        if (isset($_FILES['image'])) {
            $file = $_FILES['image'];
             $newname =  $file['name'].time();
            $uploadPath = $uploadDir . $newname;
            if (move_uploaded_file($file['tmp_name'], $uploadPath)){
                $product['image']= $newname;
            }
        }
        if(insert('products',$product)){
            $message = "Thêm sản phẩm mới thành công";
        }else{
            $message  = "Thêm sản phẩm mới không thành công";
        }
        $data = getAll('products');
        $data['message'] = $message;
        return ["views/products/list.php",$data];
    }else{
        return ["views/products/insertform.php",[]];
    }
}


function update_action(){
    if(isset($_POST['id']) && isset($_POST['name']) && $_POST['name']!="" && (int)$_POST['id']){
        $product['id'] = $_POST['id'];
        $product['name'] = $_POST['name'];
        $product['price'] = ($_POST['price'])??0;
        $product['description'] = ($_POST['description'])??'';
        $product['quantity'] = ($_POST['quantity'])??0;
        $product['active'] = ($_POST['active'])??0;

        $uploadDir = './upload/';
        $product['image'] = $_POST['old_image'];
        if (isset($_FILES['image'])) {
            $file = $_FILES['image'];
             $newname =  $file['name'].time();
            $uploadPath = $uploadDir . $newname;


            if (move_uploaded_file($file['tmp_name'], $uploadPath)){
                $product['image']= $newname;

            }
        }

        if(update('products',$product)){
            $message = "Chỉnh sửa sản phẩm thành công";
        }else{
            $message = "Chỉnh sửa sản phẩm không thành công";
        }
        $data = getById('products', $product['id']);
        $data['message'] = $message;
        return ["views/products/view.php",$data];
    }else{
        header("location: ".$base_url."/index.php/product");
    }

}

function delete_action($id){
    // echo "xóa sản phẩm";
    if(isset($id) && $id!= "" && (int)$id){
        $id = (int)$id;
        if(delete('products', $id)){
            $message = "Xóa sản phẩm thành công.";			
        }else{
            $message = "Xóa sản phẩm không thành công";
        }      
    }
    global $base_url;
    header("location: ".$base_url."/index.php/product");
    exit();
}

?>