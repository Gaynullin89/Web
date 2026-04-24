<?php
session_start();

function isnum($s)
{
    return is_numeric($s);
}

function priority($op)
{
    if ($op == '+' || $op == '-') return 1;
    if ($op == '*' || $op == '/') return 2;
    return 0;
}

function apply($a, $b, $op)
{
    if ($op == '+') return $a + $b;
    if ($op == '-') return $a - $b;
    if ($op == '*') return $a * $b;
    if ($op == '/') {
        if ($b == 0) return "Деление на 0";
        return $a / $b;
    }
}

function calculateSq($expr)
{
    $expr = str_replace(" ", "", $expr);

    $values = [];
    $ops = [];
    $num = "";

    for ($i = 0; $i < strlen($expr); $i++) {
        $c = $expr[$i];

        if (is_numeric($c) || $c == '.') {
            $num .= $c;
        } else {
            if ($num !== "") {
                $values[] = $num;
                $num = "";
            }

            if ($c == '(') {
                $ops[] = $c;
            } elseif ($c == ')') {
                while (end($ops) != '(') {
                    $b = array_pop($values);
                    $a = array_pop($values);
                    $op = array_pop($ops);
                    $res = apply($a, $b, $op);
                    if (!isnum($res)) return $res;
                    $values[] = $res;
                }
                array_pop($ops);
            } else {
                while (!empty($ops) && priority(end($ops)) >= priority($c)) {
                    $b = array_pop($values);
                    $a = array_pop($values);
                    $op = array_pop($ops);
                    $res = apply($a, $b, $op);
                    if (!isnum($res)) return $res;
                    $values[] = $res;
                }
                $ops[] = $c;
            }
        }
    }

    if ($num !== "") $values[] = $num;

    while (!empty($ops)) {
        $b = array_pop($values);
        $a = array_pop($values);
        $op = array_pop($ops);
        $res = apply($a, $b, $op);
        if (!isnum($res)) return $res;
        $values[] = $res;
    }

    return $values[0];
}

if (isset($_POST['clear'])) {
    unset($_SESSION['history']);
}

$res = "";
$error = "";

if (isset($_POST['val']) && trim($_POST['val']) !== '') {
    $input = $_POST['val'];
    $res = calculateSq($input);

    if (!isset($_SESSION['history'])) $_SESSION['history'] = [];

    if (isnum($res)) {
        $_SESSION['history'][] = $input . " = " . $res;
    } else {
        $error = $res;
    }
} elseif (isset($_POST['val'])) {
    $error = "Пустое выражение";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            background: #1e1e2f;
            color: white;
            font-family: 'Segoe UI';
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }

        .box {
            background: #2c2c3e;
            padding: 30px;
            border-radius: 15px;
            width: 360px;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: none;
            margin-bottom: 10px;
            background: #444;
            color: white;
        }

        button {
            width: 48%;
            padding: 10px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }

        .calc {
            background: #00c896;
        }

        .clear {
            background: #ff5c5c;
        }

        .result {
            margin-top: 15px;
            font-size: 18px;
        }

        .history {
            margin-top: 15px;
            font-size: 14px;
            color: #bbb;
        }
    </style>
</head>

<body>
    <div class="box">
        <form method="POST">
            <input type="text" name="val" placeholder="2+2*(3+1)">
            <button class="calc">OK</button>
            <button class="clear" name="clear">X</button>
        </form>

        <div class="result">
            <?php
            if ($error) echo "Ошибка: $error";
            elseif ($res !== "") echo "= $res";
            ?>
        </div>

        <div class="history">
            <?php foreach ($_SESSION['history'] ?? [] as $h) echo $h . "<br>"; ?>
        </div>
    </div>
</body>

</html>