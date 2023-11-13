<?php
// Kết nối đến cơ sở dữ liệu
$conn = new PDO("classicmodels;dbname=mat_hangs", "ten_nguoi_dung", "mat_khau");

// Lấy từ khóa tìm kiếm từ form
$keyword = $_GET['keyword'];

// Xử lý truy vấn
$sql = "SELECT * FROM mat_hangs WHERE TENHANG LIKE :keyword";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':keyword', '%'.$keyword.'%');
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Hiển thị kết quả
foreach ($results as $row) {
  // Hiển thị thông tin từng kết quả tìm kiếm
  echo $row['TENHANG'];
  // ...
}
?>