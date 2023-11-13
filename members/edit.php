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
include_once '../db.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 0;
}

$id = isset($_GET['id']) ? $_GET['id'] : 0;

if (!$id) {
    header("Location: index.php");
}
$sql = "SELECT * FROM `patients` WHERE id  = $id";
$stmt = $conn->query($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
// Lấy dữ liệu duy nhất
$row = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $TENBENHNHAN = $_POST['TENBENHNHAN'];
    $PHONG = $_POST['PHONG'];
    $NGAYNHAPVIEN = $_POST['NGAYNHAPVIEN'];
    $GIOITINH = $_POST['GIOITINH'];
    $TINHTRANG = $_POST['TINHTRANG'];
    $THONGTIN = $_POST['THONGTIN'];

    $sql = "UPDATE `patients` SET 
        `TENBENHNHAN` = '$TENBENHNHAN',
        `PHONG` = '$PHONG',
        `NGAYNHAPVIEN` = '$NGAYNHAPVIEN',
        `GIOITINH` = '$GIOITINH',
        `TINHTRANG` = '$TINHTRANG',
        `THONGTIN` = '$THONGTIN'
        WHERE `id` = $id";

    $conn->exec($sql);

    header("Location: index.php");
}
?>

<?php
include '../include/header.php';
include '../include/sidebar.php';
?>

<h2>EDIT</h2>

<form action="" method="POST">
    <label for="fname">Tên thành viên</label><br>
    <input type="text" name="TENBENHNHAN" required value="<?= $row['TENBENHNHAN']; ?>"><br>

    <label for="lname">Phòng</label><br>
    <select name="PHONG">
        <option value="">-Chọn Phòng-</option>
        <option value="Phòng Hồi Sức" <?= ($row['PHONG'] == 'Phòng Hồi Sức') ? 'selected' : ''; ?>>Phòng Hồi Sức
        </option>
        <option value="Phòng Cấp Cứu" <?= ($row['PHONG'] == 'Phòng Cấp Cứu') ? 'selected' : ''; ?>>Phòng Cấp Cứu
        </option>
        <option value="Phòng Khám" <?= ($row['PHONG'] == 'Phòng Khám') ? 'selected' : ''; ?>>Phòng Khám</option>
        <!-- Thêm các option khác tương ứng với danh sách các phòng -->
    </select>

    <label for="lname">Ngày nhập viện</label><br>
    <input type="date" name="NGAYNHAPVIEN" required value="<?= $row['NGAYNHAPVIEN']; ?>"><br><br>

    <label for="lname">Giới tính</label><br>
<select name="GIOITINH">
        <option value="">-Chọn giới tính-</option>
        <option value="Nam" <?= ($row['GIOITINH'] == 'Nam') ? 'selected' : ''; ?>>Nam</option>
        <option value="Nữ" <?= ($row['GIOITINH'] == 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
        <!-- Thêm các option khác tương ứng với danh sách các giới tính -->
    </select>

    <label for="lname">Tình trạng</label><br>
    <select name="TINHTRANG">
        <option value="">-Chọn tình trạng-</option>
        <option value="Nhẹ" <?= ($row['TINHTRANG'] == 'Nhẹ') ? 'selected' : ''; ?>>Nhẹ</option>
        <option value="Bình Thường" <?= ($row['TINHTRANG'] == 'Bình Thường') ? 'selected' : ''; ?>>Bình Thường</option>
        <option value="Nguy Hiểm" <?= ($row['TINHTRANG'] == 'Nguy Hiểm') ? 'selected' : ''; ?>>Nguy Hiểm</option>
        <!-- Thêm các option khác tương ứng với danh sách các tình trạng -->
    </select>

    <label for="lname">Thông Tin bệnh nhân</label><br>
    <input type="text" name="THONGTIN" required value="<?= $row['THONGTIN']; ?>"><br><br>

    <input type="submit" value="Sửa">
    <a href="index.php" class="btn btn-secondary" style="background-color: #45a049;">Thoát</a>

</form>

<?php
include '../include/footer.php';
?>