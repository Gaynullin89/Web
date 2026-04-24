<?php
echo '<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">';

require 'menu.php';

$page = $_GET['p'] ?? 'viewer';

if ($page == 'viewer') {

    include 'viewer.php';

    $sort = $_GET['sort'] ?? 'byid';
    $pg = $_GET['page'] ?? 0;

    echo showTable($sort, $pg);

} else {
    include $page . '.php';
}

echo '</div></body></html>';
?>