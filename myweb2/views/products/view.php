
<p class="action-buttons">
		<a class="button" href="<?php echo $base_url."/index.php/product/edit/".$data['id'] ?>">Chỉnh sửa sản phẩm</a>
		<a class="button" onclick = "deleteProduct(<?php echo $data['id'] ?>)">Xóa sản phẩm</a>
</p>

<p><?php echo ($message)??"" ?></p>
<h2><?php echo $data['name'] ?></h2>
<p>Giá: <?php echo $data['price'] ?></p>
<p>Số lượng: <?php echo $data['quantity'] ?></p>
<img src="<?php echo $base_url."/upload/".$data['image'] ?>" alt="">
<p>Mô tả: <?php echo $data['description'] ?></p>

<script>
	 	function deleteProduct(id){
	 		if(confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?")){
	 			window.location= "<?php echo $base_url?>/index.php/product/delete/" + id;
	 		}
	 	}
	 </script>
