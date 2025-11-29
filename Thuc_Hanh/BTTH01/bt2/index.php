<?php
session_start();

// Đọc file dữ liệu
$filename = "Quiz.txt";
if (!file_exists($filename)) {
    die("File dữ liệu không tồn tại!");
}

$lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

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
    } elseif (preg_match('/^[A-D]\./', $line)) {
        $currentQ['options'][] = $line;
    } elseif (strpos($line, 'ANSWER:') === 0) {
        $currentQ['answer'] = trim(substr($line, 7));
    }
}
if ($currentQ) $questions[] = $currentQ;

// Xử lý form submit
$score = null;
$userAnswers = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($questions as $i => $q) {
        $userAnswers[$i] = $_POST["q$i"] ?? [];
        if (!is_array($userAnswers[$i])) $userAnswers[$i] = [$userAnswers[$i]];
    }

    // Tính điểm
    $score = 0;
    foreach ($questions as $i => $q) {
        $correct = array_map('trim', explode(',', $q['answer']));
        sort($correct);
        $user = array_map('trim', $userAnswers[$i]);
        sort($user);
        if ($correct === $user) $score++;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Bài thi trắc nghiệm Android</title>
<style>
body { font-family: Arial; background: #f5f5f5; padding: 20px; }
.container { max-width: 900px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);}
h1 { text-align: center; color: #e74c3c; margin-bottom: 20px;}
.question { margin-bottom: 25px; padding: 15px; border: 1px solid #ccc; border-radius: 8px; background: #f9f9f9; }
.options { margin-top: 10px; }
.options label { display: block; margin-bottom: 5px; cursor: pointer; }
.score { font-size: 20px; text-align: center; margin-bottom: 20px; color: #27ae60; }
button { padding: 10px 20px; font-size: 16px; border: none; border-radius: 5px; background: #e74c3c; color: white; cursor: pointer; }
</style>
</head>
<body>
<div class="container">
<h1>Bài thi trắc nghiệm Android</h1>

<?php if ($score !== null): ?>
    <div class="score">Bạn đạt <?php echo $score; ?> / <?php echo count($questions); ?> điểm</div>
<?php endif; ?>

<form method="POST">
<?php foreach ($questions as $index => $q): ?>
<div class="question">
    <div><strong>Câu <?php echo $index + 1; ?>:</strong> <?php echo htmlspecialchars($q['question']); ?></div>
    <div class="options">
        <?php 
        $isMultiple = strpos($q['answer'], ',') !== false; // nhiều đáp án thì dùng checkbox
        foreach ($q['options'] as $opt):
            $letter = substr($opt,0,1);
            $checked = '';
            if (isset($userAnswers[$index]) && in_array($letter, $userAnswers[$index])) $checked = 'checked';
        ?>
            <label>
                <input type="<?php echo $isMultiple ? 'checkbox' : 'radio'; ?>" 
                       name="q<?php echo $index; ?><?php echo $isMultiple ? '[]' : ''; ?>" 
                       value="<?php echo $letter; ?>" <?php echo $checked; ?>>
                <?php echo htmlspecialchars($opt); ?>
            </label>
        <?php endforeach; ?>
    </div>
</div>
<?php endforeach; ?>

<button type="submit">Nộp bài</button>
</form>

</div>
</body>
</html>
