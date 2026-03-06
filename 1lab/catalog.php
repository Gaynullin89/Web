<?php
$title = "Гайнуллин Никита 241-351 | Каталог";
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #2b2b2b;
            color: white;
            padding-top: 70px;
            padding-bottom: 50px;
        }

        header {
             position: fixed;
            top: 0;
            width: 100%;
            height: 60px;
            background: #222;
            text-align: center;
            padding-top: 20px;
        }

        nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
        }

        nav a:hover {
            color: blue;
        }

        .active {
                   color: red;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 35px;
            background: #000;
            text-align: center;
            padding-top: 10px;
            font-size: 13px;
        }

        main {
            padding: 20px;
            text-align: center;
        }

        table {
            margin: auto;
            border-collapse: collapse;
        }

        td,
        th {
            border: 1px solid white;
            padding: 10px 20px;
        }

        img {
             width: 250px;
           height: 250px;
            margin: 10px;
        }
    </style>
</head>

<body>

    <header>
   <nav>
            <a href="<?php $link='index.php'; $current_page=false; $name='Главная'; echo $link; ?>"<?php if($current_page) echo ' class="active"'; ?>><?php echo $name; ?></a>
            <a href="<?php $link='catalog.php'; $current_page=true; $name='Каталог'; echo $link; ?>"<?php if($current_page) echo ' class="active"'; ?>><?php echo $name; ?></a>
            <a href="<?php $link='gallery.php'; $current_page=false; $name='Изображения'; echo $link; ?>"<?php if($current_page) echo ' class="active"'; ?>><?php echo $name; ?></a>
        </nav>
    </header>

    <main>

        <h1>Каталог</h1>
<table>
            <?php echo '<tr><td>Название</td><td>Тип</td><td>Цена</td></tr>'; ?>
            <tr><td><?php echo 'AK-47 (макет)'; ?></td><td><?php echo 'Автомат'; ?></td><td><?php echo '15000 ₽'; ?></td></tr>
              <tr><td><?php echo 'Desert Eagle (макет)'; ?></td><td><?php echo 'Пистолет'; ?></td><td><?php echo '12000 ₽'; ?></td></tr>
                  <tr><td><?php echo 'Катана'; ?></td><td><?php echo 'Холодное оружие'; ?></td><td><?php echo '8000 ₽'; ?></td></tr>
        </table>


        <?php
        $img = (date('s') % 3) + 1;
        echo '<img src="./images/gun' . $img . '.jpg">';
        ?>

    </main>
<footer>
        Сформировано <?php date_default_timezone_set("Europe/Moscow"); echo date('d.m.Y в H:i:s'); ?>
    </footer>
</body>

</html>