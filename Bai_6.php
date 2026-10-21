<?php
// 1. HÀM ĐỊNH DẠNG TIỀN (Trả về string kèm chữ 'đ')
function money(float $value): string {
    return number_format($value, 0, ',', '.') . ' đ';
}

// 2. ĐỌC DỮ LIỆU TỪ POST
$name  = $_POST['name'] ?? '';
$qty   = (int)($_POST['qty'] ?? 0);
$price = (float)($_POST['price'] ?? 0);

// 3. TÍNH THÀNH TIỀN
$total = $qty * $price;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 6: Hóa đơn học liệu</title>
    <style>
        /* CSS CƠ BẢN */
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f4f7f6; 
            padding: 40px; 
        }
        .container { 
            max-width: 500px; 
            margin: 0 auto; 
            background: white; 
            padding: 30px; 
            border-radius: 10px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
        }
        h2 { 
            color: #2c3e50; 
            text-align: center; 
            border-bottom: 2px solid #3498db; 
            padding-bottom: 10px; 
            margin-bottom: 25px;
        }
        
        /* CSS CHO FORM (CHUYỂN SANG DẠNG CỘT) */
        form { 
            display: flex; 
            flex-direction: column; /* Cho các ô nhập xếp dọc xuống */
            gap: 15px; /* Khoảng cách giữa các ô */
            margin-bottom: 25px; 
        }
        
        /* CSS CHO Ô NHẬP LIỆU */
        input { 
            padding: 12px 15px; 
            border: 1px solid #bdc3c7; 
            border-radius: 5px; 
            font-size: 16px; 
            width: 100%;
            box-sizing: border-box; /* Đảm bảo padding không làm vỡ khung */
        }
        input:focus { 
            border-color: #3498db; 
            outline: none; 
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }
        
        /* CSS CHO NÚT BẤM */
        button { 
            padding: 12px; 
            background-color: #3498db; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            font-weight: bold; 
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover { 
            background-color: #2980b9; 
        }
        
        /* CSS CHO PHẦN KẾT QUẢ */
        .result { 
            padding: 20px; 
            background-color: #e8f4f8; 
            border-left: 5px solid #3498db; 
            font-size: 18px; 
            font-family: 'Times New Roman', Times, serif; 
            border-radius: 0 5px 5px 0;
        }
        
        .back-link { 
            display: block; 
            text-align: center; 
            margin-top: 30px; 
            color: #7f8c8d; 
            text-decoration: none; 
            font-size: 15px;
        }
        .back-link:hover { 
            color: #3498db; 
            text-decoration: underline; 
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
    <h2>Hóa Đơn Học Liệu</h2>

    <!-- Form nhập liệu -->
    <form method="POST" action="">
        <input name="name" placeholder="Tên tài liệu" value="<?= htmlspecialchars($name) ?>" required>
        
        <input name="qty" type="number" min="1" placeholder="Số lượng" value="<?= $qty > 0 ? $qty : '' ?>" required>
        
        <input name="price" type="number" min="0" step="1000" placeholder="Đơn giá (VD: 20000)" value="<?= $price > 0 ? $price : '' ?>" required>
        
        <button type="submit">Tính Thành Tiền</button>
    </form>

    <!-- Hiển thị kết quả -->
    <?php if ($total > 0): ?>
        <div class="result">
            <!-- In kết quả -->
            <?= htmlspecialchars($name) ?>: <strong><?= money($total) ?></strong>
        </div>
    <?php endif; ?>

</body>
</html>
