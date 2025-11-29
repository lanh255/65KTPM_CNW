<?php
require_once 'db.php';

// --- Thêm hoa ---
if (isset($_POST['action']) && $_POST['action'] === 'add') {
    $name = $_POST['name'] ?? '';
    $desc = $_POST['desc'] ?? '';
    $images = $_POST['images'] ?? '';
    if ($name && $desc && $images) {
        $stmt = $pdo->prepare("INSERT INTO flowers (name, description, images) VALUES (:name, :desc, :images)");
        $stmt->execute(['name'=>$name, 'desc'=>$desc, 'images'=>$images]);
        header("Location: admin.php"); exit; // tránh submit lại
    }
}

// --- Sửa hoa ---
if (isset($_POST['action']) && $_POST['action'] === 'edit') {
    $id = (int)$_POST['id'];
    $name = $_POST['name'] ?? '';
    $desc = $_POST['desc'] ?? '';
    $images = $_POST['images'] ?? '';
    $stmt = $pdo->prepare("UPDATE flowers SET name=:name, description=:desc, images=:images WHERE id=:id");
    $stmt->execute(['name'=>$name, 'desc'=>$desc, 'images'=>$images, 'id'=>$id]);
    header("Location: admin.php"); exit;
}

// --- Xóa hoa ---
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM flowers WHERE id=:id");
    $stmt->execute(['id'=>$id]);
    header("Location: admin.php"); exit;
}

// --- Lấy danh sách hoa ---
$flowers = $pdo->query("SELECT * FROM flowers ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Admin CRUD Hoa</title>
<style>
body{font-family:Arial; padding:20px; background:#f5f7fa;}
.container{max-width:1200px; margin:0 auto;}
form, table{background:white; padding:20px; border-radius:10px; margin-bottom:30px; box-shadow:0 5px 15px rgba(0,0,0,0.1);}
input, textarea{width:100%; padding:10px; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;}
.btn{padding:8px 15px; border:none; border-radius:5px; cursor:pointer;}
.btn-success{background:#27ae60; color:white;}
.btn-warning{background:#f39c12; color:white;}
.btn-danger{background:#e74c3c; color:white;}
.flower-image{width:80px; height:80px; object-fit:cover; margin:2px;}
</style>
</head>
<body>
<div class="container">

<h2>Thêm hoa mới</h2>
<form method="POST">
<input type="hidden" name="action" value="add">
<input type="text" name="name" placeholder="Tên hoa" required>
<textarea name="desc" placeholder="Mô tả" required></textarea>
<input type="text" name="images" placeholder="Ảnh (cách nhau bằng , )" required>
<button type="submit" class="btn btn-success">Thêm</button>
</form>

<h2>Danh sách hoa</h2>
<table border="1" width="100%" cellpadding="5">
<tr>
<th>ID</th>
<th>Tên hoa</th>
<th>Mô tả</th>
<th>Ảnh</th>
<th>Thao tác</th>
</tr>
<?php foreach ($flowers as $f): ?>
<tr>
<td><?php echo $f['id']; ?></td>
<td><?php echo htmlspecialchars($f['name']); ?></td>
<td><?php echo htmlspecialchars($f['description']); ?></td>
<td>
<?php 
$imgs = array_map('trim', explode(',', $f['images'])); // chuyển CSV thành mảng
foreach ($imgs as $img): 
?>
    <img src="images/<?php echo htmlspecialchars($img); ?>" class="flower-image">
<?php endforeach; ?>
</td>
<td>
<!-- Form sửa -->
<form method="POST" style="display:inline-block; margin-bottom:5px;">
<input type="hidden" name="action" value="edit">
<input type="hidden" name="id" value="<?php echo $f['id']; ?>">
<input type="text" name="name" value="<?php echo htmlspecialchars($f['name']); ?>" required>
<input type="text" name="desc" value="<?php echo htmlspecialchars($f['description']); ?>" required>
<input type="text" name="images" value="<?php echo htmlspecialchars($f['images']); ?>" required>
<button type="submit" class="btn btn-warning">Sửa</button>
</form>

<!-- Xóa -->
<a href="?delete=<?php echo $f['id']; ?>" class="btn btn-danger" onclick="return confirm('Xóa hoa này?')">Xóa</a>
</td>
</tr>
<?php endforeach; ?>
</table>

</div>
</body>
</html>
