<?php
// Hàm rút gọn bảo mật
function e($v) { return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); }

$errors = [];
$isSuccess = false;

// Khởi tạo mảng lưu dữ liệu (Giữ lại dữ liệu khi có lỗi)
$data = [
    'name' => '', 
    'email' => '', 
    'subject' => 'Hỗ trợ kỹ thuật', // Giá trị mặc định
    'message' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. LẤY DỮ LIỆU TỪ FORM
    $data['name'] = trim($_POST['name'] ?? '');
    $data['email'] = trim($_POST['email'] ?? '');
    $data['subject'] = $_POST['subject'] ?? '';
    $data['message'] = trim($_POST['message'] ?? '');

    // 2. KIỂM TRA BẮT BUỘC & ĐỊNH DẠNG
    if ($data['name'] === '') {
        $errors['name'] = 'Vui lòng nhập họ tên';
    }

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email không hợp lệ';
    }

    // Kiểm tra độ dài nội dung (từ 10 đến 500 ký tự)
    $len = mb_strlen($data['message'], 'UTF-8'); // Hàm đếm ký tự có hỗ trợ tiếng Việt
    if ($len < 10 || $len > 500) {
        $errors['message'] = 'Nội dung phải từ 10 đến 500 ký tự (Hiện tại: ' . $len . ' ký tự)';
    }

    // 3. XỬ LÝ UPLOAD ẢNH ĐẠI DIỆN (Kiểm tra bắt buộc thứ 3)
    if (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] == UPLOAD_ERR_NO_FILE) {
        $errors['avatar'] = 'Vui lòng chọn ảnh đại diện';
    } else {
        $file = $_FILES['avatar'];
        // Kiểm tra lỗi hệ thống khi upload
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors['avatar'] = 'Có lỗi xảy ra khi tải ảnh lên.';
        } else {
            // Kiểm tra định dạng file (chỉ cho phép ảnh)
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($file['type'], $allowedTypes)) {
                $errors['avatar'] = 'Chỉ chấp nhận file ảnh (JPG, PNG, GIF).';
            }
            // Giới hạn dung lượng (VD: < 2MB)
            elseif ($file['size'] > 2 * 1024 * 1024) {
                $errors['avatar'] = 'Kích thước ảnh phải nhỏ hơn 2MB.';
            }
        }
    }

    // 4. NẾU KHÔNG CÓ LỖI -> XỬ LÝ LƯU FILE VÀ HIỂN THỊ THÀNH CÔNG
    if (empty($errors)) {
        // Tạo thư mục uploads nếu chưa có
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        // Tạo tên file mới để tránh trùng lặp
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newFileName = time() . '_' . uniqid() . '.' . $ext;
        $uploadPath = $uploadDir . $newFileName;

        // Di chuyển file từ bộ nhớ tạm sang thư mục uploads
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            $isSuccess = true;
        } else {
            $errors['avatar'] = 'Không thể lưu ảnh lên server.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 10: Form liên hệ</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f0f2f5; padding: 40px; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 40px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h2 { color: #2c3e50; text-align: center; margin-top: 0; }
        .sub-title { text-align: center; color: #7f8c8d; font-size: 14px; margin-bottom: 30px; }
        
        .form-group { margin-bottom: 20px; }
        label { display: block; font-weight: bold; margin-bottom: 8px; color: #34495e; font-size: 14px;}
        
        /* CSS cho các ô nhập liệu */
        input[type="text"], input[type="email"], select, textarea { 
            width: 100%; padding: 10px; border: 1px solid #bdc3c7; border-radius: 4px; box-sizing: border-box; font-size: 15px;
        }
        textarea { height: 120px; resize: vertical; }
        
        /* Đổi màu viền khi bị lỗi (giống ảnh mẫu) */
        .has-error input, .has-error textarea, .has-error select { 
            border-color: #e74c3c; background-color: #fff5f5; 
        }
        .error-msg { color: #e74c3c; font-size: 13px; margin-top: 5px; display: block; }
        
        button { width: 100%; padding: 12px; background-color: #2980b9; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold; margin-top: 10px; }
        button:hover { background-color: #1f618d; }

        .success-box { background-color: #d4edda; color: #155724; padding: 20px; border-radius: 5px; text-align: center; border: 1px solid #c3e6cb;}
        .success-box img { max-width: 100px; border-radius: 50%; margin-top: 10px; border: 2px solid #27ae60;}
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
    <h2>Liên hệ</h2>
    <div class="sub-title">Vui lòng nhập đầy đủ thông tin bên dưới.</div>

    <?php if ($isSuccess): ?>
        <div class="success-box">
            <h3>🎉 Gửi liên hệ thành công!</h3>
            <p>Cảm ơn <strong><?= e($data['name']) ?></strong>. Chúng tôi sẽ phản hồi qua email: <?= e($data['email']) ?>.</p>
            <p><strong>Ảnh đại diện của bạn:</strong></p>
            <img src="<?= e($uploadPath) ?>" alt="Avatar">
            <br><br>
            <a href="index.php">Gửi liên hệ khác</a>
        </div>
    <?php else: ?>
        <!-- Phải có enctype="multipart/form-data" thì mới upload được file -->
        <form method="POST" action="" enctype="multipart/form-data">
            
            <div class="form-group <?= isset($errors['name']) ? 'has-error' : '' ?>">
                <label>Họ tên (*)</label>
                <input type="text" name="name" value="<?= e($data['name']) ?>" placeholder="Lê Văn Hào">
                <?php if (isset($errors['name'])): ?><span class="error-msg"><?= $errors['name'] ?></span><?php endif; ?>
            </div>

            <div class="form-group <?= isset($errors['email']) ? 'has-error' : '' ?>">
                <label>Email (*)</label>
                <input type="email" name="email" value="<?= e($data['email']) ?>" placeholder="haovanie@edu.vn">
                <?php if (isset($errors['email'])): ?><span class="error-msg"><?= $errors['email'] ?></span><?php endif; ?>
            </div>

            <div class="form-group">
                <label>Chủ đề</label>
                <select name="subject">
                    <!-- Giữ lại trạng thái đã chọn -->
                    <option value="Hỗ trợ kỹ thuật" <?= $data['subject'] == 'Hỗ trợ kỹ thuật' ? 'selected' : '' ?>>Hỗ trợ kỹ thuật</option>
                    <option value="Góp ý" <?= $data['subject'] == 'Góp ý' ? 'selected' : '' ?>>Góp ý</option>
                    <option value="Khác" <?= $data['subject'] == 'Khác' ? 'selected' : '' ?>>Khác</option>
                </select>
            </div>

            <div class="form-group <?= isset($errors['message']) ? 'has-error' : '' ?>">
                <label>Nội dung (*)</label>
                <textarea name="message" placeholder="Nhập nội dung liên hệ..."><?= e($data['message']) ?></textarea>
                <?php if (isset($errors['message'])): ?><span class="error-msg"><?= $errors['message'] ?></span><?php endif; ?>
            </div>

            <div class="form-group <?= isset($errors['avatar']) ? 'has-error' : '' ?>">
                <label>Ảnh đại diện (*)</label>
                <input type="file" name="avatar" accept="image/*">
                <?php if (isset($errors['avatar'])): ?><span class="error-msg"><?= $errors['avatar'] ?></span><?php endif; ?>
            </div>

            <button type="submit">Gửi liên hệ</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>
