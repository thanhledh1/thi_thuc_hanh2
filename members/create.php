<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f1f1f1;
    padding: 10px;
  }

  h2 {
    margin-bottom: 20px;
    color: #000;
    margin-left: 490px;
  }

  form {
    background-color: #fff;
    border-radius: 4px;
    padding: 20px;
  }

  label {
    font-weight: bold;
    color: #00008B;
  }

  input[type="text"],
  input[type="email"],

  input[type="number"],
  select,
  input[type="date"],
  input[type="file"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-bottom: 10px;
  }

  input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  input[type="submit"]:hover {
    background-color: #45a049;
  }
</style>

<?php
// session_start();
include_once '../db.php';


$sql = "SELECT * FROM `patients`";
// Truy vấn
$stmt = $conn->query($sql);
// Thiết lập kiểu dữ liệu trả về
$stmt->setFetchMode(PDO::FETCH_ASSOC); //array

// Trả về dữ liệu
$rows = $stmt->fetchAll();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  // echo '<pre>';
  // print_r ($_REQUEST);
  // die();
  $TENBENHNHAN = $_REQUEST['TENBENHNHAN'];
  $PHONG = $_REQUEST['PHONG'];
  $NGAYNHAPVIEN = $_REQUEST['NGAYNHAPVIEN'];
  $GIOITINH = $_REQUEST['GIOITINH'];
  $TINHTRANG = $_REQUEST['TINHTRANG'];
  $THONGTIN = $_REQUEST['THONGTIN'];


 
    $sql = "INSERT INTO `patients` 
    ( `TENBENHNHAN`, `PHONG`, `NGAYNHAPVIEN`,`GIOITINH`, `TINHTRANG`,`THONGTIN`)
    VALUES
    ('$TENBENHNHAN','$PHONG','$NGAYNHAPVIEN','$GIOITINH','$TINHTRANG','$THONGTIN')";
    //Thuc hien truy van
    $conn->exec($sql);

 
    echo '<script>';
    echo 'alert("Thêm Bệnh Nhân thành công");';
    echo 'window.location.href = "index.php";';
    echo '</script>';
    exit; 


    
}

?>
<?php
include '../include/header.php';
include '../include/sidebar.php';

?>
<!-- End of Sidebar -->
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

    <h2>THÊM Bệnh Nhân</h2>



    <form action="" method="POST">
      <label for="fname">Tên thành viên</label><br>
      <input type="text" name="TENBENHNHAN" required><br>
    

      <label for="lname">Phòng</label><br>
      <select name="PHONG">
      <option value="">-Chọn Phòng-</option>
      <option value="Phòng Hồi Sức">Phòng Hồi Sức</option>
      <option value="Phòng Cấp Cứu">Phòng Cấp Cứu</option>
      <option value="Phòng Khám">Phòng Khám</option>
      <!-- Thêm các option khác tương ứng với danh sách các phòng -->
    </select>
     
    <label for="lname">Ngày nhập viện</label><br>
    <input type="date" name="NGAYNHAPVIEN" value="<?php echo date('Y-m-d'); ?>" required><br><br>
   
      <label for="lname">giới tính</label><br>
      <select name="GIOITINH">
      <option value="">-Chọn giới tính-</option>
      <option value="Nam">Nam </option>
      <option value="Nữ">Nữ </option>
      
      <!-- Thêm các option khác tương ứng với danh sách các phòng -->
    </select>

    <label for="lname">Tình trạng</label><br>
      <select name="TINHTRANG">
      <option value="">-Chọn tình trạng-</option>
      <option value="Nhẹ">nhẹ</option>
      <option value="Bình Thường">bình thường 2</option>
      <option value="Nguy Hiểm">nguy hiểm</option>
      <!-- Thêm các option khác tương ứng với danh sách các phòng -->
    </select>




      <label for="lname">Thông Tin bệnh nhân</label><br>
      <input type="text" name="THONGTIN" required><br><br>
     
      <input type="submit" value="Thêm Bệnh Nhân">
    <a href="index.php" class="btn btn-secondary" style="background-color: #45a049;">Thoát</a>

    </form>
    



  </div>
  <!-- End of Main Content -->

  <!-- Footer -->
  <?php
  include '../include/footer.php';

  ?>
  <!-- End of Footer -->