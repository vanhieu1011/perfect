<div class="main-content">
                <h3 class="title-page">
                    Quản lí đơn hàng
                </h3>
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Mã Đơn hàng</th>
                            <th>ID người mua</th>
                            <th>Tên người đặt  </th>
                            <th>Email người đặt</th>
                            <th>SĐT người đặt</th>
                            <th>Địa chỉ người đặt</th>
                            <th>Tên người nhận</th>
                            <th>Địa chỉ người nhận</th>
                            <th>SĐT người nhận</th>
                            <th>SHIP</th>
                            <th>Voucher</th>
                            <th>Tổng thanh toán</th>
                            <th>PTT</th>
                        </tr>
                    </thead>
                    <?php
                    if(isset($kq)&&(count($kq)>1)){
    $i=1;
foreach ($kq as $donhang) {
    echo '<tr>
    <td>'.$i.'</td>
    <td>'.$donhang['madh'].'</td>
    <td>'.$donhang['iduser'].'</td>
    <td>'.$donhang['nguoidat_ten'].'</td>
    <td>'.$donhang['nguoidat_email'].'</td>
    <td>'.$donhang['nguoidat_tel'].'</td>
    <td>'.$donhang['nguoidat_diachi'].'</td>
    <td>'.$donhang['nguoinhan_ten'].'</td>
    <td>'.$donhang['nguoinhan_diachi'].'</td>
    <td>'.$donhang['nguoinhan_tel'].'</td>
    <td>'.$donhang['total'].'</td>
    <td>'.$donhang['ship'].'</td>
    <td>'.$donhang['voucher'].'</td>
    <td>'.$donhang['tongthanhtoan'].'</td>
    <td>'.$donhang['pttt'].'</td>
    

    <td>
        <a href="#" class="btn btn-warning"><i
                class="fa-solid fa-pen-to-square"></i> Sửa</a>
                <a href="='.$donhang['id'].'" class="btn btn-danger"><i
                class="fa-solid fa-trash"></i> Xóa</a>
    
    
    </tr>';
    $i++;
}

 }
 ?>
                    <tfoot>
                        <tr>
                        <th> Mã Đơn hàng</th>
                            <th>ID người mua</th>
                            <th>Tên người đặt  </th>
                            <th>Email người đặt</th>
                            <th>SĐT người đặt</th>
                            <th>Địa chỉ người đặt</th>
                            <th>Tên người nhận</th>
                            <th>Địa chỉ người nhận</th>
                            <th>SĐT người nhận</th>
                            <th>SHIP</th>
                            <th>Voucher</th>
                            <th>Tổng thanh toán</th>
                            <th>PTT</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
    <script>
        new DataTable('#example');
    </script>