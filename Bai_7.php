<?php
// BƯỚC 1: Tạo mảng $students gồm 3 sinh viên với name, midterm, final
$students = [
    ['name' => 'Nguyễn Văn An', 'midterm' => 8.0, 'final' => 9.0],
    ['name' => 'Trần Thị Bình', 'midterm' => 5.5, 'final' => 4.0],
    ['name' => 'Lê Hoàng Chi', 'midterm' => 6.0, 'final' => 7.5],
    ['name' => 'Phạm Dũng', 'midterm' => 9.0, 'final' => 10.0]
];

// BƯỚC 2: Viết hàm calculateAverage() tính điểm trung bình
function calculateAverage(float $midterm, float $final): float {
    $avg = ($midterm * 0.4) + ($final * 0.6);
    return round($avg, 2);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 7: Bảng điểm sinh viên</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            padding: 40px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2 {
            color: #2c3e50;
            text-align: center;
            border-bottom: 2px solid #e67e22;
            padding-bottom: 10px;
        }

        /* CSS cho bảng */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 16px;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #34495e;
            color: white;
            text-transform: uppercase;
            font-size: 14px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* CSS cho nhãn Đạt / Rớt */
        .status-dat {
            color: #27ae60;
            font-weight: bold;
        }

        .status-rot {
            color: #c0392b;
            font-weight: bold;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 25px;
            color: #7f8c8d;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            color: #e67e22;
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
<br>
<br>
<body>

<div class="container">
    <h2>Bảng Điểm Sinh Viên</h2>
    
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Họ và Tên</th>
                <th>Giữa Kỳ</th>
                <th>Cuối Kỳ</th>
                <th>Điểm TB</th>
                <th>Kết Quả</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $stt = 1; 
            // BƯỚC 3: Dùng foreach để in bảng HTML
            foreach ($students as $sv): 
                $diemTB = calculateAverage($sv['midterm'], $sv['final']);
                
                // BƯỚC 4: Thêm cột kết quả: Đạt nếu điểm trung bình >= 5
                $ketQua = ($diemTB >= 5) ? "Đạt" : "Rớt";
                $classKetQua = ($diemTB >= 5) ? "status-dat" : "status-rot";
            ?>
            
            <tr>
                <td><?= $stt++ ?></td>
                
                <!-- BƯỚC 5: Mã hóa tên sinh viên bằng htmlspecialchars() trước khi in -->
                <td style="text-align: left;">
                    <?= htmlspecialchars($sv['name']) ?>
                </td>
                
                <td><?= $sv['midterm'] ?></td>
                <td><?= $sv['final'] ?></td>
                <td><strong><?= $diemTB ?></strong></td>
                <td class="<?= $classKetQua ?>"><?= $ketQua ?></td>
            </tr>
            
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
