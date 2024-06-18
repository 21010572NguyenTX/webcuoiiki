<?php require_once("config.php") ;
	require_once("database.php") ?>
	<?php
	$view ="";
	$data = array();
	$message ="";
	$title = "Quản lý người dùng";
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		if(isset($_GET["action"])){
		//action
			$action = $_GET['action'];
			switch ($action) {
				case 'view':
					if(isset($_GET['id']) && $_GET['id']!= "" && (int)$_GET['id']){
						$id = (int)$_GET['id'];
						$data = getById('users', $_GET['id']);
					}
					if(!empty($data)){
						// echo "hiển thị chi tiết user";
						$view = "views/users/view.php";
					}else{
						$data = getAll('users');
						$message ="Tài khoản người dùng bạn muốn xem không tồn tại";
						$view = "views/users/list.php";
					}
					break;
				case 'insert':
					// echo "hiển thị form insert";
					$view = "views/users/insertform.php";
					break;
				case 'changepass':
					// echo "hiển thị form update";
					if(isset($_GET['id']) && $_GET['id']!= "" && (int)$_GET['id']){
						$id = (int)$_GET['id'];
						$data = getById('users', $_GET['id']);
					}
					if(!empty($data)){
						// echo "hiển thị chi tiết tài khoản";
						$view = "views/users/changepass.php";
					}else{
						$data = getAll('users');
						$message ="tài khoản bạn muốn xem không tồn tại";
						$view = "views/users/list.php";
					}
					break;
				case 'update':
					// echo "hiển thị form update";
					if(isset($_GET['id']) && $_GET['id']!= "" && (int)$_GET['id']){
						$id = (int)$_GET['id'];
						$data = getById('users', $_GET['id']);
					}
					if(!empty($data)){
						// echo "hiển thị chi tiết tài khoản";
						$view = "views/users/updateform.php";
					}else{
						$data = getAll('users');
						$message ="Tài khoản bạn muốn xem không tồn tại";
						$view = "views/users/list.php";
					}
					break;
				case 'delete':
					// echo "xóa tài khoản";
					if(isset($_GET['id']) && $_GET['id']!= "" && (int)$_GET['id']){
						$id = (int)$_GET['id'];
						if(delete('users', $_GET['id'])){
							$message = "Xóa tài khoản thành công.";			
						}else{
							$message = "Xóa tài khoản không thành công";
						}
					}
					header("location:./users.php");
					// $data = getAll('users');
					// $view = "views/users/list.php";
					break;
				case 'search':
					echo "Tìm kiếm tài khoản";
				default:
					// echo "xem danh sách";
					$data = getAll('users');
					$view = "views/users/list.php";
					break;
			}
		}else{
		//trang home hiển thị danh sách tài khoản
			// echo "xem danh sách";
			$data = getAll('users');
			$view = "views/users/list.php";
		}
	}

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		if(isset($_GET["action"])){
		//action
			$action = $_GET['action'];
			switch ($action) {
				case 'insert':
					// echo "thực hiện insert";
					if(isset($_POST['username']) && $_POST['username']!=""){
						$user['username'] = $_POST['username'];
						$user['password'] = md5(($_POST['password'])??0);
						$user['fullname'] = ($_POST['fullname'])??'';

						if(mysqli_num_rows(exe_query("select * from users where username = '{$user['username']}'"))){
							$message = "Tài khoản {$user['username']} đã tồn tại.";
							$view = "views/users/insertform.php";
							break;
						}
						$uploadDir = './upload/';
						$user['image'] = "";
					    if (isset($_FILES['image'])) {
					        $file = $_FILES['image'];
					         $newname =  $file['name'].time();
					        $uploadPath = $uploadDir . $newname;


					        if (move_uploaded_file($file['tmp_name'], $uploadPath)){
					        	$user['image']= $newname;

					        }
					    }
						if(insert('users',$user)){
							$message = "Thêm tài khoản mới thành công";
						}else{
							$message = "Thêm tài khoản mới không thành công";
						}
						$data = getAll('users');
						$view = "views/users/list.php";
					}else{
						$view = "views/users/insertform.php";
					}
					break;
				case 'update':
					// echo "thực hiện update";
					if(isset($_POST['id']) && isset($_POST['username']) && $_POST['username']!="" && (int)$_POST['id']){
						$user['id'] = $_POST['id'];
						$user['username'] = $_POST['username'];
						// $user['password'] = md5(($_POST['password'])??0);
						$user['fullname'] = ($_POST['fullname'])??'';

						$uploadDir = './upload/';
						$user['image'] = $_POST['old_image'];
					    if (isset($_FILES['image'])) {
					        $file = $_FILES['image'];
					         $newname =  $file['name'].time();
					        $uploadPath = $uploadDir . $newname;


					        if (move_uploaded_file($file['tmp_name'], $uploadPath)){
					        	$user['image']= $newname;

					        }
					    }

						if(update('users',$user)){
							$message = "Chỉnh sửa tài khoản thành công";
						}else{
							$message = "Chỉnh sửa tài khoản không thành công";
						}
						$data = getById('users', $product['id']);
						$view = "views/users/view.php";
					}else{
						$view = "views/users/updateform.php?id={$product['id']}";
					}

					break;
				case 'changepass':
					if(isset($_POST['password']) && isset($_POST['repassword'])
					&& isset($_POST['oldpassword']) && isset($_POST['id']) && (int)$_POST['id']){
						$user['id'] = $_POST['id'];
						$user['password'] = $_POST['password'];
						// $user['repassword'] = $_POST['repassword'];
						// $user['oldpassword'] = $_POST['oldpassword'];
						$data['id'] = $user['id'];
						if(mysqli_num_rows(exe_query("select * from users where id= {$user['id']} and password = '".md5($_POST['oldpassword'])."'"))){
							if($_POST['repassword'] !=$user['password']){
								$message = "Mật khẩu không trùng khớp!";
								$view = "views/users/changepass.php";
							}else{
								$user['password'] = md5($user['password'] );
								if(update('users',$user)){
									$message = "Chỉnh sửa tài khoản thành công";
								}else{
									$message = "Chỉnh sửa tài khoản không thành công";
								}
								$data=$user;
								$view = "views/users/changepass.php";
								header("refresh:2,url=./users.php?action=view&id={$user['id']}");
							}

						}else{
							$message = "Mật khẩu cũ không đúng!";
							$view = "views/users/changepass.php";
						}


					}
					break;
				default:
					// echo "xem danh sách";
					$data = getAll('users');
					$view = "views/users/list.php";
					break;
			}
		}else{
		//trang home hiển thị danh sách tài khoản
			// echo "xem danh sách";
			$data = getAll('users');
			$view = "views/users/list.php";
		}
	}
	include("views/view.php");
	 ?>	
