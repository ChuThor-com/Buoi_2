<?php
// Hàm rút gọn để mã hóa output (Giống hệt trong ảnh)
function e($v) { 
    return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); 
}

$errors = [];
// Khởi tạo mảng chứa dữ liệu mặc định (Giúp giữ lại dữ liệu khi có lỗi)
$data = ['name' => '', 'email' => '', 'birthday' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Lấy dữ liệu và xóa khoảng trắng thừa
    $data['name'] = trim($_POST['name'] ?? '');
    $data['email'] = trim($_POST['email'] ?? '');
    $data['birthday'] = trim($_POST['birthday'] ?? '');

    // 2. Kiểm tra dữ liệu (Validation)
    if ($data['name'] === '') {
        $errors['name'] = 'Vui lòng nhập họ tên';
    }
    
    // Dùng filter_var để kiểm tra định dạng email chuẩn xác
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email không hợp lệ';
    }
    
    if ($data['birthday'] === '') {
        $errors['birthday'] = 'Vui lòng nhập ngày sinh';
    }

    // 3. Nếu không có lỗi nào -> Chuyển hướng sang trang success.php
    if (!$errors) {
        header('Location: success.php'); 
        exit; // Phải có exit() để dừng code ngay lập tức
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 9: Đăng ký sinh viên</title>
    <style>
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
            border-bottom: 2px solid #8e44ad;
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

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        /* Đổi màu viền đỏ nếu ô đó bị lỗi */
        .has-error input {
            border-color: #e74c3c;
            background-color: #fdf2f2;
        }

        /* CSS cho câu thông báo lỗi */
        .error-msg {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #8e44ad;
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
            background-color: #732d91;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Form Đăng Ký Sinh Viên</h2>

    <form method="POST" action="">
        <!-- Ô nhập Họ Tên -->
        <div class="form-group <?= isset($errors['name']) ? 'has-error' : '' ?>">
            <label>Họ và Tên:</label>
            <!-- Sử dụng hàm e() để giữ lại dữ liệu an toàn -->
            <input type="text" name="name" value="<?= e($data['name']) ?>" placeholder="Nhập họ tên...">
            <?php if (isset($errors['name'])): ?>
                <span class="error-msg"><?= $errors['name'] ?></span>
            <?php endif; ?>
        </div>

        <!-- Ô nhập Email -->
        <div class="form-group <?= isset($errors['email']) ? 'has-error' : '' ?>">
            <label>Email:</label>
            <input type="text" name="email" value="<?= e($data['email']) ?>" placeholder="Nhập email...">
            <?php if (isset($errors['email'])): ?>
                <span class="error-msg"><?= $errors['email'] ?></span>
            <?php endif; ?>
        </div>

        <!-- Ô nhập Ngày sinh -->
        <div class="form-group <?= isset($errors['birthday']) ? 'has-error' : '' ?>">
            <label>Ngày sinh:</label>
            <input type="date" name="birthday" value="<?= e($data['birthday']) ?>">
            <?php if (isset($errors['birthday'])): ?>
                <span class="error-msg"><?= $errors['birthday'] ?></span>
            <?php endif; ?>
        </div>

        <button type="submit">Đăng Ký</button>
    </form>
</div>

</body>
</html>