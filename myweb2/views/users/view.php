
<p class="action-buttons">
		
		<a class="button" href="users.php?action=update&id=<?php echo $data['id'] ?>">Chỉnh sửa tài khoản</a>
		<a class="button" href="users.php?action=changepass&id=<?php echo $data['id'] ?>">Đổi mật khẩu</a>
		<a class="button" onclick = "deleteUser(<?php echo $data['id'] ?>)">Xóa tài khoản</a>
</p>

<p><?php echo ($message)??"" ?></p>
<h2><?php echo $data['username'] ?></h2>
<p>Họ và tên: <?php echo $data['fullname'] ?></p>
<img src="./upload/<?php echo $data['image'] ?>" alt="">

<script>
	 	function deleteUser(id){
	 		if(confirm("Bạn có chắc chắn muốn xóa tài khoản này không?")){
	 			window.location= "users.php?action=delete&id=" + id;
	 		}
	 	}
	 </script>