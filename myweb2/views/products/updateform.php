<h2>Chỉnh sửa sản phẩm</h2>
<form method="post" action="<?php echo $base_url."/index.php/product/update" ?>" enctype="multipart/form-data">
	<table>
		<tr>
			<td>
				<lable>Tên sản phẩm</lable>
			</td>
			<td><input type="text" name="name" value="<?php echo $data["name"] ?>">
				<input type="hidden" name = "id" value="<?php echo $data["id"] ?>">
			</td>
		</tr>
		<tr>
			<td>
				<lable>Ảnh sản phẩm</lable>
			</td>
			<td>
				<img src="<?php echo $base_url."/upload/".$data["image"] ?>" alt=""><br>
				<input type="file" name="image" value="<?php echo $data["image"] ?>">
				<input type="hidden" name="old_image" value="<?php echo $data["image"] ?>"></td>
		</tr>
		<tr>
			<td>
				<lable>Giá</lable>
			</td>
			<td><input type="text" name="price" value="<?php echo $data["price"] ?>"></td>
		</tr>
		<tr>
			<td>
				<lable>Số lượng</lable>
			</td>
			<td><input type="text" name="quantity" value="<?php echo $data["quantity"] ?>"></td>
		</tr>
		<tr>
			<td>
				<lable>Mô tả</lable>
			</td>
			<td><textarea name="description" id="" cols="30" rows="10"><?php echo $data["description"] ?></textarea></td>
		</tr>
		<tr>
			<td>
				<lable>Trạng thái</lable>
			</td>
			<td><select name="active" id="">
				<option value="0" <?php echo $data["active"]?"":"selected" ?>>Ẩn</option>
				<option value="1" <?php echo $data["active"]?"selected":"" ?>>Hiện</option>
			</select></td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				<input type="submit" name="Cập nhật">
			</td>
		</tr>
	</table>
</form>
