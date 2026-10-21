<?php
// 1. TẠO MẢNG KẾT HỢP (Dữ liệu mô phỏng giống lấy từ CSDL)
// Mỗi phần tử là một mảng con chứa 'name' và 'score'
$students = [
    ['name' => 'Nguyễn Văn An', 'score' => 8.5],
    ['name' => 'Trần Thị Bình', 'score' => 6.5],
    ['name' => 'Lê Hoàng Chi', 'score' => 4.5],

];

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 3: Danh sách sinh viên</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f4f7f6; padding: 40px;
             }
        .container { 
            max-width: 600px; 
            margin: 0 auto; 
            background: white; padding: 30px; 
            border-radius: 10px; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h2 { 
            color: #2c3e50; 
            text-align: center; 
            border-bottom: 2px solid #9b59b6; 
            padding-bottom: 10px; }
        
        /* CSS cho bảng */
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px;
            font-size: 20px; }
        th, td { 
            
            text-align: left; 
            border-bottom: 1px solid #ddd; }
        th { 
            background-color: #9b59b6; 
            color: white; 
            text-transform: uppercase; 
            font-size: 14px; }
        tr:hover { 
            background-color: #f1f1f1; }
        
    
        
        .back-link { display: block; text-align: center; margin-top: 25px; color: #7f8c8d; text-decoration: none; font-size: 14px;}
        .back-link:hover { color: #9b59b6; text-decoration: underline; }
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
    <h2>Bài 3: Danh Sách Sinh Viên</h2>
    
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Họ và Tên</th>
                <th>Điểm</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $stt = 1; // Biến đếm số thứ tự
            // Sử dụng vòng lặp foreach để duyệt mảng kết hợp
            // $student sẽ đại diện cho từng mảng con (chứa name và score)
            foreach ($students as $student): 
                $diem = $student['score'];
               
                
        
            ?>
            
            <tr>
                <td><?php echo $stt++; ?></td>
                <!-- Sử dụng cú pháp mảng: $student['name'] -->
                <td><?php echo htmlspecialchars($student['name']); ?></td>
                <td><?php echo $diem; ?></td>
                <td><span class="badge <?php echo $classMau; ?>"></span></td>
            </tr>
            
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
