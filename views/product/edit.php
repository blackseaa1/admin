
<?php
//include_once 'connect/openConnnect.php';
$connect= mysqli_connect("localhost","root","","bookly");
$id=$_GET['id'];
$sql_category="SELECT * From category";
$query_category= mysqli_query($connect,$sql_category);
$sql_up = "SELECT * from tbl_product where id='$id'";
$query_up = mysqli_query($connect,$sql_up);
$row_up=mysqli_fetch_assoc($query_up);
include_once 'connect/closeConnect.php';
//?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Sản Phẩm</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link href="../../Project_1_admin/favicon.ico" rel="shortcut icon">

    <!-- FontAwesome JS-->
    <script src="../../Project_1_admin/assets/font/fontawesome-pro-5.13.0-web/js/all.min.js" defer></script>

    <!-- App CSS -->
	<link href="../../Project_1_admin/assets/style/common/base.css" rel="stylesheet">
	<link href="../../Project_1_admin/assets/style/common/normalize.css" rel="stylesheet">
	<link href="../../Project_1_admin/assets/style/common/reset.css" rel="stylesheet">
    <link id="theme-style" href="../../Project_1_admin/assets/style/portal.css" rel="stylesheet">
</head>

<body class="app">
<?php
include 'views/layout/sidebar.php';
?>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Update Sản Phẩm</h1>
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
                <?php
                foreach ($products as $product){?>
                <div class="card-body bg-white p-4 border rounded">
                    <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                        <form class="tm-edit-product-form" action="index.php?controller=product&action=update" enctype="multipart/form-data" method="post">
                            <input type="hidden" name="id" value="<?= $product['id'] ?>" >
                            <div class="row tm-edit-product-row">
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="exampleInputEmail1">Product Name</label>
                                        <input class="form-control" id="exampleInputEmail1" name="product_name" type="text" value="<?php echo $product['product_name'];?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="exampleInputPassword1">Description</label>
                                        <textarea class="form-control" name="description" type="text" rows="4" cols="50"><?php echo $product['description'];?></textarea>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="exampleInputPassword1">Author</label>
                                        <input class="form-control" id="exampleInputPassword1" name="author" type="text"
                                               value="<?php echo $product['author'];?>"
                                        >

                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="exampleInputPassword1">Category</label>
                                        <select class="form-select" name="category_id" aria-label="Default select example">
                                            <?php
                                            while ($row_category = mysqli_fetch_array($query_category)){?>
                                                <option value="<?= $row_category['category_id']; ?>"
                                                        <?php
                                                        if ($row_category['category_id']==$product['category_id']){
                                                            echo 'selected';
                                                        }
                                                        ?>
                                                >
                                                    <?= $row_category['category_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="exampleInputPassword1">Prices</label>
                                        <input class="form-control" id="exampleInputPassword1" name="price" type="text"
                                               value="<?php echo $product['price'];?>"
                                        >

                                    </div>
                                    <div class="form-group mb-3"></div>
                                    <label class="form-label" for="exampleInputPassword1">Quantity</label>
                                    <input class="form-control" id="exampleInputPassword1" name="quantity" type="number"
                                           value="<?php echo $product['quantity'];?>"
                                    >
                                    <div class="row">
                                        <div class="form-group mb-3 col-xs-12 col-sm-6">
                                            <label class="form-label" for="exampleInputPassword1">Created Date</label>
                                            <input class="form-control" id="exampleInputPassword1" name="created_date" type="date"
                                                   value="<?php echo $product['created_date'];?>"
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4 text-center">
                                    <div class="tm-product-img-edit mx-auto">
                                        <img class="img-thumbnail d-block mx-auto" src="./img/<?php echo $product['img']; ?>" alt="Product image" style="width: 400px">
                                        <i class="fas fa-cloud-upload-alt tm-upload-icon" onclick="document.getElementById('fileInput').click();"></i>
                                    </div>
                                    <div class="custom-file mt-3 mb-3">
                                        <input id="fileInput" name="imgFile" type="file" style="display:none;">
                                        <input class="btn btn-primary btn-block mx-auto text-white" type="button" value="CHANGE IMAGE NOW" onclick="document.getElementById('fileInput').click();">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary text-white fs-5" name="submit" type="submit">Update Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                    <?php
                }
                ?>
            </div>

        </div>
    </div>

<!--    <div class="app-wrapper">-->
<!--	    <div class="app-content pt-3 p-md-3 p-lg-4">-->
<!--		    <div class="container-xl">-->
<!--                <div class="row g-3 mb-4 align-items-center justify-content-between">-->
<!--				    <div class="col-auto">-->
<!--			            <h1 class="app-page-title mb-0">Update Sản Phẩm</h1>-->
<!--				    </div>-->
<!--				    <div class="col-auto">-->
<!--					     <div class="page-utilities">-->
<!--						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">-->
<!--								<div class="col-auto">-->
<!--								    <a class="btn app-btn-secondary bg-danger text-white" href="../customer/index.php">-->
<!--									    Trở Lại</a>-->
<!--							    </div>-->
<!--							</div>-->
<!--					    </div>-->
<!--				    </div>-->
<!--			    </div>-->
<!--                --><?php
//                foreach ($products as $product){
//                ?>
<!--				<div class="card-body">-->
<!--					<form method="post" enctype="multipart/form-data" action="index.php?controller=product&action=update" >-->
<!--                        <input type="hidden" name="id" value="--><?//= $product['id'] ?><!--">-->
<!--							<div class="mb-3">-->
<!--								<label class="form-label" for="exampleInputEmail1">Product Name</label>-->
<!--								<input class="form-control" id="exampleInputEmail1" name="product_name" type="text"-->
<!--                                       value="--><?php //echo $product['product_name'];?><!--"-->
<!--                                >-->
<!--							</div>-->
<!--							<div class="mb-3">-->
<!--                                <img style="width: 150px" src="./img/--><?php //echo $product['img'];?><!--" alt="Book">-->
<!--								<label class="form-label" for="exampleInputPassword1">Product Image</label>-->
<!--								<input class="form-control"  name="img" type="file">-->
<!--							</div>-->
<!--							<div class="mb-3">-->
<!--								<label class="form-label" for="exampleInputPassword1">Description</label>-->
<!--                                <textarea-->
<!--								            class="form-control"  name="description" type="text" rows="4" cols="50"-->
<!--                                >--><?php //echo $product['description'];?><!--</textarea>-->
<!--							</div>-->
<!--							<div class="mb-3">-->
<!--								<label class="form-label" for="exampleInputPassword1">Author</label>-->
<!--								<input class="form-control"  name="author" type="text"-->
<!--                                       value="--><?php //echo $product['author'];?><!--"-->
<!--                                >-->
<!--							</div>-->
<!--<!---->-->
<!--							<div class="mb-3">-->
<!--								<label class="form-label" for="exampleInputPassword1">Category</label>-->
<!--								<select class="form-select" name="category_id" aria-label="Default select example">-->
<!--                                    --><?php
//                                    while ($row_category = mysqli_fetch_array($query_category)){?>
<!--                                        <option value="--><?//= $row_category['category_id']; ?><!--"-->
<!--                                            --><?php
//                                            if ($row_category['category_id']==$product['category_id']){
//                                                echo 'selected';
//                                            }
//                                            ?>
<!--                                        >-->
<!--                                            --><?//= $row_category['category_name'] ?>
<!--                                        </option>-->
<!--                                    --><?php //} ?>
<!--                                </select>-->
<!--							</div>-->
<!--                            <div class="mb-3">-->
<!--								<label class="form-label" for="exampleInputPassword1">Quantity</label>-->
<!--								<input class="form-control"  name="quantity" type="number"-->
<!--                                       value="--><?php //echo $product['quantity'];?><!--">-->
<!--							</div>-->
<!--                            <div class="mb-3">-->
<!--                            <label class="form-label" for="exampleInputPassword1">Prices</label>-->
<!--                            <input class="form-control" id="exampleInputPassword1" name="price" type="text"-->
<!--                                   value="--><?php //echo $product['price'];?><!--">-->
<!--                            </div>-->
<!--                            <div class="mb-3">-->
<!--                            <label class="form-label" for="exampleInputPassword1">Created Date</label>-->
<!--                            <input class="form-control"  name="created_date" type="date"-->
<!--                                   value="--><?php //echo $product['created_date'];?><!--">-->
<!--                            </div>-->
<!--<!--                        <button type="submit" name="backsubmit" class="btn btn-outline-dark">Back to products</button>-->-->
<!--						<button class="btn btn-primary text-white fs-5" name="submit" type="submit">Update Product</button>-->
<!--					</form>-->
<!--				</div>-->
<!--                --><?php
//                    }
//                ?>
<!--        </div>-->
<!--    </div>-->
<!--    </div>-->


    <!-- Javascript -->
    <script src="../../Project_1_admin/assets/plugins/popper.min.js"></script>
    <script src="../../Project_1_admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>


    <!-- Page Specific JS -->
    <script src="../../Project_1_admin/assets/js/app.js"></script>

</body>
</html>

