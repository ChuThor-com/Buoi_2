<?php
/**
 * HÀM TÍNH ĐIỂM TỔNG KẾT
 * Hàm nhận vào 3 tham số kiểu float và trả về kiểu float.
 */
function finalScore(float $cc, float $mid, float $final): float 
{
    // Công thức: 10% chuyên cần, 30% giữa kỳ, 60% cuối kỳ
    $total = $cc * 0.10 + $mid * 0.30 + $final * 0.60;
    
    // Dùng round() để làm tròn đến 2 chữ số thập phân cho đẹp
    return round($total, 2);
}

$ketQua = "";
$loi = "";

// XỬ LÝ DỮ LIỆU TỪ FORM POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu (nếu để trống thì gán bằng 0 để tránh lỗi)
    $cc = isset($_POST['cc']) ? (float)$_POST['cc'] : 0;
    $mid = isset($_POST['mid']) ? (float)$_POST['mid'] : 0;
    $final = isset($_POST['final']) ? (float)$_POST['final'] : 0;

    // Kiểm tra tính hợp lệ (điểm phải từ 0 đến 10)
    if ($cc < 0 || $cc > 10 || $mid < 0 || $mid > 10 || $final < 0 || $final > 10) {
        $loi = "Điểm nhập vào không hợp lệ. Vui lòng nhập từ 0 đến 10.";
    } else {
        // Gọi hàm tính toán
        $diemTongKet = finalScore($cc, $mid, $final);
        $ketQua = "Điểm tổng kết của bạn là: <strong style='color: #e74c3c; font-size: 1.5em;'>" . $diemTongKet . "</strong> điểm.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 4: Tính điểm tổng kết</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; padding: 40px; }
        .container { max-width: 500px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h2 { color: #2c3e50; text-align: center; border-bottom: 2px solid #1abc9c; padding-bottom: 10px; }
        
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #34495e; }
        input[type="number"] { width: 100%; padding: 10px; border: 1px solid #bdc3c7; border-radius: 5px; box-sizing: border-box; font-size: 16px; }
        input[type="number"]:focus { border-color: #1abc9c; outline: none; }
        
        button { width: 100%; padding: 12px; background-color: #1abc9c; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold; margin-top: 10px; transition: 0.3s; }
        button:hover { background-color: #16a085; }
        
        .alert { padding: 15px; margin-top: 20px; border-radius: 5px; text-align: center; }
        .success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        
        .back-link { display: block; text-align: center; margin-top: 25px; color: #7f8c8d; text-decoration: none; font-size: 14px;}
        .back-link:hover { color: #1abc9c; text-decoration: underline; }
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
    <h2>Bài 4: Tính Điểm Tổng Kết</h2>
    <p style="text-align: center; font-size: 14px; color: #7f8c8d;">(Tỉ lệ: Chuyên cần 10% - Giữa kỳ 30% - Cuối kỳ 60%)</p>
    
    <form method="POST" action="">
        <div class="form-group">
            <label for="cc">Điểm Chuyên Cần:</label>
            <input type="number" step="0.1" min="0" max="10" id="cc" name="cc" placeholder="VD: 8.5" required>
        </div>
        <div class="form-group">
            <label for="mid">Điểm Giữa Kỳ:</label>
            <input type="number" step="0.1" min="0" max="10" id="mid" name="mid" placeholder="VD: 7.0" required>
        </div>
        <div class="form-group">
            <label for="final">Điểm Cuối Kỳ:</label>
            <input type="number" step="0.1" min="0" max="10" id="final" name="final" placeholder="VD: 9.0" required>
        </div>
        <button type="submit">Tính Điểm</button>
    </form>

    <?php if ($loi !== ""): ?>
        <div class="alert error"><?php echo $loi; ?></div>
    <?php endif; ?>

    <?php if ($ketQua !== ""): ?>
        <div class="alert success"><?php echo $ketQua; ?></div>
    <?php endif; ?>
</body>
</html>
