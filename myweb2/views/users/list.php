	<p class="action-buttons">
		<a class="button" href="users.php?action=insert">Thêm tài khoản mới</a>
	</p>
	<?php 
	if(empty($data)){
		echo "Không tồn tại tài khoản nào";
		exit();
	}?>
	
	<table width="800px" border=1 cellspacing="0" align="center">
		<tr>
		<th>Tên tài khoản</th>
		<th>Ảnh đại diện</th>
		<th>Họ và tên</th>
		<th>Hành động</th>
		</tr>
	
	<?php
      foreach($data as $user){
      	echo "<tr>";
      	echo "<td><a href='users.php?action=view&id={$user["id"]}'>{$user['username']}</a></td>";
      	echo "<td><img src = './upload/{$user['image']} '></td>";
      	echo "<td>{$user['fullname']}</td>";
      	echo "<td><a class='button' href='users.php?action=update&id={$user["id"]}'>Sửa</a> <a class='button' onclick='deleteUser({$user["id"]})'>Xóa</a></td>";
      	echo "</tr>";
      }
	 ?>
	 </table>
	 <script>
	 	function deleteUser(id){
	 		if(confirm("Bạn có chắc chắn muốn xóa tài khoản này không?")){
	 			window.location= "users.php?action=delete&id=" + id;
	 		}
	 	}
	 </script>
