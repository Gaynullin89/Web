<?php

function randVal()
{
    return mt_rand(1, 100);
}

$isPost = isset($_POST['A']);
$view = $_POST['VIEW'] ?? ($_GET['VIEW'] ?? 'browser');

if ($isPost) {

    $fio = $_POST['FIO'];
    $group = $_POST['GROUP'];
    $about = $_POST['ABOUT'];
    $task = $_POST['TASK'];

    $A = floatval(str_replace(',', '.', $_POST['A']));
    $B = floatval(str_replace(',', '.', $_POST['B']));
    $C = floatval(str_replace(',', '.', $_POST['C']));

    $user_result = $_POST['RESULT'];

    switch ($task) {

        case 'mean':
            $result = round(($A + $B + $C) / 3, 2);
            $task_name = "Среднее арифметическое";
            break;

        case 'perimeter':
            $result = $A + $B + $C;
            $task_name = "Периметр треугольника";
            break;

        case 'area':
            if ($A + $B > $C && $A + $C > $B && $B + $C > $A) {
                $p = ($A + $B + $C) / 2;
                $result = round(sqrt($p * ($p - $A) * ($p - $B) * ($p - $C)), 2);
            } else {
                $result = "Ошибка: треугольник не существует";
            }
            $task_name = "Площадь треугольника";
            break;

        case 'volume':
            $result = $A * $B * $C;
            $task_name = "Объем параллелепипеда";
            break;

        case 'max':
            $result = max($A, $B, $C);
            $task_name = "Максимум";
            break;

        case 'min':
            $result = min($A, $B, $C);
            $task_name = "Минимум";
            break;
    }

    if (!is_numeric($result)) {
        $check = $result;
    } elseif ($user_result === "") {
        $check = "Задача самостоятельно не решена";
    } else {
        $user_val = floatval(str_replace(',', '.', $user_result));
        $epsilon = 0.05;
        if (abs($user_val - $result) <= $epsilon) {
            $check = "Тест пройден";
        } else {
            $check = "Ошибка: тест не пройден";
        }
    }

    $out = "";
    $out .= "ФИО: $fio<br>";
    $out .= "Группа: $group<br><br>";
    if ($about) $out .= "О себе: $about<br><br>";
    $out .= "Задача: $task_name<br>";
    $out .= "A = $A, B = $B, C = $C<br>";
    $out .= "Ваш ответ: $user_result<br>";
    $out .= "Правильный ответ: $result<br><br>";
    $out .= "<b>$check</b><br>";

    if (isset($_POST['send_mail'])) {
        $mail = $_POST['MAIL'];

        mail(
            $mail,
            "Результат теста",
            str_replace("<br>", "\n", $out),
            "Content-type: text/plain; charset=utf-8"
        );

        $out .= "<br>Результаты теста были автоматически отправлены на e-mail $mail";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Math Test</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #1e1e2f, #2b5876);
            color: #fff;
            margin: 0;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            background: #ffffff;
            color: #333;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        label {
            flex: 1;
            padding-right: 10px;
        }

        input,
        select,
        textarea {
            flex: 2;
            padding: 6px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        textarea {
            height: 60px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #ff7e5f, #feb47b);
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
        }

        .result {
            background: #f5f5f5;
            padding: 20px;
            border-radius: 10px;
        }

        a {
            display: inline-block;
            padding: 10px 15px;
            background: #2b5876;
            color: white;
            border-radius: 6px;
            text-decoration: none;
        }

        .print {
            background: white;
            color: black;
        }

        .print .btn,
        .print a {
            display: none;
        }
    </style>

    <script>
        function toggleMail() {
            let block = document.getElementById("mail_block");
            block.style.display = document.getElementById("send_mail").checked ? "block" : "none";
        }
    </script>

</head>

<body class="<?= $view == 'print' ? 'print' : '' ?>">

    <div class="container">

        <h2>Математический тест</h2>

        <?php if ($isPost): ?>

            <div class="result">
                <?= $out ?>

                <?php if ($view == 'browser'): ?>
                    <br><br>
                    <a href="?FIO=<?= $fio ?>&GROUP=<?= $group ?>&VIEW=browser">Пройти снова</a>
                <?php endif; ?>
            </div>

        <?php else: ?>

            <form method="post">

                <div class="form-group">
                    <label>ФИО</label>
                    <input type="text" name="FIO" value="<?= $_GET['FIO'] ?? '' ?>">
                </div>

                <div class="form-group">
                    <label>Группа</label>
                    <input type="text" name="GROUP" value="<?= $_GET['GROUP'] ?? '' ?>">
                </div>

                <div class="form-group">
                    <label>A</label>
                    <input type="text" name="A" value="<?= randVal() ?>">
                </div>

                <div class="form-group">
                    <label>B</label>
                    <input type="text" name="B" value="<?= randVal() ?>">
                </div>

                <div class="form-group">
                    <label>C</label>
                    <input type="text" name="C" value="<?= randVal() ?>">
                </div>

                <div class="form-group">
                    <label>Ваш ответ</label>
                    <input type="text" name="RESULT">
                </div>

                <div class="form-group">
                    <label>О себе</label>
                    <textarea name="ABOUT"></textarea>
                </div>

                <div class="form-group">
                    <label>Задача</label>
                    <select name="TASK">
                        <option value="mean">Среднее</option>
                        <option value="perimeter">Периметр</option>
                        <option value="area">Площадь</option>
                        <option value="volume">Объем</option>
                        <option value="max">Максимум</option>
                        <option value="min">Минимум</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Режим</label>
                    <select name="VIEW">
                        <option value="browser">Экран</option>
                        <option value="print">Печать</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox" id="send_mail" name="send_mail" onclick="toggleMail()">
                        Отправить email
                    </label>
                </div>

                <div id="mail_block" style="display:none;">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="MAIL">
                    </div>
                </div>

                <br>
                <button class="btn">Проверить</button>

            </form>

        <?php endif; ?>

    </div>

</body>

</html>