<?php
// HÀM ĐỊNH DẠNG TIỀN TỆ (Thêm dấu chấm phân cách)
// Ví dụ: 200000 -> 200.000
function formatMoney($number) {
    return number_format($number, 0, ',', '.');
}

$hienThiKetQua = false;
$tenTL = "";
$soLuong = 0;
$donGia = 0;
$tongTien = 0;
$loi = "";

// XỬ LÝ KHI BẤM NÚT TÍNH
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tenTL = trim($_POST['ten_tl']);
    $soLuong = (int)$_POST['so_luong']; // Ép kiểu về số nguyên
    $donGia = (float)$_POST['don_gia']; // Ép kiểu về số thực

    // Kiểm tra dữ liệu hợp lệ
    if (empty($tenTL)) {
        $loi = "Vui lòng nhập tên tài liệu.";
    } elseif ($soLuong <= 0 || $donGia <= 0) {
        $loi = "Số lượng và đơn giá phải lớn hơn 0.";
    } else {
        // Tính toán
        $tongTien = $soLuong * $donGia;
        $hienThiKetQua = true;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 5: Tính tiền tài liệu</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f9f9f9; padding: 40px; }
        .container { max-width: 900px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border: 1px solid #ccc; }
        
        /* CSS mô phỏng lại form xám xịt giống trong ảnh */
        .form-row { display: flex; gap: 10px; margin-bottom: 20px; }
        input[type="text"], input[type="number"] { padding: 8px; border: 1px solid #999; border-radius: 3px; flex: 1; font-size: 16px; }
        button { padding: 8px 20px; border: 1px solid #999; background-color: #e0e0e0; cursor: pointer; border-radius: 3px; font-size: 16px; }
        button:hover { background-color: #d0d0d0; }
        
        /* CSS cho phần kết quả */
        .result-box { margin-top: 20px; font-size: 20px; font-family: 'Times New Roman', Times, serif; color: #111; }
        .error { color: red; font-size: 14px; margin-top: 10px; font-family: Arial, sans-serif; }
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
<br><br>
<div class="container">
    <form method="POST" action="">
        <div class="form-row">
            <!-- Ô nhập Tên tài liệu -->
            <input type="text" name="ten_tl" placeholder="Tên tài liệu" value="<?php echo htmlspecialchars($tenTL); ?>" required>
            
            <!-- Ô nhập Số lượng -->
            <input type="number" name="so_luong" placeholder="Số lượng" min="1" value="<?php echo $soLuong > 0 ? $soLuong : ''; ?>" required>
            
            <!-- Ô nhập Đơn giá -->
            <input type="number" name="don_gia" placeholder="Đơn giá" min="1000" step="1000" value="<?php echo $donGia > 0 ? $donGia : ''; ?>" required>
            
            <!-- Nút Tính -->
            <button type="submit">Tính</button>
        </div>
    </form>

    <!-- Hiển thị lỗi nếu có -->
    <?php if ($loi !== ""): ?>
        <div class="error"><?php echo $loi; ?></div>
    <?php endif; ?>

    <!-- Hiển thị kết quả -->
    <?php if ($hienThiKetQua): ?>
        <div class="result-box">
            <?php echo htmlspecialchars($tenTL) . ": " . formatMoney($tongTien) . " đ"; ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
