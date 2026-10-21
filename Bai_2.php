<?php
// 1. VIẾT HÀM NHỎ: Hàm nhận vào điểm và trả về chuỗi xếp loại
function xepLoaiDiem($diem) {
    // Hướng dẫn: Kiểm tra từ cao xuống thấp (Giỏi -> Khá -> TB -> Yếu)
    if ($diem >= 8) {
        return "Giỏi";
    } elseif ($diem >= 6.5) {
        return "Khá";
    } elseif ($diem >= 5) {
        return "Trung bình";
    } else {
        return "Chưa đạt";
    }
}

$diemNhap = "";
$ketQua = "";
$trangThai = "";

// 2. XỬ LÝ DỮ LIỆU TỪ POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $diemNhap = trim($_POST['diem']);
    
    // Tái sử dụng lại logic kiểm tra điểm hợp lệ (từ 0-10) của Bài 1
    // Việc kiểm tra này rất quan trọng để tránh lỗi khi tính toán xếp loại
    if (is_numeric($diemNhap) && $diemNhap >= 0 && $diemNhap <= 10) {
        $loai = xepLoaiDiem($diemNhap);
        $ketQua = "Với số điểm <strong>" . htmlspecialchars($diemNhap) . "</strong>, bạn được xếp loại: <strong style='font-size: 1.2em; color: #e74c3c;'>" . $loai . "</strong>";
        $trangThai = "success";
    } else {
        $ketQua = "Vui lòng nhập một số hợp lệ từ 0 đến 10!";
        $trangThai = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 2: Xếp loại điểm</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; padding: 40px; }
        .container { max-width: 500px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h2 { color: #2c3e50; text-align: center; border-bottom: 2px solid #e67e22; padding-bottom: 10px; }
        
        .form-group { margin-bottom: 20px; margin-top: 20px;}
        label { display: block; margin-bottom: 8px; font-weight: bold; color: #34495e;}
        input[type="text"] { width: 100%; padding: 12px; border: 1px solid #bdc3c7; border-radius: 5px; box-sizing: border-box; font-size: 16px; }
        input[type="text"]:focus { border-color: #e67e22; outline: none; }
        
        button { width: 100%; padding: 12px; background-color: #e67e22; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold; transition: 0.3s; }
        button:hover { background-color: #d35400; }
        
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
<body>

<div class="container">
    <h2>Bài 2: Xếp Loại Học Lực</h2>
    
    <form method="POST" action="">
        <div class="form-group">
            <label for="diem">Nhập điểm của bạn (0 - 10):</label>
            <input type="text" id="diem" name="diem" value="<?php echo htmlspecialchars($diemNhap); ?>" placeholder="Ví dụ: 7.5" required>
        </div>
        <button type="submit">Xem Xếp Loại</button>
    </form>

    <?php if ($ketQua !== ""): ?>
        <div class="alert <?php echo $trangThai; ?>">
            <?php echo $ketQua; ?>
        </div>
    <?php endif; ?>

    <a href="../index.php" class="back-link">⬅ Quay lại danh sách bài tập</a>
</div>

</body>
</html>