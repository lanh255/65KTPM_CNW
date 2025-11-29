<?php
$conn = new mysqli("localhost", "root", "", "quiz_db");
$conn->set_charset("utf8mb4");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['quizfile']) || $_FILES['quizfile']['error'] != 0) {
        die("Vui lòng chọn file TXT!");
    }

    // Load file
    $tmp = $_FILES['quizfile']['tmp_name'];
    $lines = file($tmp, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $questions = [];
    $currentQ = null;

    foreach ($lines as $line) {
        $line = trim($line);

        if (!preg_match('/^[A-D]\./', $line) && strpos($line, 'ANSWER:') === false) {
            if ($currentQ) $questions[] = $currentQ;
            $currentQ = [
                'question' => $line,
                'options' => [],
                'answer' => ''
            ];
        }
        elseif (preg_match('/^[A-D]\./', $line)) {
            $currentQ['options'][] = $line;
        }
        elseif (strpos($line, 'ANSWER:') === 0) {
            $currentQ['answer'] = trim(substr($line, 7));
        }
    }

    if ($currentQ) $questions[] = $currentQ;

    // Lưu vào CSDL
    foreach ($questions as $q) {
        $A = $q['options'][0] ?? "";
        $B = $q['options'][1] ?? "";
        $C = $q['options'][2] ?? "";
        $D = $q['options'][3] ?? "";

        $stmt = $conn->prepare("
            INSERT INTO questions(question, option_a, option_b, option_c, option_d, answer)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("ssssss",
            $q['question'], $A, $B, $C, $D, $q['answer']
        );
        $stmt->execute();
    }

    echo "<h2>✔ Upload & lưu dữ liệu thành công!</h2>";
}
?>

<!DOCTYPE html>
<html lang='vi'>
<head>
<meta charset='UTF-8'>
<title>Upload file Quiz</title>
</head>
<body>

<h1>Upload file mẫu Quiz (.txt)</h1>
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="quizfile" accept=".txt" required>
    <button type="submit">Tải lên & Lưu dữ liệu</button>
</form>

</body>
</html>
