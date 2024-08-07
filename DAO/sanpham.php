<?php
// require_once 'pdo.php';

 function sanpham_insert($name, $img, $price, $iddm){
     $sql = "INSERT INTO sanpham(name, img, price, iddm) VALUES (?,?,?,?)";
     pdo_execute($sql, $name, $img, $price, $iddm);
 }

 function sanpham_update($name, $img, $price,$iddm,$id){
    if($img!=""){
     $sql = "UPDATE sanpham SET name=?,img=?,price=?,iddm=? WHERE id=?";
     pdo_execute($sql, $name, $img, $price, $iddm, $id);
    }else{
        $sql = "UPDATE sanpham SET name=?,price=?,iddm=? WHERE id=?";
        pdo_execute($sql, $name, $price, $iddm, $id);
    }
 }

 function sanpham_delete($id) {
    $sql = "DELETE FROM sanpham WHERE id=?";
    
    if (is_array($id)) {
        foreach ($id as $ma) {
            pdo_execute($sql, $ma);
        }
    } else {
        pdo_execute($sql, $id);
    }
}


function get_dssp_new(){
    $sql = "SELECT * FROM sanpham ORDER BY id DESC" ; //$limi là lấy sản phẩm theeo yêu cầu
    return pdo_query($sql);
}


function get_dssp_best(){
    $sql = "SELECT * FROM sanpham WHERE bestseller=1 ORDER BY id DESC" ; //$limi là lấy sản phẩm theeo yêu cầu
    return pdo_query($sql);
}
function get_dssp_view(){
    $sql = "SELECT * FROM sanpham ORDER BY view DESC" ; //$limi là lấy sản phẩm theeo yêu cầu
    return pdo_query($sql);
}
function get_dssp_splienquan($iddm,$id){
    $sql = "SELECT * FROM sanpham WHERE iddm=? AND id<>? ORDER BY view DESC ";
    return pdo_query($sql,$iddm,$id);
}

function get_sp_by_id($id){
    $sql = "SELECT * FROM sanpham WHERE id=?";
    return pdo_query_one($sql, $id);
}

function showsp($dssp_new){
    $html_dssp_new='';
    foreach ($dssp_new as $sp) {
        extract($sp);
        $link = "index.php?pg=sanphamchitiet&idpro=" . $id;
        $html_dssp_new.='
        <div class="pro" >         
        <a href="'.$link.'"><img src="./LAYOUT/img/'.$img.'" alt=""></a>
                    <div class="des">
                        <span>adidas</span>
                        <h5>'.$name.'</h5>
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h4>'.$price.'</h4>
                    </div>
                    <form action="index.php?pg=addcart" method="post">
                        <input type="hidden" name="idpro" value="'.$id.'">
                        <input type="hidden" name="name" value="'.$name.'">
                        <input type="hidden" name="img" value="img/'.$img.'">
                        <input type="hidden" name="price" value="'.$price.'">
                        <input type="hidden" name="soluong" value="1">
                        <div class="cart"><button style="submit" name="addcart"><i class="fa-solid fa-cart-shopping"></i></button></div>
                    </form>         
                </div>
                '; 
    } 
    return $html_dssp_new;
}
//admin
function hien_thi_so_trang($dssp,$soluongsp){
    $tongsanpham=count($dssp);
    $sotrang=ceil($tongsanpham/$soluongsp);
    $html_sotrang="";
    for ($i=1; $i <=$sotrang ; $i++) { 
        $html_sotrang.='<a href="index.php?pg=sanphamlist&page='.$i.'">'.$i.'</a> ';
    }
    return $html_sotrang;
}
function get_dssp_admin($kyw,$page,$soluongsp){

    // kiểm tra đang ở trang nào? tạo limit
    // if(($page="")||($page=0)) $page=1;
    
    $batdau=($page-1)*$soluongsp;
     

    $sql = "SELECT * FROM sanpham WHERE 1";
    if($kyw!=""){
        $sql .= " AND name like ?";
        $sql .= " ORDER BY id DESC";
        $sql .= " LIMIT ".$batdau.",".$soluongsp;
        return pdo_query($sql,"%".$kyw."%");
    }else{
        $sql .= " ORDER BY id DESC";
        $sql .= " LIMIT ".$batdau.",".$soluongsp;
        return pdo_query($sql);
    }
}
function showsp_admin($dssp_new){
    $html_dssp_new='';
    $i=1;
    foreach ($dssp_new as $sp) {
        extract($sp);
        $link = "index.php?pg=sanphamchitiet&idpro=" . $id;
        $html_dssp_new.='<tr>
         <td>'.$i.'</td>
         <td><img src="'.IMG_PATH_ADMIN.$img.'" alt="'.$name.'" width="80px" /></td>
         <td>'.$name.'</td>
         <td>'.$price.'</td>
         <td>'.$view.'</td>
         <td>
                  <a href="index.php?pg=sanphamupdate&id='.$id.'" class="btn btn-warning"
                    ><i class="fa-solid fa-pen-to-square"></i> Sửa</a
                  >
                  <a href="index.php?pg=delproduct&id='.$id.'" class="btn btn-danger"
                    ><i class="fa-solid fa-trash"></i> Xóa</a
                  >
                </td>
        </tr>
        
                '; 
                $i++;
    }

    return $html_dssp_new;
}


