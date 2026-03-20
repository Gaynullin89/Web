<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Таблица умножения</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <!-- ГЛАВНОЕ МЕНЮ -->
    <div id="main_menu">
        <?php
        // Табличная верстка
        echo '<a href="?html_type=TABLE';
        if (isset($_GET['content'])) echo '&content=' . $_GET['content'];
        echo '"';
        if (isset($_GET['html_type']) && $_GET['html_type'] == 'TABLE') echo ' class="selected"';
        echo '>Табличная верстка</a>';

        // Блочная верстка
        echo '<a href="?html_type=DIV';
        if (isset($_GET['content'])) echo '&content=' . $_GET['content'];
        echo '"';
        if (isset($_GET['html_type']) && $_GET['html_type'] == 'DIV') echo ' class="selected"';
        echo '>Блочная верстка</a>';
        ?>
    </div>

    <div id="container">

        <!-- ОСНОВНОЕ МЕНЮ -->
        <div id="side_menu">
            <?php
            echo '<a href="?"';
            if (!isset($_GET['content'])) echo ' class="selected"';
            echo '>Всё</a>';

            for ($i = 2; $i <= 9; $i++) {
                echo '<a href="?content=' . $i;
                if (isset($_GET['html_type'])) echo '&html_type=' . $_GET['html_type'];
                echo '"';
                if (isset($_GET['content']) && $_GET['content'] == $i) echo ' class="selected"';
                echo '>' . $i . '</a>';
            }
            ?>
        </div>

        <!-- ОСНОВНОЙ КОНТЕНТ -->
        <div id="content">
            <?php

            function outNumAsLink($x)
            {
                if ($x <= 9) {
                    return '<a href="?content=' . $x . '">' . $x . '</a>';
                }
                return $x;
            }

            function outRow($n)
            {
                for ($i = 2; $i <= 9; $i++) {
                    echo outNumAsLink($n) . 'x' . outNumAsLink($i) . '=' . outNumAsLink($n * $i) . '<br>';
                }
            }

            function outTableForm()
            {
                if (!isset($_GET['content'])) {
                    echo '<table>';
                    echo '<tr>';
                    for ($i = 2; $i <= 9; $i++) {
                        echo '<td>';
                        outRow($i);
                        echo '</td>';
                    }
                    echo '</tr>';
                    echo '</table>';
                } else {
                    echo '<table>';
                    echo '<tr><td>';
                    outRow($_GET['content']);
                    echo '</td></tr>';
                    echo '</table>';
                }
            }

            function outDivForm()
            {
                if (!isset($_GET['content'])) {
                    for ($i = 2; $i <= 9; $i++) {
                        echo '<div class="ttRow">';
                        outRow($i);
                        echo '</div>';
                    }
                } else {
                    echo '<div class="ttSingleRow">';
                    outRow($_GET['content']);
                    echo '</div>';
                }
            }

            // ВЫБОР ТИПА ВЕРСТКИ
            if (!isset($_GET['html_type']) || $_GET['html_type'] == 'TABLE') {
                outTableForm();
            } else {
                outDivForm();
            }

            ?>
        </div>

    </div>

    <!-- ПОДВАЛ -->
    <div id="footer">
        <?php
        if (!isset($_GET['html_type']) || $_GET['html_type'] == 'TABLE') {
            $s = 'Табличная верстка. ';
        } else {
            $s = 'Блочная верстка. ';
        }

        if (!isset($_GET['content'])) {
            $s .= 'Полная таблица. ';
        } else {
            $s .= 'Таблица на ' . $_GET['content'] . '. ';
        }
        date_default_timezone_set("Europe/Moscow");
        echo $s . date('d.m.Y H:i:s');
        ?>
    </div>

</body>

</html>