<?php
include 'db.php';

$rows = [];
$message = '';

if (isset($_FILES["csvfile"]) && $_FILES["csvfile"]["error"] === UPLOAD_ERR_OK) {
    $file = fopen($_FILES["csvfile"]["tmp_name"], "r");

    // Đọc từng dòng CSV vào mảng
    while (($data = fgetcsv($file, 1000, ",")) !== false) {
        $rows[] = $data;
    }
    fclose($file);

    if (!empty($rows)) {
        // Bỏ dòng tiêu đề
        for ($i = 1; $i < count($rows); $i++) {
            $row = $rows[$i];

            $stmt = $pdo->prepare("INSERT INTO csv_data 
                (username, password, lastname, firstname, city, email, course1) 
                VALUES (:username, :password, :lastname, :firstname, :city, :email, :course1)");

            $stmt->execute([
                ':username' => $row[0] ?? '',
                ':password' => $row[1] ?? '',
                ':lastname' => $row[2] ?? '',
                ':firstname' => $row[3] ?? '',
                ':city'     => $row[4] ?? '',
                ':email'    => $row[5] ?? '',
                ':course1'  => $row[6] ?? '',
            ]);
        }

        $message = "Tải file thành công! Đã lưu " . (count($rows) - 1) . " dòng dữ liệu vào CSDL.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Upload & Lưu CSV vào CSDL</title>
<style>
    body { font-family: Arial; margin: 20px; }
    table { border-collapse: collapse; width: 100%; margin-top: 20px; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background: #f0f0f0; }
</style>
</head>
<body>

<h2>Upload file CSV và Lưu dữ liệu vào MySQL</h2>

<?php if ($message): ?>
<p style="color:green;"><?= $message ?></p>
<?php endif; ?>

<!-- Form Upload -->
<form method="POST" enctype="multipart/form-data">
    <label>Chọn tệp CSV:</label>
    <input type="file" name="csvfile" accept=".csv" required>
    <button type="submit">Upload & Lưu</button>
</form>

<!-- Hiển thị nội dung CSV -->
<?php if (!empty($rows)): ?>
    <h3>Nội dung file CSV:</h3>
    <table>
        <thead>
            <tr>
                <?php foreach ($rows[0] as $header): ?>
                    <th><?= htmlspecialchars($header) ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 1; $i < count($rows); $i++): ?>
                <tr>
                    <?php foreach ($rows[$i] as $cell): ?>
                        <td><?= htmlspecialchars($cell) ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
<?php endif; ?>

</body>
</html>
