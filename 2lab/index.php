<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Гайнуллин Н.Э. — Группа 241-351 — ЛР №2 — Вариант 3</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <header>
        <div class="logo">
            <img src="./logo.jpg" alt="Логотип">
        </div>
        <div class="headtext">
            <h1>Гайнуллин Никита Эдуардович</h1>
            <p>Группа 241-351 — Лабораторная работа №2 — Вариант 3</p>
        </div>
    </header>

    <main>

        <?php

        $x = -10;
        $step = 2;
        $count = 60;
        $type = 'D';

        $min_limit = -10000;
        $max_limit = 10000;

        $sum = 0;
        $num = 0;
        $min_val = null;
        $max_val = null;

        $rows = [];

        function fmt($v)
        {
            if ($v === 'error') return 'error';
            return number_format($v, 3, '.', '');
        }

        for ($i = 0; $i < $count; $i++, $x += $step) {

            if ($x <= 10) {
                $f = 3 * pow($x, 3) + 2;
            } elseif ($x < 20) {
                $f = 5 * $x + 7;
            } else {
                if ($x == 22) {
                    $f = 'error';
                } else {
                    $f = $x / (22 - $x) - $x;
                }
            }

            if ($f !== 'error') {
                $f = round($f, 3);

                $sum += $f;
                $num++;

                if ($min_val === null || $f < $min_val) $min_val = $f;
                if ($max_val === null || $f > $max_val) $max_val = $f;

                $rows[] = [$x, fmt($f)];

                if ($f >= $max_limit || $f < $min_limit) break;
            } else {
                $rows[] = [$x, 'error'];
            }
        }

        switch ($type) {

            case 'B':
                echo "<ul>";
                foreach ($rows as $r) {
                    echo "<li>f({$r[0]})={$r[1]}</li>";
                }
                echo "</ul>";
                break;

            case 'C':
                echo "<ol>";
                foreach ($rows as $r) {
                    echo "<li>f({$r[0]})={$r[1]}</li>";
                }
                echo "</ol>";
                break;

            case 'D':
                echo "<table class='tbl'><tr><th>№</th><th>x</th><th>f(x)</th></tr>";
                $n = 1;
                foreach ($rows as $r) {
                    echo "<tr><td>{$n}</td><td>{$r[0]}</td><td>{$r[1]}</td></tr>";
                    $n++;
                }
                echo "</table>";
                break;

            case 'E':
                foreach ($rows as $r) {
                    echo "<div class='box'>f({$r[0]})={$r[1]}</div>";
                }
                break;

            default:
                $last = count($rows) - 1;
                foreach ($rows as $k => $r) {
                    echo "f({$r[0]})={$r[1]}";
                    if ($k < $last) echo "<br>";
                }
        }

        echo "<hr>";

        if ($num > 0) {
            $avg = $sum / $num;
            echo "<div class='stats'>";
            echo "<p>Количество значений: {$num}</p>";
            echo "<p>Сумма: " . fmt($sum) . "</p>";
            echo "<p>Минимум: " . fmt($min_val) . "</p>";
            echo "<p>Максимум: " . fmt($max_val) . "</p>";
            echo "<p>Среднее: " . fmt($avg) . "</p>";
            echo "</div>";
        }

        ?>

    </main>

    <footer>
        Тип верстки: <b><?php echo $type; ?></b>
    </footer>

</body>

</html>