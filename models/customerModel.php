<?php

// function index(){
//     $search='';
//     if (isset($_POST['search'])){
//         $search=$_POST['search'];
//     }
// //    $search=$_GET['search'];
//     include_once 'connect/openConnnect.php';
//     $sql_search="select * from tbl_account where username like '%$search%'";
//     $customers = mysqli_query($connect,$sql_search);
//     $sqlCount="SELECT COUNT(*) as count_record FROM tbl_account";
//     $counts = mysqli_query($connect,$sqlCount);
//     foreach ($counts as $each){
//         $countRecord=$each['count_record'];
//     }
//     $recordOnepage =3;
//     $countpage=ceil($countRecord/$recordOnepage);
// //    $sql_select= "select * from tbl_account";
// //    $customers = mysqli_query($connect,$sql_select);
//     include_once './connect/closeConnect.php';
// //    $array = array();
// //    $array['search'] = $search;
// //    $array['infor'] = $brands;
// //    $array['page'] = $countPage;
// //    return $array;
//     return $customers;
// }
function index_customer()
{
    include_once 'connect/openConnnect.php';
    $sql = "SELECT tbl_account.*, tbl_role.role_name AS role_name FROM tbl_account INNER JOIN tbl_role ON tbl_account.role_id = tbl_role.role_id";
    $customers = mysqli_query($connect, $sql);
    include_once './connect/closeConnect.php';
    return $customers;
}
function create_customer()
{
    include_once './connect/openConnnect.php';
    $sql = "SELECT * FROM tbl_role";
    $roles = mysqli_query($connect, $sql);
    include_once 'connect/closeConnect.php';
    return $roles;
}

function store_customer()
{

    // Lấy dữ liệu từ biểu mẫu
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $role_id = $_POST['role_id'];

    // Kiểm tra tên đăng nhập đã tồn tại hay chưa
    include_once 'connect/openConnnect.php';
    $check_duplicate = mysqli_query($connect, "SELECT * FROM tbl_account WHERE username = '$username'");
    if (mysqli_num_rows($check_duplicate) > 0) {
        $msg = 'Tài khoản này đã tồn tại!';
        echo "<script>alert('$msg'); window.history.back();</script>";
    } else {
        // Kiểm tra mật khẩu và xác nhận mật khẩu khớp nhau hay không
        if ($password != $repassword) {
            $msg = 'Mật khẩu không khớp!';
            echo "<script>alert('$msg'); window.history.back();</script>";
        } else {
            // Lưu dữ liệu vào cơ sở dữ liệu
            $sql = "INSERT INTO tbl_account (fullname,username,email,address,phone,password,role_id) 
                        VALUES ('$fullname','$username','$email','$address','$phone','$password','$role_id')";
            mysqli_query($connect, $sql);
            $msg = 'Data saved successfully!';
            include_once 'connect/closeConnect.php';
            echo "<script>alert('$msg');</script>";
        }
    }
}



function edit_customer()
{

    $account_id = $_GET['account_id'];
    include_once './connect/openConnnect.php';
    $sqlRole = "SELECT * FROM tbl_role";
    $roles = mysqli_query($connect, $sqlRole);
    $sql = "SELECT * FROM tbl_account WHERE account_id='$account_id'";
    $customers = mysqli_query($connect, $sql);
    include_once './connect/closeConnect.php';
    $array = array();
    $array['roles'] = $roles;
    $array['customers'] = $customers;
    return $array;
}

function update_customer()
{
    $account_id = $_POST['account_id'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $role_id = $_POST['role_id'];

    // Retrieve account information from database
    include_once './connect/openConnnect.php';
    $result = mysqli_query($connect, "SELECT * FROM tbl_account WHERE account_id = $account_id");
    $account = mysqli_fetch_assoc($result);

    if (!$account) {
        $msg = "Không tìm thấy người dùng!";
        echo "<script>alert('$msg');</script>";
    } else {
        // Check if the new username is unique within the same role
        $result = mysqli_query($connect, "SELECT * FROM tbl_account WHERE role_id = $role_id AND username = '$username' AND account_id != $account_id");
        if (mysqli_num_rows($result) > 0) {
            $msg = "Tên người dùng bị trùng! Vui lòng sửa lại";
            echo "<script>alert('$msg');window.history.back();</script>";
        } else {
            // Update account in database
            $sql = "UPDATE tbl_account SET 
                    fullname = '$fullname', 
                    username = '$username', 
                    email = '$email',
                    address = '$address',
                    phone = '$phone', 
                    role_id = '$role_id'
                    WHERE account_id = $account_id";
            mysqli_query($connect, $sql);
            $msg = "Cập nhật người dùng thành công!";
            echo "<script>alert('$msg');</script>";
        }
    }
    include_once './connect/closeConnect.php';
}

function update_password()
{
    if (isset($_POST['sbmpassword'])) {
        $account_id = $_POST['account_id'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        if ($password != $repassword) {
            $msg = "Mật khẩu không khớp vui lòng nhập lại";
            echo "<script>alert('$msg');window.history.back();</script>";
        } else {
            include_once './connect/openConnnect.php';
            $sql = "UPDATE tbl_account SET
                            password = '$password'
                            WHERE account_id = $account_id";
            mysqli_query($connect, $sql);
            include_once './connect/closeConnect.php';
            $msg = "Cập nhật mật khẩu người dùng thành công!";
            echo "<script>alert('$msg');</script>";
        }
    }
}

//fucntion xóa dữ liệu trên db
function destroy_customer()
{
    $account_id = $_GET['account_id'];
    include_once './connect/openConnnect.php';
    $sql = "DELETE FROM tbl_account WHERE account_id = '$account_id'";
    mysqli_query($connect, $sql);
    include_once './connect/closeConnect.php';
}
switch ($action) {
    case '':
        // Lay du lieu tu DB ve
        $customers = index_customer();
        break;
    case 'create_customer':
        $roles = create_customer();
        break;
    case 'store_customer':
        store_customer();
        break;
    case 'edit_customer':
        $array = edit_customer();
        break;
    case 'update_customer':
        update_customer();
        break;
    case 'update_password':
        update_password();
        break;
    case 'destroy_customer':
        //xóa dữ liệu trên db
        destroy_customer();
        break;
}
