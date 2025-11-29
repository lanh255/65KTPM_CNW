<?php
require_once 'db.php';

// Lấy danh sách hoa từ DB
$flowers = $pdo->query("SELECT * FROM flowers ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Các loài hoa</title>
<style>
body{font-family:Arial; padding:20px; background:#f5f7fa;}
.container{max-width:1000px; margin:0 auto;}
.flower-frame{background:white; border-radius:15px; padding:20px; margin-bottom:30px; box-shadow:0 5px 15px rgba(0,0,0,0.1);}
.flower-name{font-size:24px; color:#e74c3c; font-weight:bold; text-align:center; margin-bottom:15px;}
.flower-description{line-height:1.6; color:#555; margin-bottom:15px;}
.flower-image{width:100%; max-width:600px; display:block; margin:10px auto; border-radius:10px;}
</style>
</head>
<body>
<div class="container">
<?php foreach ($flowers as $f): ?>
<div class="flower-frame">
    <h2 class="flower-name"><?php echo htmlspecialchars($f['name']); ?></h2>
    <div class="flower-description"><?php echo nl2br(htmlspecialchars($f['description'])); ?></div>
    
    <?php 
    // Hiển thị ảnh, loại bỏ khoảng trắng, chỉ hiện nếu file tồn tại
    $imgs = explode(',', $f['images']);
    foreach ($imgs as $img): 
        $img = trim($img);
        if($img && file_exists('images/'.$img)):
    ?>
        <img src="images/<?php echo htmlspecialchars($img); ?>" class="flower-image">
    <?php 
        endif;
    endforeach; 
    ?>
</div>
<?php endforeach; ?>
</div>
</body>
</html>
