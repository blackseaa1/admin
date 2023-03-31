<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Cập Nhật Sản Phẩm</h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <a class="btn app-btn-secondary bg-danger text-white" href="index.php?controller=product">
                                    Trở Lại</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body bg-white p-4 border rounded">
                <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                    <?php
                    foreach ($array['products'] as $product) {
                    ?>
                        <form class="tm-edit-product-form" action="index.php?controller=product&action=update_product" enctype="multipart/form-data" method="post">
                            <input name="id" type="hidden" value="<?= $product['id'] ?>">
                            <div class="row tm-edit-product-row">
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-black" for="product_name">Tên sản phẩm</label>
                                        <input class="form-control" id="product_name" name="product_name" type="text" value="<?php echo $product['product_name']; ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label text-black" for="description">Mô tả sản phẩm</label>
                                        <textarea class="form-control" name="description" type="text" rows="4" cols="50"></textarea>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label text-black" for="exampleInputPassword1">Tác giả</label>
                                        <input class="form-control" id="exampleInputPassword1" name="author" type="text" value="<?php echo $product['author']; ?>">

                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label text-black" for="exampleInputPassword1">Danh mục</label>
                                        <select class="form-select" name="category_id" aria-label="Default select example">
                                            <option value=""> - Choose - </option>
                                            <?php
                                            foreach ($array['categorys'] as $category) {
                                            ?>
                                                <option value="<?= $category['category_id'] ?>" <?php
                                                                                                if ($category['category_id'] == $product['category_id']) {
                                                                                                    echo 'selected';
                                                                                                }
                                                                                                ?>>
                                                    <?= $category['category_name'] ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label text-black" for="exampleInputPassword1">Giá</label>
                                        <input class="form-control" id="exampleInputPassword1" name="price" type="text" value="<?php echo $product['price']; ?>">

                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label text-black" for="exampleInputPassword1">Số lượng</label>
                                        <input class="form-control" id="exampleInputPassword1" name="quantity" type="number" value="<?php echo $product['quantity']; ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label text-black" for="created_date">Ngày Sửa</label>
                                        <input required class="form-control" id="created_date" name="created_date" type="date">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4 text-center">
                                    <div class="mb-3">
                                        <div class="card p-3 d-flex">
                                            <a class="text-center pb-4" onclick="changeImage()"><img id="preview" class="product-img" src="../admin/assets/img/uploads/<?php echo $product['img']; ?>" alt="Ảnh xem trước" style="max-width: 300px; max-height: 300px;"></a>
                                            <input class="d-none" class="form-control" id="img" name="img" type="file" onchange="previewImage()">
                                            <label class="form-label text-black btn btn-secondary text-white" for="img">Đổi Ảnh Khác</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary text-white fs-5" name="submit" type="submit">Cập Nhật</button>
                            </div>
                </div>
                </form>
            <?php
                    }
            ?>
            </div>
        </div>


    </div>

</div>
</div>

<script>
    function previewImage() {
        var preview = document.getElementById("preview");
        var fileInput = document.getElementById("img");
        var file = fileInput.files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
            document.getElementById("image-preview").style.display = "block";
            document.getElementById("image-preview-none").style.display = "none";
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = document.getElementById("preview").src;
        }
    }

    function changeImage() {
        document.getElementById("img").value = "";
        document.getElementById("image-preview").style.display = "none";
        document.getElementById("image-preview-none").style.display = "block";
    }

    function changeProductImage() {
        var fileInput = document.getElementById("img");
        var file = fileInput.files[0];
        var productId = <?php echo $product['id']; ?>;

        if (file || !fileInput.value) {
            var formData = new FormData();
            formData.append("img", file);
            formData.append("id", productId);

            $.ajax({
                url: "change_product_image.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function() {
                    window.location.reload();
                }
            });
        }
    }

    function changeImage() {
        img.click();
    }
</script>