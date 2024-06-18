<h2>Thêm sản phẩm mới</h2>
<form method="post" action="<?php echo $base_url ?>/index.php/product/insert" enctype="multipart/form-data">
	<table>
		<tr>
			<td>
				<lable>Tên sản phẩm</lable>
			</td>
			<td><input type="text" name="name"></td>
		</tr>
		<tr>
			<td>
				<lable>Ảnh sản phẩm</lable>
			</td>
			<td><input type="file" name="image"></td>
		</tr>
		<tr>
			<td>
				<lable>Giá</lable>
			</td>
			<td><input type="text" name="price"></td>
		</tr>
		<tr>
			<td>
				<lable>Số lượng</lable>
			</td>
			<td><input type="text" name="quantity"></td>
		</tr>
		<tr>
			<td>
				<lable>Mô tả</lable>
			</td>
			<td><textarea name="description" id="" cols="30" rows="10"></textarea></td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				<input type="submit" name="Thêm mới">
			</td>
		</tr>
	</table>
</form>
