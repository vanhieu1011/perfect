
    <style>
  .container {
    max-width: 600px;
    margin: 0 auto;
  }

  .address-column {
    flex: 1;
    padding: 20px;
    background-color: #f0f0f0;
  }

  .account-column {
    flex: 1;
    padding: 20px;
    background-color: #f0f0f0;
  }
  
  .form-group {
    margin-bottom: 20px;
  }

  h4 {
    margin-bottom: 10px;
  }

  label {
    display: block;
    margin-bottom: 5px;
  }

  input {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    box-sizing: border-box;
  }

  button {
    display: block;
    margin-top: 20px;
    background-color: black;
    color: #fff;
    padding: 10px 20px;
    position: relative;
    left: 450px;
  }

  button:hover {
    background-color: aqua;
  }

  .pttt {
    margin-top: 20px;
  }

  .pttt h3 {
    margin-bottom: 10px;
  }

  .pttt input {
    margin-right: 10px;
  }

  .error-message {
    color: red;
    font-size: 14px;
    font-weight: bold;
  }

  #userInfo1Container input,
  #userInfo2Container input,
  #recipientInfoContainer input,
  .pttt input {
    width: calc(100% - 16px);
  }

  #recipient_name_empty,
  #recipient_address_empty,
  #recipient_tel_empty,
  #name_empty,
  #email_empty,
  #email_invalid,
  #address_empty,
  #tel_empty,
  #pttt_empty {
    color: red;
    display: none;
  }
</style>

<?php
$hasAccountChecked = '';

