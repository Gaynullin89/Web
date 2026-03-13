<?php

// количество колонок таблицы
$colNumber = 6;

// массив структур таблиц (не менее 10)
$tableStructures = array(
    "Dog*Cat*Bird#Lion*Tiger",
    "Red*Green*Blue#Yellow",
    "One*Two*Three#Four*Five*Six",
    "PHP*HTML#CSS*JS",
    "Apple*Orange*Banana#Kiwi",
    "Sun*Moon#Star",
    "Winter*Spring#Summer*Autumn",
    "A*B*C#D*E*F",
    "North*South#East*West",
    "Car*Bike*Bus#Train"
);


// проверка количества колонок
if ($colNumber == 0) {
    echo "<h2>Неправильное число колонок</h2>";
    exit;
}



// функция формирования строки таблицы
function makeRow($text, $colNumber)
{

    $text = trim($text);

    if ($text == "") {
        return "";
    }

    $items = explode("*", $text);

    $html = "<tr>";

    for ($i = 0; $i < $colNumber; $i++) {

        if (array_key_exists($i, $items)) {
            $html .= "<td>" . $items[$i] . "</td>";
        } else {
            $html .= "<td></td>";
        }
    }

    $html .= "</tr>";

    return $html;
}



// функция вывода таблицы
function renderTable($structure, $colNumber, $index)
{

    $rows = explode("#", $structure);

    if (count($rows) == 0) {
        echo "В таблице нет строк";
        return;
    }

    $tableContent = "";

    foreach ($rows as $line) {

        $rowCode = makeRow($line, $colNumber);

        if ($rowCode != "") {
            $tableContent .= $rowCode;
        }
    }

    if ($tableContent == "") {
        echo "В таблице нет строк с ячейками";
        return;
    }

    echo "<h2>Таблица №" . $index . "</h2>";

    echo "<table class='tbl'>";
    echo $tableContent;
    echo "</table>";
}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <title>Лабораторная №4</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <h1>Вывод таблиц</h1>

    <?php

    for ($i = 0; $i < count($tableStructures); $i++) {

        renderTable($tableStructures[$i], $colNumber, $i + 1);
    }

    ?>

</body>

</html>