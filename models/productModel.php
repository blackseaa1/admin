<?php
function index_product()
{
    include_once 'connect/openConnnect.php';
    //    $sql= "select * from tbl_account";
    // $sql= "SELECT * FROM tbl_product INNER JOIN category ON tbl_product.category_id= category.category_id" ;
    $sql = "SELECT tbl_product.*, category.category_name AS category_name FROM tbl_product INNER JOIN category ON tbl_product.category_id = category.category_id";
    $products = mysqli_query($connect, $sql);
    include_once './connect/closeConnect.php';
    return $products;
}
function create_product()
{
    include_once './connect/openConnnect.php';
    $sql = "SELECT * FROM category";
    $categorys = mysqli_query($connect, $sql);
    include_once 'connect/closeConnect.php';
    return $categorys;
}
function store_product()
{
    $product_name = $_POST["product_name"];
    $img = $_FILES["img"]['name'];
    $img_tmp = $_FILES["img"]['tmp_name'];
    $description = $_POST["description"];
    $author = $_POST["author"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $created_date = $_POST["created_date"];
    $category_id = $_POST["category_id"];

    // Kiểm tra sản phẩm đã tồn tại trong database hay chưa
    include_once './connect/openConnnect.php';
    $check_duplicate = mysqli_query($connect, "SELECT * FROM tbl_product WHERE product_name = '$product_name'");
    if (mysqli_num_rows($check_duplicate) > 0) {
        $msg = "Sản phẩm đã tồn tại! Vui lòng thêm lại";
        echo "<script>alert('$msg'); window.history.back();</script>";
    } else {
        // Thêm sản phẩm vào database
        $sql = "INSERT INTO tbl_product(product_name,img,description,author,quantity,price,created_date,category_id)
            values('$product_name','$img','$description','$author','$quantity','$price','$created_date','$category_id')";
        move_uploaded_file($img_tmp, '../img/' . $img);
        mysqli_query($connect, $sql);
        $msg = "Thêm sản phẩm thành công!";
    }
    include_once './connect/closeConnect.php';
    echo "<script>alert('$msg');window.location.href='index.php?controller=product';</script>";
}

function edit()
{
    $id = $_GET['id'];
    include_once './connect/openConnnect.php';
    $sqlCategory = "SELECT * FROM category";
    $categorys = mysqli_query($connect, $sqlCategory);
    $sql = "SELECT * FROM tbl_product WHERE id='$id'";
    $products = mysqli_query($connect, $sql);
    include_once './connect/closeConnect.php';
    $array = array();
    $array['categorys'] = $categorys;
    $array['products'] = $products;
    return $array;
}
function update_product()
{
    $id = $_POST['id'];
    $product_name = $_POST["product_name"];
    $img = $_FILES["img"]['name'];
    $img_tmp = $_FILES["img"]['tmp_name'];
    $description = $_POST["description"];
    $author = $_POST["author"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $created_date = $_POST["created_date"];
    $category_id = $_POST["category_id"];

    // Retrieve product information from database
    include_once './connect/openConnnect.php';
    $result = mysqli_query($connect, "SELECT * FROM tbl_product WHERE id = $id");
    $product = mysqli_fetch_assoc($result);

    if (!$product) {
        $msg = "Không tìm thấy sản phẩm!";
        echo "<script>alert('$msg');window.location.href='index.php?controller=product';</script>";
    } else {
        // Check if the new product_name is unique within the same category
        $result = mysqli_query($connect, "SELECT * FROM tbl_product WHERE category_id = $category_id AND product_name = '$product_name' AND id != $id");
        if (mysqli_num_rows($result) > 0) {
            $msg = "Tên sách bị trùng! Vui lòng sửa lại";
            echo "<script>alert('$msg');window.history.back();</script>";
        } else {
            // Update product in database
            $sql = "UPDATE tbl_product SET 
                    product_name = '$product_name', 
                    description = '$description', 
                    author = '$author', 
                    quantity = '$quantity', 
                    price = '$price', 
                    created_date = '$created_date', 
                    category_id = '$category_id'";
            if ($img) {
                move_uploaded_file($img_tmp, '../img/' . $img);
                $sql .= ", img = '$img'";
            }
            $sql .= " WHERE id = $id";
            mysqli_query($connect, $sql);
            $msg = "Cập nhật sản phẩm thành công!";
            echo "<script>alert('$msg');window.location.href='index.php?controller=product';</script>";
        }
    }
    include_once './connect/closeConnect.php';
}


//fucntion xóa dữ liệu trên db
function destroy_product()
{
    $id = $_GET['id'];
    include_once './connect/openConnnect.php';
    $sql = "DELETE FROM tbl_product WHERE id = '$id'";
    mysqli_query($connect, $sql);
    include_once './connect/closeConnect.php';
}
switch ($action) {
    case '':
        // Lay du lieu tu DB ve sau đó đổ dữ liệu lên mục views
        $products = index_product();
        break;
    case 'create_product':
        $categorys = create_product();
        break;
    case 'store_product':
        store_product();
        break;
    case 'edit':
        $array = edit();
        break;
    case 'update_product':
        update_product();
        break;
    case 'destroy_product':
        //xóa dữ liệu trên db
        destroy_product();
        break;
}
