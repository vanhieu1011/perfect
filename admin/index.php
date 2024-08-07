<?php
   include "../DAO/global.php";
   include "../DAO/pdo.php";
   include "../DAO/danhmuc.php";
   include "../DAO/sanpham.php";
   include "../DAO/user.php";
   include "../DAO/donhang.php";


   include "view/header.php";
   if(isset($_GET['pg'])){
    $pg=$_GET['pg'];
    switch ($pg) {
        case 'sanphamlist':
            $sanphamlist=get_dssp_new(100);
            include "view/sanphamlist.php";
            break;
            case 'updateproduct':
                // kiểm tra và lấy dữ liệu
                if(isset($_POST['updateproduct'])){
                $name=$_POST['name'];
                $price=$_POST['price'];
                $iddm=$_POST['iddm'];
                $id=$_POST['id'];

                $img=$_FILES['img']['name'];
                if($img!=""){

                
                
                //upload hình ảnh
                $target_file=IMG_PATH_ADMIN.$img;
                move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
                }else{
                    $img="";
                }
                //insert into
                sanpham_update($name, $img, $price, $iddm,$id);
                }

                //

                // show ds sp
                $sanphamlist=get_dssp_new(100);
                include "view/sanphamlist.php";
                break;
        case 'sanphamadd':
            $danhmuclist=danhmuc_all();
            include "view/sanphamadd.php";
            break;
            case 'sanphamupdate':
                if(isset($_GET['id'])&&($_GET['id']>0)){
                    $id=$_GET['id'];
                    $sp=get_sanphamchitiet($id);

                }
                //trở về trang dssp
                $danhmuclist=danhmuc_all();
                include "view/sanphamupdate.php";
                break;
        case 'delproduct':
            if(isset($_GET['id'])&&($_GET['id']>0)){
                $id=$_GET['id'];
                $img=IMG_PATH_ADMIN.get_img($id);
                if(is_file($img)){
                    unlink($img);
                }
                try {
                    sanpham_delete($id);
                } catch (\Throwable $th) {
                    //throw $th;
                    echo "<h3 style='color:red;text-align:center'>Sản phẩm đã có trong giỏ hàng! Không được quyền xóa!</h3>";
                }
                
            }
            //trở về trang dssp
            $sanphamlist=get_dssp_new(100);
            include "view/sanphamlist.php";
            break;
        case 'addproduct':
            if(isset($_POST['addproduct'])){
                //lấy dữ liệu về
                $name=$_POST['name'];
                $price=$_POST['price'];
                $iddm=$_POST['iddm'];
                $img=$_FILES['img']['name'];

                

                //insert into
                sanpham_insert($name, $img, $price, $iddm);
                //upload hình ảnh
                $target_file=IMG_PATH_ADMIN.$img;
                move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);

                // trở về tràn dssp
                $sanphamlist=get_dssp_new(100);
                include "view/sanphamlist.php";
            }else{
                $danhmuclist=danhmuc_all();
                include "view/sanphamadd.php";
            }

            break;

            
            case 'order':
                $kq=order_all();
                include "view/order.php";
                break;
            case 'danhmuc':
                $kq=danhmuc_all();
                include "view/danhmuc.php";
                break;
            case 'danhmuc_add':
                if(isset($_POST['btnadd'])){
                    $name=$_POST['name'];
                    danhmuc_insert($name);
                    $tb="Bạn đã thêm thành công!";
                }
                include "view/danhmuc_add.php";
                break;
            case 'deldm':
                if(isset($_GET['id'])){
                    $id=$_GET['id'];
                    deldm($id);
                }
                $kq=danhmuc_all();
                include "view/danhmuc.php";
    
                break;
                case 'updatedmform':
                    //lấy 1 RECORD  đúng với id truyền vào
                    if(isset($_GET['id'])&&($_GET['id']>0)){
                        $id=$_GET['id'];
                        $kqone=getonedm($id);
                        $kq=danhmuc_all();
                        include "view/updatedmform.php";
                        break;
                    }if(isset($_POST['id'])&&($_POST['id']>0)){
                        $id=$_POST['id'];
                        $name=$_POST['name'];
                        updatedm($id,$name);
                        $kq=danhmuc_all();
                        include "view/danhmuc.php";
                        break;
                    }
                    //cần dsdm
                    case 'user':
                        $kq=user_select_all();
                        include "view/user.php";
                        break;
                    case 'user_add':
                        if(isset($_POST['btnnadd'])){
                            $username=$_POST['username'];
                            $password=$_POST['password'];
                            $ten=$_POST['ten'];
                            $diachi=$_POST['diachi'];
                            $email=$_POST['email'];
                            $dienthoai=$_POST['dienthoai'];
            
                            user_insert($username, $password,$ten,$diachi,$email , $dienthoai);
                            $tb="Bạn đã thêm thành công!";
                        }
                        include "view/user_add.php";
                        break;
                        case 'deluser':
                            if(isset($_GET['id'])&&($_GET['id']>0)){
                                $id=$_GET['id'];
                                deluser($id);
                            }
                            $kq=user_select_all();
                            include "view/user.php";
                            break;
        default:
            include "view/home.php";
            break;
       }
   }else{
    include "view/home.php";

   }

   include "view/footer.php";
   





   ?>
