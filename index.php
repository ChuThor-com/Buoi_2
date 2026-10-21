<?php
// 1. VIẾT HÀM NHỎ: Tách logic kiểm tra ra riêng cho rõ ràng
function kiemTraDiem($diem) {
    // - is_numeric(): Kiểm tra xem dữ liệu nhập vào có phải là số (nguyên hoặc thực) không.
    // - Sử dụng toán tử logic && (VÀ) kết hợp các điều kiện: Lớn hơn hoặc bằng 0 VÀ nhỏ hơn hoặc bằng 10.
    if (is_numeric($diem) && $diem >= 0 && $diem <= 10) {
        return true;
    }
    return false;
}

// Khởi tạo biến để lưu trữ kết quả
$thongBao = "";
$diemNhap = "";
$trangThai = ""; // Dùng để đổi màu xanh/đỏ cho thông báo

// 2. ĐỌC DỮ LIỆU TỪ POST
// Kiểm tra xem người dùng đã bấm nút Submit (gửi form) chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ ô input có name="diem". Dùng trim() để xóa khoảng trắng thừa 2 đầu.
    $diemNhap = trim($_POST['diem']);

    // 3. GỌI HÀM VÀ XỬ LÝ KẾT QUẢ
    if (kiemTraDiem($diemNhap)) {
        $thongBao = "Điểm <strong>" . htmlspecialchars($diemNhap) . "</strong> là HỢP LỆ.";
        $trangThai = "success";
    } else {
        $thongBao = "Điểm <strong>" . htmlspecialchars($diemNhap) . "</strong> KHÔNG HỢP LỆ. (Yêu cầu: Phải là số từ 0 đến 10).";
        $trangThai = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 1: Kiểm tra điểm</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; padding: 40px; }
        .container { max-width: 500px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h2 { color: #2c3e50; text-align: center; border-bottom: 2px solid #3498db; padding-bottom: 10px; }
        
        .form-group { margin-bottom: 20px; margin-top: 20px;}
        label { display: block; margin-bottom: 8px; font-weight: bold; color: #34495e;}
        input[type="text"] { width: 100%; padding: 12px; border: 1px solid #bdc3c7; border-radius: 5px; box-sizing: border-box; font-size: 16px; }
        input[type="text"]:focus { border-color: #3498db; outline: none; }
        
        button { width: 100%; padding: 12px; background-color: #3498db; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold; transition: 0.3s; }
        button:hover { background-color: #2980b9; }
        
        /* CSS cho thông báo */
        .alert { padding: 15px; margin-top: 20px; border-radius: 5px; text-align: center; font-size: 16px;}
        .success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        
        .back-link { display: block; text-align: center; margin-top: 25px; color: #7f8c8d; text-decoration: none; font-size: 14px;}
        .back-link:hover { color: #3498db; text-decoration: underline; }
        
    </style>
</head>
<a href="index.php">Bài 1</a>
<a href="Bai_2.php">Bài 2</a>
<a href="Bai_3.php">Bài 3</a>
<a href="Bai_4.php">Bài 4</a>
<a href="Bai_5.php">Bài 5</a>
<a href="Bai_6.php">Bài 6</a>
<a href="Bai_7.php">Bài 7</a>
<a href="Bai_8.php">Bài 8</a>
<a href="bai9">Bài 9</a>
<a href="bai10">Bài 10</a>
<body>

<div class="container">
    <h2>Bài 1: Kiểm Tra Điểm</h2>
    
    <!-- Form gửi dữ liệu bằng phương thức POST -->
    <form method="POST" action="">
        <div class="form-group">
            <label for="diem">Nhập điểm của bạn (từ 0 đến 10):</label>
            <!-- Giữ lại giá trị vừa nhập bằng hàm htmlspecialchars để bảo mật -->
            <input type="text" id="diem" name="diem" value="<?php echo htmlspecialchars($diemNhap); ?>" placeholder="Ví dụ: 8.5" required>
        </div>
        <button type="submit">Kiểm Tra Kết Quả</button>
    </form>

    <!-- Hiển thị thông báo kết quả nếu có dữ liệu gửi lên -->
    <?php if ($thongBao !== ""): ?>
        <div class="alert <?php echo $trangThai; ?>">
            <?php echo $thongBao; ?>
        </div>
    <?php endif; ?>

</body>
</html>