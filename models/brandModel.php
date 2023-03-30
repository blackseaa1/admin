<?php
//function để lấy dữ liệu từ DB về
function index()
{
    include_once 'connect/openConnnect.php';
    $sql = "SELECT * FROM category";
    $brands = mysqli_query($connect, $sql);
    include_once './connect/closeConnect.php';
    return $brands;
}

//    Function lưu dữ liệu lên DB
function store_category()
{
    $category_name = $_POST['category_name'];
    include_once 'connect/openConnnect.php';
    // Kiểm tra kết nối
    if (!$connect) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }
    // Kiểm tra dữ liệu đã tồn tại trong database hay chưa
    $sql = "SELECT * FROM category WHERE category_name = '$category_name'";
    $result = mysqli_query($connect, $sql);
    // Nếu dữ liệu chưa tồn tại trong database thì thêm mới
    if (mysqli_num_rows($result) == 0) {
        $sql = "INSERT INTO category(category_name) VALUES ('$category_name')";
        if (mysqli_query($connect, $sql)) {
            $message = "Thêm danh mục thành công";
        } else {
            $message = "Lỗi: " . mysqli_error($connect);
        }
    } else {
        $message = "Danh mục đã tồn tại, Vui lòng thêm lại!";
    }

    // Đóng kết nối đến database
    include_once 'connect/closeConnect.php';
    // Hiển thị thông báo
    echo "<script>alert('$message');window.location.href='index.php?controller=brand';</script>";
}
//function lấy dữ liệu trên db dựa theo id
function edit_category()
{
    $id = $_GET['category_id'];
    include_once 'connect/openConnnect.php';
    $sql = "SELECT * FROM category WHERE category_id = '$id'";
    $brands = mysqli_query($connect, $sql);
    include_once 'connect/closeConnect.php';
    return $brands;
}
//    function update dữ liệu trên db
function update_category()
{
    $id = $_POST['category_id'];
    $category_name = $_POST['category_name'];
    include_once 'connect/openConnnect.php';
    // Kiểm tra dữ liệu đã tồn tại trong database hay chưa
    $sql = "SELECT * FROM category WHERE category_name = '$category_name' AND category_id != '$id'";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 0) {
        $sql = "UPDATE category SET category_name = '$category_name' WHERE category_id = '$id'";
        if (mysqli_query($connect, $sql)) {
            $message = "Cập nhật danh mục thành công";
        } else {
            $message = "Lỗi: " . mysqli_error($connect);
        }
    } else {
        $message = "Danh mục đã tồn tại, Vui lòng sửa lại!";
    }
    include_once 'connect/closeConnect.php';
    echo "<script>alert('$message');</script>";
}

//fucntion xóa dữ liệu trên db
function destroy_category()
{
    $id = $_GET['category_id'];
    include_once 'connect/openConnnect.php';

    // Delete the corresponding records in tbl_product
    $delete_products_sql = "DELETE FROM tbl_product WHERE category_id = '$id'";
    mysqli_query($connect, $delete_products_sql);

    // Delete the record in category
    $delete_category_sql = "DELETE FROM category WHERE category_id = '$id'";
    if (mysqli_query($connect, $delete_category_sql)) {
        $message = "Xóa danh mục thành công";
    } else {
        $message = "Lỗi: " . mysqli_error($connect);
    }
    include_once 'connect/closeConnect.php';
    echo "<script>alert('$message');</script>";
}

switch ($action) {
    case '':
        //Lấy dữ liệu từ DB về
        $brands = index();
        break;
    case 'store_category':
        //            Lưu dữ liệu lên DB
        store_category();
        break;
    case 'edit_category':
        //Lấy dữ liệu từ DB về dựa trên id
        $brands = edit_category();
        break;
    case 'update_category':
        //chỉnh sửa dữ liệu lên db
        update_category();
        break;
    case 'destroy_category':
        //xóa dữ liệu trên db
        destroy_category();
        break;
}
