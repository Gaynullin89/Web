<?php
echo '
<style>
body {
    font-family: "Segoe UI", Arial;
    background: #f4f6f9;
    padding: 30px;
}

.container {
    background: white;
    padding: 25px;
    border-radius: 10px;
    max-width: 700px;
    margin: auto;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

h2, h3 {
    text-align: center;
}

.array {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    margin: 10px 0;
}

.item {
    background: #2196F3;
    color: white;
    padding: 6px 10px;
    border-radius: 6px;
}

.iter {
    background: #eee;
    padding: 6px;
    margin: 5px 0;
    border-radius: 5px;
}

.success {
    color: green;
    font-weight: bold;
}

.error {
    color: red;
    font-weight: bold;
}
</style>

<div class="container">
';

function isNotNumber($arg)
{
    if ($arg === '') return true;
    for ($i = 0; $i < strlen($arg); $i++) {
        if ($arg[$i] < '0' || $arg[$i] > '9') return true;
    }
    return false;
}

function printArray($arr, $iter)
{
    echo "<div>Итерация $iter: ";
    foreach ($arr as $v) echo $v . " ";
    echo "</div>";
}

/* ===== СОРТИРОВКИ ===== */

function selectionSort($arr)
{
    $iter = 0;
    for ($i = 0; $i < count($arr) - 1; $i++) {
        $min = $i;
        for ($j = $i + 1; $j < count($arr); $j++) {
            $iter++;
            if ($arr[$j] < $arr[$min]) $min = $j;
            printArray($arr, $iter);
        }
        if ($min != $i) {
            $tmp = $arr[$i];
            $arr[$i] = $arr[$min];
            $arr[$min] = $tmp;
        }
    }
    return $iter;
}

function bubbleSort($arr)
{
    $iter = 0;
    for ($j = 0; $j < count($arr) - 1; $j++) {
        for ($i = 0; $i < count($arr) - 1 - $j; $i++) {
            $iter++;
            if ($arr[$i] > $arr[$i + 1]) {
                $tmp = $arr[$i];
                $arr[$i] = $arr[$i + 1];
                $arr[$i + 1] = $tmp;
            }
            printArray($arr, $iter);
        }
    }
    return $iter;
}

function gnomeSort($arr)
{
    $i = 1;
    $iter = 0;
    while ($i < count($arr)) {
        $iter++;
        if ($i == 0 || $arr[$i] >= $arr[$i - 1]) {
            $i++;
        } else {
            $tmp = $arr[$i];
            $arr[$i] = $arr[$i - 1];
            $arr[$i - 1] = $tmp;
            $i--;
        }
        printArray($arr, $iter);
    }
    return $iter;
}

function shellSort($arr)
{
    $iter = 0;
    $n = count($arr);

    for ($gap = floor($n / 2); $gap > 0; $gap = floor($gap / 2)) {

        for ($i = $gap; $i < $n; $i++) {

            $temp = $arr[$i];
            $j = $i;

            // Сдвигаем элементы
            while ($j >= $gap && $arr[$j - $gap] > $temp) {
                $arr[$j] = $arr[$j - $gap];
                $j -= $gap;

                $iter++;
                printArray($arr, $iter);
            }

            $arr[$j] = $temp;

            $iter++;
            printArray($arr, $iter);
        }
    }

    return $iter;
}

function quickSort(&$arr, &$iter, $left, $right)
{
    $i = $left;
    $j = $right;
    $pivot = $arr[intval(($left + $right) / 2)];

    while ($i <= $j) {
        while ($arr[$i] < $pivot) {
            $i++;
            $iter++;
        }
        while ($arr[$j] > $pivot) {
            $j--;
            $iter++;
        }

        if ($i <= $j) {
            $tmp = $arr[$i];
            $arr[$i] = $arr[$j];
            $arr[$j] = $tmp;
            $i++;
            $j--;
            printArray($arr, $iter);
        }
    }

    if ($left < $j) quickSort($arr, $iter, $left, $j);
    if ($i < $right) quickSort($arr, $iter, $i, $right);
}

/* ===== ПРОГРАММА ===== */

if (!isset($_POST['element0'])) {
    echo "Массив не задан";
    exit();
}

$len = $_POST['arrLength'];
$arr = [];

for ($i = 0; $i < $len; $i++) {
    if (isNotNumber($_POST["element$i"])) {
        echo "Ошибка: элемент не число";
        exit();
    }
    $arr[] = intval($_POST["element$i"]);
}

echo "<h2>Исходный массив</h2>";
foreach ($arr as $i => $v) {
    echo "$i: $v <br>";
}

echo "<br>Массив корректен<br><br>";

$start = microtime(true);
$iter = 0;

switch ($_POST['algorithm']) {
    case "0":
        echo "<h3>Сортировка выбором</h3>";
        $iter = selectionSort($arr);
        break;
    case "1":
        echo "<h3>Пузырьковая</h3>";
        $iter = bubbleSort($arr);
        break;
    case "2":
        echo "<h3>Шелла</h3>";
        $iter = shellSort($arr);
        break;
    case "3":
        echo "<h3>Гнома</h3>";
        $iter = gnomeSort($arr);
        break;
    case "4":
        echo "<h3>Быстрая</h3>";
        quickSort($arr, $iter, 0, count($arr) - 1);
        break;
    case "5":
        echo "<h3>PHP sort()</h3>";
        sort($arr);

        printArray($arr, 0);

        break;
}

$time = microtime(true) - $start;

echo "<br><b>Сортировка завершена</b><br>";
echo "Итераций: $iter<br>";
echo "Время: $time сек";
