<h2>Thêm người dùng mới </h2>
<form name="userform" method="post" action="users.php?action=insert" enctype="multipart/form-data">
	<table>
		<tr>
			<td>
				<lable>Tên tài khoản người dùng</lable>
			</td>
			<td><input type="text" name="username"></td>
		</tr>
		<tr>
			<td>
				<lable>Mật khẩu</lable>
			</td>
			<td><input type="password" name="password"></td>
		</tr>
		<tr>
			<td>
				<lable>Nhập lại mật khẩu</lable>
			</td>
			<td><input type="password" name="repassword"></td>
		</tr>
		<tr>
			<td>
				<lable>Ảnh đại diện</lable>
			</td>
			<td><input type="file" name="image"></td>
		</tr>
		
		<tr>
			<td>
				<lable>Họ và tên</lable>
			</td>
			<td><input type="text" name="fullname"></td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				<input type="button" value="Thêm mới" onclick="valiateform()">
			</td>
		</tr>
	</table>
</form>
<script>
	function valiateform(){
		myform = window.document.userform;
		pass = myform.password.value;
		repass = myform.repassword.value;
		if(myform.username.value==""){
			alert("Tên tài khoản không được bỏ trống");
			return;
		}
		if(pass=="" || repass == ""){
			alert("Mật khẩu không được bỏ trống");
			return;
		}
		if(pass!=repass){
			alert("Mật khẩu không trùng khớp");
			return;
		}
		myform.submit();
	}
</script>
