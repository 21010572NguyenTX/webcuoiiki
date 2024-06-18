<h1>Đổi mật khẩu</h1>
<form method="post" action="users.php?action=changepass" enctype="multipart/form-data">
	<table>
		<tr>
			<td>
				<lable>Mật khẩu cũ</lable>
			</td>
			<td><input type="hidden" name="id" value="<?php echo $data['id'] ?>">
				<input type="password" name="oldpassword"></td>
		</tr>
		<tr>
			<td>
				<lable>Mật khẩu mới</lable>
			</td>
			<td><input type="password" name="password" ></td>
		</tr>
		<tr>
			<td>
				<lable>Nhập lại mật khẩu</lable>
			</td>
			<td><input type="password" name="repassword" value=""></td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				<input type="submit" value="Cập nhật">
			</td>
		</tr>
	</table>
</form>