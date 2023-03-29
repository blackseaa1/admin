<?php
function indexProduct(){
    include_once 'connect/openConnnect.php';
//    $sql_select= "select * from tbl_account";
    $sql_select= "SELECT * FROM tbl_product INNER JOIN category ON tbl_product.category_id= category.category_id" ;
    $products = mysqli_query($connect,$sql_select);
    include_once './connect/closeConnect.php';
    return $products;
}
function store(){
    $product_name = $_POST["product_name"];
    $img=$_FILES["img"]['name'];
    $img_tmp=$_FILES["img"]['tmp_name'];
    $description = $_POST["description"];
    $author = $_POST["author"];
    $quantity=$_POST["quantity"];
    $price=$_POST["price"];
    $created_date=$_POST["created_date"];
    $category_id=$_POST["category_id"];
    include_once 'connect/openConnnect.php';
    $sql = "INSERT INTO tbl_product(product_name,img,description,author,quantity,price,created_date,category_id)
            values('$product_name','$img','$description','$author','$quantity','$price','$created_date','$category_id')";
    move_uploaded_file($img_tmp,'../img/'.$img);
    mysqli_query($connect,$sql);
    include_once 'connect/closeConnect.php';
}
function createProduct(){
    include_once './connect/openConnnect.php';
    $sql = "SELECT * FROM category";
    $categorys = mysqli_query($connect, $sql);
    include_once 'connect/closeConnect.php';
    return $categorys;
}
function edit(){
    $id=$_GET['id'];
    include_once './connect/openConnnect.php';
    $sqlCategory = "SELECT * FROM category";
    $categorys = mysqli_query($connect, $sqlCategory);
    $sql="Select * from tbl_product where id='$id'";
    $products=mysqli_query($connect,$sql);
    include_once './connect/closeConnect.php';
//    $array = array();
//    $array['categorys'] = $categorys;
//    $array['products'] = $products;
//    return $array;
    return $products;
}
function update(){
//    if($_FILES["img"]['product_name']==''){
//        $img=$products['img'];
//    }
//    else{
//        $img=$_FILES['img']['name'];
//        $img_tmp=$_FILES['img']['tmp_name'];
//        move_uploaded_file($img_tmp,'img/'.$img);
//
//    }
    $id=$_POST['id'];
    $product_name = $_POST["product_name"];
    $img=$_FILES["imgFile"]['name'];
//    echo $img;
//    die();
    $img_tmp=$_FILES["img"]['tmp_name'];
    $description = $_POST["description"];
    $author = $_POST['author'];
    $quantity=$_POST['quantity'];
    $price=$_POST['price'];
    $created_date=$_POST['created_date'];
    $category_name=$_POST['category_name'];
    $category_id=$_POST['category_id'];
    include_once './connect/openConnnect.php';
//    $sql_category="SELECT * FROM category";
//    $query_category= mysqli_query($connect,$sql_category);
    $sql_update="UPDATE tbl_product SET product_name='$product_name',img='$img',description='$description',
        author='$author',quantity='$quantity',price='$price',created_date='$created_date',category_id='$category_id' where id='$id'";
    mysqli_query($connect,$sql_update);
    include_once './connect/closeConnect.php';
}
//fucntion xóa dữ liệu trên db
function destroy(){
    $id = $_GET['id'];
    include_once './connect/openConnnect.php';
    $sql = "DELETE FROM tbl_product WHERE id = '$id'";
    mysqli_query($connect, $sql);
    include_once './connect/closeConnect.php';
}
switch ($action){
    case'':
        // Lay du lieu tu DB ve sau đó đổ dữ liệu lên mục views
        $products=indexProduct();
        break;
    case 'store':
        store();
        break;
    case 'create':
        $categorys = createProduct();
        break;
    case 'edit':
//        $array= edit();
        $products=edit();
        break;
    case 'update':
        update();
        break;
    case 'destroy':
        //xóa dữ liệu trên db
        destroy();
        break;
}
?>


