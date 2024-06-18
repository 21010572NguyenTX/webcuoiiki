<?php require_once("config.php") ;
	require_once("database.php") ?>
	<?php
	$view ="";
	$data = array();
	$message ="";
	$title = "Quản lý sản phẩm";
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		if(isset($_GET["action"])){
		//action
			$action = $_GET['action'];
			switch ($action) {
				case 'view':
					if(isset($_GET['id']) && $_GET['id']!= "" && (int)$_GET['id']){
						$id = (int)$_GET['id'];
						$data = getById('products', $_GET['id']);
					}
					if(!empty($data)){
						// echo "hiển thị chi tiết sản phẩm";
						$view = "views/products/view.php";
					}else{
						$data = getAll('products');
						$message ="Sản phảm bạn muốn xem không tồn tại";
						$view = "views/products/list.php";
					}
					break;
				case 'insert':
					// echo "hiển thị form insert";
					$view = "views/products/insertform.php";
					break;
				case 'update':
					// echo "hiển thị form update";
					if(isset($_GET['id']) && $_GET['id']!= "" && (int)$_GET['id']){
						$id = (int)$_GET['id'];
						$data = getById('products', $_GET['id']);
					}
					if(!empty($data)){
						// echo "hiển thị chi tiết sản phẩm";
						$view = "views/products/updateform.php";
					}else{
						$data = getAll('products');
						$message ="Sản phảm bạn muốn xem không tồn tại";
						$view = "views/products/list.php";
					}
					break;
				case 'delete':
					// echo "xóa sản phẩm";
					if(isset($_GET['id']) && $_GET['id']!= "" && (int)$_GET['id']){
						$id = (int)$_GET['id'];
						if(delete('products', $_GET['id'])){
							$message = "Xóa sản phẩm thành công.";			
						}else{
							$message = "Xóa sản phẩm không thành công";
						}
					}
					header("location:./products.php");
					// $data = getAll('products');
					// $view = "views/products/list.php";
					break;
				default:
					// echo "xem danh sách";

						$data = getAll('products');
										
					$view = "views/products/list.php";
					break;
			}
		}else{
		//trang home hiển thị danh sách sản phẩm
			// echo "xem danh sách";
			// echo "xem danh sách";
			if(isset($_GET['q']) && $_GET['q']!=''){
				$q = $_GET['q'];
				$sql = "select * from products where name like '%$q%' or description like '%$q%'";
				$data = exe_query($sql);
			}else{
				$data = getAll('products');
			}		
			$view = "views/products/list.php";
		}
	}

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		if(isset($_GET["action"])){
		//action
			$action = $_GET['action'];
			switch ($action) {
				case 'insert':
					// echo "thực hiện insert";
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
							$message = "Thêm sản phẩm mới không thành công";
						}
						$data = getAll('products');
						$view = "views/products/list.php";
					}else{
						$view = "views/products/insertform.php";
					}
					break;
				case 'update':
					// echo "thực hiện update";
					// echo "thực hiện insert";
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
						$view = "views/products/view.php";
					}else{
						$view = "views/products/updateform.php?id={$product['id']}";
					}

					break;
				default:
					// echo "xem danh sách";
					$data = getAll('products');
					$view = "views/products/list.php";
					break;
			}
		}else{
		//trang home hiển thị danh sách sản phẩm
			// echo "xem danh sách";
			$data = getAll('products');
			$view = "views/products/list.php";
		}
	}
	include("views/view.php");
	 ?>	
