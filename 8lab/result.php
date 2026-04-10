<?php
header("Content-Type: text/html; charset=UTF-8");

error_reporting(E_ALL);
ini_set('display_errors', 1);

function analyze($text)
{
    // Перекодируем (как у тебя было)
    $text = iconv("UTF-8", "CP1251//IGNORE", $text);

    $length = strlen($text);

    $letters = 0;
    $lower = 0;
    $upper = 0;
    $digits = 0;
    $punct = 0;

    $punct_marks = ['.', ',', '!', '?', ';', ':'];

    $words = [];
    $chars = [];
    $word = '';

    for ($i = 0; $i < strlen($text); $i++) {

        $ch = $text[$i];

        // 🔧 ИСПРАВЛЕНИЕ 1
        $ch_utf = iconv("CP1251", "UTF-8", $ch);
        $ch_lower = strtolower($ch_utf);

        // символы
        if (isset($chars[$ch_lower])) $chars[$ch_lower]++;
        else $chars[$ch_lower] = 1;

        // цифры
        if ($ch >= '0' && $ch <= '9') $digits++;

        // знаки препинания
        if (in_array($ch, $punct_marks)) $punct++;

        // 🔧 ИСПРАВЛЕНИЕ 2 (буквы)
        if (preg_match('/[a-zа-яё]/iu', $ch_utf)) {

            $letters++;

            if (preg_match('/[a-zа-яё]/u', $ch_utf)) $lower++;
            if (preg_match('/[A-ZА-ЯЁ]/u', $ch_utf)) $upper++;

            $word .= $ch;
        } else {
            if ($word != '') {
                $w = strtolower(iconv("CP1251", "UTF-8", $word));
                if (isset($words[$w])) $words[$w]++;
                else $words[$w] = 1;
                $word = '';
            }
        }
    }

    if ($word != '') {
        $w = strtolower(iconv("CP1251", "UTF-8", $word));
        if (isset($words[$w])) $words[$w]++;
        else $words[$w] = 1;
    }

    ksort($words);
    ksort($chars);

    echo "<h3>Информация о тексте</h3>";
    echo "<table border='1'>";
    echo "<tr><td>Символы</td><td>$length</td></tr>";
    echo "<tr><td>Буквы</td><td>$letters</td></tr>";
    echo "<tr><td>Строчные</td><td>$lower</td></tr>";
    echo "<tr><td>Заглавные</td><td>$upper</td></tr>";
    echo "<tr><td>Цифры</td><td>$digits</td></tr>";
    echo "<tr><td>Знаки препинания</td><td>$punct</td></tr>";
    echo "<tr><td>Слова</td><td>" . count($words) . "</td></tr>";
    echo "</table>";

    echo "<h3>Слова:</h3><table border='1'>";
    foreach ($words as $w => $c) {
        echo "<tr><td>$w</td><td>$c</td></tr>";
    }
    echo "</table>";

    echo "<h3>Символы:</h3><table border='1'>";
    foreach ($chars as $c => $n) {
        echo "<tr><td>" . $c . "</td><td>$n</td></tr>";
    }
    echo "</table>";
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Результат</title>
</head>
<body>

<?php
if (isset($_POST['data']) && trim($_POST['data']) != "") {
    echo "<div style='color:blue;font-style:italic'>" . $_POST['data'] . "</div>";
    analyze($_POST['data']);
} else {
    echo "Нет текста для анализа";
}
?>

<a href="index.html">Другой анализ</a>

</body>
</html>