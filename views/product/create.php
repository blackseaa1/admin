<?php
include_once 'connect/openConnnect.php';
$sql_category = "SELECT * From category";
$query_category = mysqli_query($connect, $sql_category);
include_once 'connect/closeConnect.php';
//
?>

<body class="app">
	<div class="app-wrapper">

		<div class="app-content pt-3 p-md-3 p-lg-4">
			<div class="container-xl">
				<div class="row g-3 mb-4 align-items-center justify-content-between">
					<div class="col-auto">
						<h1 class="app-page-title mb-0">Thêm Sản Phẩm</h1>
					</div>
					<div class="col-auto">
						<div class="page-utilities">
							<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
								<div class="col-auto">
									<a class="btn app-btn-secondary bg-danger text-white" href="index.php?controller=product">
										Trở Lại</a>
								</div>
							</div><!--//row-->
						</div><!--//table-utilities-->
					</div><!--//col-auto-->
				</div><!--//row-->
				<div class="card-body bg-white p-4 border rounded">
					<form method="post" action="index.php?controller=product&action=store" enctype="multipart/form-data">

						<div class="mb-3">
							<label class="form-label text-black" for="product_name">Tên sản phẩm</label>
							<input class="form-control" id="product_name" name="product_name" type="text">
						</div>
						<div class="mb-3">
							<label class="form-label text-black" for="img">Thêm hình ảnh</label>
							<input class="form-control" id="img" name="img" type="file">
						</div>
						<div class="mb-3">
							<label class="form-label text-black" for="description">Mô tả sản phẩm</label>
							<input class="form-control" id="description" name="description" type="text">
						</div>
						<div class="mb-3">
							<label class="form-label text-black" for="author">Tác giả</label>
							<input class="form-control" id="author" name="author" type="text">
						</div>
						<div class="mb-3">
							<label class="form-label text-black" for="category_id">Danh mục</label>
							<select class="form-select" id="category_id" name="category_id" aria-label="Default select example">
								<?php
								while ($row_category = mysqli_fetch_array($query_category)) { ?>
									<option value="<?php echo $row_category['category_id']; ?>">
										<?php echo $row_category['category_name']; ?>

									</option>
								<?php } ?>
							</select>

						</div>
						<div class="mb-3">
							<label class="form-label text-black" for="price">Giá</label>
							<input class="form-control" id="price" name="price" type="text">
						</div>
						<div class="mb-3">
							<label class="form-label text-black" for="quantity">Số lượng</label>
							<input class="form-control" id="quantity" name="quantity" type="number">
						</div>
						<div class="mb-3">
							<label class="form-label text-black" for="created_date">Ngày tạo</label>
							<input class="form-control" id="created_date" name="created_date" type="date">
						</div>
						<!--                        <button type="submit" name="backsubmit" class="btn btn-outline-dark">Back to products</button>-->
						<button class="btn btn-primary text-white fs-5" name="submit" type="submit">Thêm Sản Phẩm</button>
					</form>

				</div>
			</div>
		</div>


	</div><!--//container-fluid-->
	<!--//app-content-->

	<!--//app-wrapper-->
</body>