<h2>Chỉnh sửa tài khoản</h2>
<form method="post" action="users.php?action=update" enctype="multipart/form-data">
	<table>
		<tr>
			<td>
				<lable>Tên tài khoản</lable>
			</td>
			<td><input type="text" name="username" value="<?php echo $data["username"] ?>" disabled>
				<input type="hidden" name = "id" value="<?php echo $data["id"] ?>">
			</td>
		</tr>
		<tr>
			<td>
				<lable>Ảnh đại diện</lable>
			</td>
			<td>
				<img src="./upload/<?php echo $data["image"] ?>" alt=""><br>
				<input type="file" name="image" value="<?php echo $data["image"] ?>">
				<input type="hidden" name="old_image" value="<?php echo $data["image"] ?>"></td>
		</tr>
		<tr>
			<td>
				<lable>Họ và tên</lable>
			</td>
			<td><input type="text" name="fullname" value="<?php echo $data["fullname"] ?>"></td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				<input type="submit" value="Cập nhật">
			</td>
		</tr>
	</table>
</form>
