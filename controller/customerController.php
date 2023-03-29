<?php
//    Lấy hành động đang thực hiện
$action = '';
if(isset($_GET['action'])){
    $action = $_GET['action'];
}
//Kiểm tra hành động đang thực hiện
switch ($action){
    case '':
        //Hiển thị danh sách khach hang
        include_once 'models/customerModel.php';
        include_once 'views/customer/index.php';
        break;
    case 'create':
        include_once 'views/customer/create.php';
        break;
    case 'store':
        include_once 'models/customerModel.php';
        header("Location:index.php?controller=customer");
        break;
    case 'edit':
        include_once 'models/customerModel.php';
        include_once 'views/customer/edit.php';
        break;
    case 'update':
        include_once 'models/customerModel.php';
            echo '<script>
                    location.href = "index.php?controller=customer";
                </script>';
        // header('Location:index.php?controller=customer');
        break;
    case 'updatepassword':
        include_once 'models/customerModel.php';
            echo '<script>
                    location.href = "index.php?controller=customer";
                </script>';
        break;
    case 'destroy':
        include_once 'models/customerModel.php';
        header('Location:index.php?controller=customer');
        break;
    case 'search':


}
