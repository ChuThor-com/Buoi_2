<?php
// 1. HÀM KIỂM TRA ĐIỂM HỢP LỆ (0 - 10)
function isValidScore($score) {
    // Kiểm tra phải là số VÀ nằm trong khoảng 0 đến 10
    return is_numeric($score) && $score >= 0 && $score <= 10;
}

// 2. HÀM TÍNH ĐIỂM TỔNG KẾT (10% CC, 30% GK, 60% CK)
function finalScore(float $cc, float $mid, float $final): float {
    $total = ($cc * 0.10) + ($mid * 0.30) + ($final * 0.60);
    return round($total, 2); // Làm tròn 2 chữ số thập phân
}

// 3. HÀM XẾP LOẠI (Từ cao xuống thấp)
function getRank(float $score) {
    if ($score >= 8) {
        return "Giỏi";
    } elseif ($score >= 6.5) {
        return "Khá";
    } elseif ($score >= 5) {
        return "Trung bình";
    } else {
        return "Chưa đạt";
    }
}

// --- KHỞI TẠO BIẾN ---
$hoTen = "";
$cc = "";
$gk = "";
$ck = "";

$ketQua = "";
$loi = [];
$isSuccess = false;

// 4. XỬ LÝ DỮ LIỆU KHI GỬI FORM (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu (Giữ lại dữ liệu - Sticky Form)
    $hoTen = trim($_POST['ho_ten'] ?? '');
    $cc = trim($_POST['cc'] ?? '');
    $gk = trim($_POST['gk'] ?? '');
    $ck = trim($_POST['ck'] ?? '');

    // Kiểm tra họ tên
    if (empty($hoTen)) {
        $loi[] = "Vui lòng nhập họ tên.";
    }

    // Kiểm tra điểm hợp lệ
    if (!isValidScore($cc)) {
        $loi[] = "Điểm chuyên cần không hợp lệ (Phải là số từ 0-10).";
    }
    if (!isValidScore($gk)) {
        $loi[] = "Điểm giữa kỳ không hợp lệ (Phải là số từ 0-10).";
    }
    if (!isValidScore($ck)) {
        $loi[] = "Điểm cuối kỳ không hợp lệ (Phải là số từ 0-10).";
    }

    // Nếu không có lỗi thì tiến hành tính toán
    if (empty($loi)) {
        $diemTK = finalScore((float)$cc, (float)$gk, (float)$ck);
        $xepLoai = getRank($diemTK);
        $isSuccess = true;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 8: Máy tính điểm học phần</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #eef2f5;
            padding: 40px;
        }

        .container {
            max-width: 550px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        h2 {
            color: #2c3e50;
            text-align: center;
            border-bottom: 2px solid #e74c3c;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #34495e;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input:focus {
            border-color: #e74c3c;
            outline: none;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 10px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-top: 15px;
            transition: 0.3s;
        }

        button:hover {
            background-color: #c0392b;
        }

        /* CSS cho thông báo lỗi */
        .error-box {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .error-box ul {
            margin: 0;
            padding-left: 20px;
        }

        /* CSS cho phần kết quả */
        .result-box {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 16px;
            line-height: 1.6;
        }

        .result-box strong {
            font-size: 1.2em;
            color: #c0392b;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 25px;
            color: #7f8c8d;
            text-decoration: none;
        }
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
    <h2>Máy Tính Điểm Học Phần</h2>

    <!-- HIỂN THỊ LỖI NẾU CÓ -->
    <?php if (!empty($loi)): ?>
        <div class="error-box">
            <strong>Có lỗi xảy ra:</strong>
            <ul>
                <?php foreach ($loi as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- FORM NHẬP LIỆU -->
    <form method="POST" action="">
        <div class="form-group">
            <label>Họ và Tên:</label>
            <!-- Giữ lại dữ liệu cũ bằng hàm htmlspecialchars -->
            <input type="text" name="ho_ten" value="<?= htmlspecialchars($hoTen) ?>" placeholder="Nhập họ tên...">
        </div>

        <div class="grid-3">
            <div class="form-group">
                <label>Chuyên cần (10%):</label>
                <input type="number" step="0.1" name="cc" value="<?= htmlspecialchars($cc) ?>" placeholder="0 - 10">
            </div>
            <div class="form-group">
                <label>Giữa kỳ (30%):</label>
                <input type="number" step="0.1" name="gk" value="<?= htmlspecialchars($gk) ?>" placeholder="0 - 10">
            </div>
            <div class="form-group">
                <label>Cuối kỳ (60%):</label>
                <input type="number" step="0.1" name="ck" value="<?= htmlspecialchars($ck) ?>" placeholder="0 - 10">
            </div>
        </div>

        <button type="submit">Tính Điểm</button>
    </form>

    <!-- HIỂN THỊ KẾT QUẢ NẾU THÀNH CÔNG -->
    <?php if ($isSuccess): ?>
        <div class="result-box">
            Sinh viên: <strong><?= htmlspecialchars($hoTen) ?></strong><br>
            Điểm tổng kết: <strong><?= $diemTK ?></strong> điểm<br>
            Xếp loại: <strong><?= $xepLoai ?></strong>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
