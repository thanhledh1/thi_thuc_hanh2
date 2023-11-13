

<style>
  
  /* Thiết lập bảng */
  table {
    text-align: center;
    width: 100%;
    border-collapse: collapse;
  }

  /* Thiết lập các ô tiêu đề */
  th {
    background-color: #f2f2f2;
    font-weight: bold;
    text-align: left;
    padding: 8px;
    border: 1px solid #ddd;
  }

  /* Thiết lập các ô dữ liệu */
  td {
    padding: 8px;
    border: 1px solid #ddd;
  }

  .pagination {
    display: flex;
    justify-content: center;
    list-style: none;
    padding: 0;
  }

  .pagination a {
    text-decoration: none;
    padding: 8px 16px;
    background-color: #4CAF50;
    color: white;
    margin: 2px;
    border-radius: 4px;
  }

  .pagination a:hover {
    background-color: #45a049;
  }

  .pagination .current {
    background-color: #45a049;
  }

  /* Thiết lập giao diện form tìm kiếm */
  form {
    text-align: center;
    margin: 10px 0;
  }

  form input[type="text"] {
    width: 250px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-right: 10px;
  }

  form button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 8px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  form button[type="submit"]:hover {
    background-color: #45a049;
  }
</style>

<?php

include_once '../db.php';

// Số lượng thành viên trên mỗi trang
$membersPerPage = 5;

// Xác định trang hiện tại
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Tính toán vị trí bắt đầu của dữ liệu
$start = ($page - 1) * $membersPerPage;

// Truy vấn lấy tổng số thành viên
$totalMembers = $conn->query("SELECT COUNT(*) as total FROM `patients`")->fetch()['total'];

// Tính toán tổng số trang
$totalPages = ceil($totalMembers / $membersPerPage);

// Xử lý tìm kiếm
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
if (!empty($searchTerm)) {
  // Thực hiện truy vấn tìm kiếm trong cơ sở dữ liệu
  $searchSql = "SELECT * FROM `patients` WHERE `TENBENHNHAN` LIKE '%$searchTerm%'";
  $searchStmt = $conn->query($searchSql);
  $searchStmt->setFetchMode(PDO::FETCH_ASSOC);
  $rows = $searchStmt->fetchAll();

  // Cập nhật lại số lượng thành viên và số trang sau khi tìm kiếm
  $totalMembers = count($rows);
  $totalPages = ceil($totalMembers / $membersPerPage);
  $start = 0; // Đặt vị trí bắt đầu của dữ liệu về 0
} else {
  // Truy vấn lấy danh sách thành viên với phân trang
  $sql = "SELECT * FROM `patients` LIMIT $start, $membersPerPage";
  $stmt = $conn->query($sql);
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $rows = $stmt->fetchAll();
}

?>

<?php
include '../include/header.php';
include '../include/sidebar.php';
?>

<h2 style="text-align: center;">Danh Sách Bệnh Nhân</h2>
<form method="GET" action="index.php" style="text-align: center;">
  <input type="text" name="search" placeholder="Nhập tên Bệnh Nhân..." value="<?php echo $searchTerm; ?>">
  <button type="submit">Tìm kiếm</button>
</form>





<a class="btn btn-primary" href="http://localhost:3000/members/create.php" role="button">Thêm</a>

<table>
  <tr>
    <th>Mã Bệnh Nhân</th>
    <th>Tên bệnh nhân</th>
    <th>Phòng</th>
    <th>Ngày nhập viện</th>
    <th>Giới tính</th>
    <th>Tình trạng</th>
    <th>Thông tin của bệnh nhân</th>

    <th>HÀNH ĐỘNG</th>
  </tr>

  <?php
  $count = 1; // Khởi tạo biến đếm STT
  foreach ($rows as $r) :
  ?>
    <tr>
      <td><?php echo $count; ?> </td>
      <td><?php echo $r['TENBENHNHAN']; ?> </td>
      <td><?php echo $r['PHONG']; ?> </td>
      <td><?php echo $r['NGAYNHAPVIEN']; ?> </td>
      <td><?php echo $r['GIOITINH']; ?> </td>
      <td><?php echo $r['TINHTRANG']; ?> </td>
      <td><?php echo $r['THONGTIN']; ?> </td>

      <td>
        <a class="btn btn-info" href="edit.php?id=<?php echo $r['id']; ?>" role="button">Sửa</a> |
        <a class="btn btn-danger" href="delete.php?id=<?php echo $r['id']; ?>" onclick="return confirm('Are you sure?');" role="button">Xóa</a>
      </td>
    </tr>
  <?php
    $count++; // Tăng biến đếm STT sau mỗi lần lặp
  endforeach;
  ?>
</table>

<!-- Phân trang -->
<div class="pagination">
  <?php
  for ($i = 1; $i <= $totalPages; $i++) {
    echo '<a ' . ($i == $page ? 'class="current" ' : '') . 'href="index.php?page=' . $i . '">' . $i . '</a>';
  }
  ?>
</div>

<?php
include '../include/footer.php';
?>