if (isset($_SESSION['s_user'])) {
  $userInfo = $_SESSION['s_user'];
  $username = $userInfo['username'];
  $email = $userInfo['email'];
  $diachi = $userInfo['diachi'];
  $dienthoai = $userInfo['dienthoai'];
  $hasAccountChecked = 'checked';
}
?>
<section>
  <div class="container">
    <form id="" action="index.php?pg=donhangsubmit" method="post" class="viewcart" onsubmit="return formvalidate();">
      <div id="userInfo1Container" class="form-group">
        <h4>Thông tin người đặt hàng</h4>
        <label for="name">Họ và Tên:</label>
        <input type="text" id="hoten" name="hoten">
        <br>
        <i id="name_empty">Tên không được để trống</i><br>

        <label for="tel">Số điện thoại:</label>
        <input type="text" id="dienthoai" name="dienthoai">
        <br>
        <i id="tel_empty">Số điện thoại không được để trống</i><br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" >
        <br>
        <i id="email_empty">Email không được để trống</i>
        <i id="email_invalid">Email không hợp lệ</i><br>

        <label for="address">Địa chỉ:</label>
        <input type="text" id="diachi" name="diachi">
        <br>
        <i id="address_empty">Địa chỉ không được để trống</i><br>
      </div>
      <div class="form-group1">
        <!-- Thêm checkbox "Tôi đã có tài khoản" và container chứa thông tin người đặt hàng 1 và người đặt hàng 2 -->
        <label class="account-column" for="hasAccountCheckbox" id="hasAccountText" onclick="toggleUserInfo()" <?php echo $hasAccountChecked; ?>>
          Tôi đã có tài khoản
        </label>
        <input type="checkbox" id="hasAccountCheckbox" style="display: none;">
        <div id="userInfo2Container" class="form-group" style="display: none;">
          <h4>Thông tin người đặt hàng</h4>
          <label for="name">Họ và Tên:</label>
          <input type="text" id="hoten " name="hoten " value="<?php echo $username; ?>"  >
          <br>

          <label for="tel">Số điện thoại:</label>
          <input type="text" id="dienthoai " name="dienthoai " value="<?php echo $dienthoai; ?>"  >
          <br>


          <label for="address">Địa chỉ:</label>
          <input type="text" id="diachi " name="diachi " value="<?php echo $diachi; ?>"  >
          <br>
        </div>


        <!-- Thông tin người nhận hàng -->
        <label>
          <label class="address-column" for="useDifferentAddressCheckbox" id="useDifferentAddressText" onclick="toggleRecipientInfo()">
            Nhận hàng tại địa chỉ khác
          </label>
          <input type="checkbox" id="useDifferentAddressCheckbox" style="display: none;">

          <div id="recipientInfoContainer" class="form-group" style="display: none;">
            <h4>Thông tin người nhận hàng</h4>

            <!-- Sao chép thông tin từ phần thông tin người đặt hàng -->
            <label for="recipient_name">Họ và Tên:</label>
            <input type="text" id="hoten_nguoinhan" name="hoten_nguoinhan">
            <br>
            <i id="recipient_name_empty">Tên không được để trống</i><br>

            <label for="recipient_tel">Số điện thoại:</label>
            <input type="text" id="dienthoai_nguoinhan" name="dienthoai_nguoinhan">
            <br>
            <i id="recipient_tel_empty">Số điện thoại không được để trống</i><br>

            <label for="recipient_address">Địa chỉ:</label>
            <input type="text" id="diachi_nguoinhan" name="diachi_nguoinhan">
            <br>
            <i id="recipient_address_empty">Địa chỉ không được để trống</i><br>
          </div>
      </div>
      <!-- Phương thức thanh toán -->
      <div class="pttt">
        <h3>Phương thức thanh toán</h3>
        <i id="pttt_empty">Vui lòng chọn phương thức thanh toán</i>
        <div class="col-md-9">
          <input type="radio" name="pttt" id="pttt1" class="ml-5" value="1">Tiền mặt
          <input type="radio" name="pttt" id="pttt2" class="ml-5" value="2">Ví điện tử
          <input type="radio" name="pttt" id="pttt3" class="ml-5" value="3">Chuyển khoản
          <input type="radio" name="pttt" id="pttt4" class="ml-5" value="4">Thanh toán online
        </div>
      </div>
      <button class="btn btn-success" type="submit" name="donhang" style="cursor:pointer" onclick="formvalidate()">Đặt hàng</button>
    </form>
    <script>
      function toggleUserInfo() {
        // Lấy giá trị từ checkbox "Tôi đã có tài khoản"
        var hasAccountCheckbox = document.getElementById('hasAccountCheckbox');

        // Lấy phần tử chứa thông tin người đặt hàng 1 và người đặt hàng 2
        var userInfo1Container = document.getElementById('userInfo1Container');
        var userInfo2Container = document.getElementById('userInfo2Container');

        // Hiển thị hoặc ẩn phần thông tin người đặt hàng tùy thuộc vào giá trị của checkbox
        userInfo1Container.style.display = hasAccountCheckbox.checked ? 'none' : 'block';
        userInfo2Container.style.display = hasAccountCheckbox.checked ? 'block' : 'none';
      }

      function toggleRecipientInfo() {
        // Lấy giá trị từ checkbox "Nhận hàng tại địa chỉ khác"
        var useDifferentAddressCheckbox = document.getElementById('useDifferentAddressCheckbox');
        var useDifferentAddressText = document.getElementById('useDifferentAddressText');

        // Lấy phần tử chứa thông tin người nhận hàng
        var recipientInfoContainer = document.getElementById('recipientInfoContainer');

        // Hiển thị hoặc ẩn phần thông tin người nhận hàng tùy thuộc vào giá trị của checkbox
        recipientInfoContainer.style.display = useDifferentAddressCheckbox.checked ? 'block' : 'none';
      }

      function formvalidate() {
        // Lấy giá trị từ các trường nhập liệu
        var result = true;

        // Thông tin người đặt hàng
        var ten = document.getElementById('hoten').value;
        var email = document.getElementById('email').value;
        var diachi = document.getElementById('diachi').value;
        var tel = document.getElementById('dienthoai').value;
        var pttt1 = document.getElementById('pttt1').checked;
        var pttt2 = document.getElementById('pttt2').checked;
        var pttt3 = document.getElementById('pttt3').checked;
        var pttt4 = document.getElementById('pttt4').checked;


        // Kiểm tra nếu có trường nào không nhập hoặc nhập sai
        if (ten.length === 0) {
          document.getElementById('name_empty').style.display = "block";
          result = false;
        } else {
          document.getElementById('name_empty').style.display = "none";
        }

        if (tel.length === 0) {
          document.getElementById('tel_empty').style.display = "block";
          result = false;
        } else {
          document.getElementById('tel_empty').style.display = "none";
        }

        if (email.length === 0) {
          document.getElementById('email_empty').style.display = "block";
          document.getElementById('email_invalid').style.display = "none";
          result = false;
        } else {
          document.getElementById('email_empty').style.display = "none";
          var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (!emailRegex.test(email)) {
            document.getElementById('email_invalid').style.display = "block";
            result = false;
          } else {
            document.getElementById('email_invalid').style.display = "none";
          }
        }

        if (diachi.length === 0) {
          document.getElementById('address_empty').style.display = "block";
          result = false;
        } else {
          document.getElementById('address_empty').style.display = "none";
        }

        if (!(pttt1 || pttt2 || pttt3 || pttt4)) {
          document.getElementById('pttt_empty').style.display = "block";
          result = false;
        } else {
          document.getElementById('pttt_empty').style.display = "none";
        }

        return result;

      }
    </script>
</section>