function get_dssp($kyw){
    $sql ="SELECT * FROM sanpham WHERE 1";
    if ($kyw!="") {
        $sql .= " AND name like '%".$kyw."%'";  // thêm % để so sánh tương đương
    }
    $sql .="ORDER BY id DESC";
    // return pdo_query($sql);
}


// function hang_hoa_exist($ma_hh){
//     $sql = "SELECT count(*) FROM hang_hoa WHERE ma_hh=?";
//     return pdo_query_value($sql, $ma_hh) > 0;
// }

// function hang_hoa_tang_so_luot_xem($ma_hh){
//     $sql = "UPDATE hang_hoa SET so_luot_xem = so_luot_xem + 1 WHERE ma_hh=?";
//     pdo_execute($sql, $ma_hh);
// }

// function hang_hoa_select_top10(){
//     $sql = "SELECT * FROM hang_hoa WHERE so_luot_xem > 0 ORDER BY so_luot_xem DESC LIMIT 0, 10";
//     return pdo_query($sql);
// }

// function hang_hoa_select_dac_biet(){
//     $sql = "SELECT * FROM hang_hoa WHERE dac_biet=1";
//     return pdo_query($sql);
// }

// function hang_hoa_select_by_loai($ma_loai){
//     $sql = "SELECT * FROM hang_hoa WHERE ma_loai=?";
//     return pdo_query($sql, $ma_loai);
// }

// function hang_hoa_select_keyword($keyword){
//     $sql = "SELECT * FROM hang_hoa hh "
//             . " JOIN loai lo ON lo.ma_loai=hh.ma_loai "
//             . " WHERE ten_hh LIKE ? OR ten_loai LIKE ?";
//     return pdo_query($sql, '%'.$keyword.'%', '%'.$keyword.'%');
// }

// function hang_hoa_select_page(){
//     if(!isset($_SESSION['page_no'])){
//         $_SESSION['page_no'] = 0;
//     }
//     if(!isset($_SESSION['page_count'])){
//         $row_count = pdo_query_value("SELECT count(*) FROM hang_hoa");
//         $_SESSION['page_count'] = ceil($row_count/10.0);
//     }
//     if(exist_param("page_no")){
//         $_SESSION['page_no'] = $_REQUEST['page_no'];
//     }
//     if($_SESSION['page_no'] < 0){
//         $_SESSION['page_no'] = $_SESSION['page_count'] - 1;
//     }
//     if($_SESSION['page_no'] >= $_SESSION['page_count']){
//         $_SESSION['page_no'] = 0;
//     }
//     $sql = "SELECT * FROM hang_hoa ORDER BY ma_hh LIMIT ".$_SESSION['page_no'].", 10";
//     return pdo_query($sql);
// }
function get_img($id){
    $sql ="SELECT img FROM sanpham WHERE id=?";
    $getimg= pdo_query_one($sql,$id);
    return $getimg['img'];
}
function get_sanphamchitiet($id){
    $sql = "SELECT * FROM sanpham WHERE id=?";
    return pdo_query_one($sql,$id);
}