<?php

// текущее значение строки
$value = "";

// проверка переданных данных
if (array_key_exists("data", $_GET)) {
    $value = $_GET["data"];
}

// обработка нажатия
if (array_key_exists("key", $_GET)) {
    $value = $value . $_GET["key"];
}

// счетчик нажатий
$press = 0;

if (array_key_exists("press", $_GET)) {
    $press = $_GET["press"];
}

if (array_key_exists("key", $_GET)) {
    $press++;
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>

    <meta charset="UTF-8">

    <title>Лабораторная 3</title>

    <link rel="stylesheet" href="./css/style.css">

</head>

<body>

    <div class="wrapper">

        <div class="screen">
            <?php echo $value; ?>
        </div>

        <table class="keys">

            <?php

            $buttons = [
                [1, 2, 3],
                [4, 5, 6],
                [7, 8, 9],
            ];

            foreach ($buttons as $row) {
                echo "<tr>";

                foreach ($row as $num) {
                    echo "<td>";
                    echo '<a href="?key=' . $num . '&data=' . $value . '&press=' . $press . '">' . $num . '</a>';
                    echo "</td>";
                }

                echo "</tr>";
            }

            ?>

            <tr>
                <td colspan="2">

                    <a class="zero" href="?key=0&data=<?php echo $value ?>&press=<?php echo $press ?>">0</a>

                </td>

                <td>

                    <a class="reset" href="index.php?press=<?php echo $press ?>">C</a>

                </td>
            </tr>

        </table>

        <div class="counter">
            Количество нажатий: <?php echo $press; ?>
        </div>

    </div>

</body>

</html>