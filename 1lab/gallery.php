<?php
$title = "Гайнуллин Никита 241-351 | Галерея";
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

        img {
              width: 250px;
           height: 250px;
            margin: 10px;
            border-radius: 50%;
        }
    </style>
</head>

<body>

    <header>
             <nav>  <a href="<?php $link='index.php'; $current_page=false; $name='Главная'; echo $link; ?>"<?php if($current_page) echo ' class="active"'; ?>><?php echo $name; ?></a>
            <a href="<?php $link='catalog.php'; $current_page=false; $name='Каталог'; echo $link; ?>"<?php if($current_page) echo ' class="active"'; ?>><?php echo $name; ?></a>
            <a href="<?php $link='gallery.php'; $current_page=true; $name='Изображения'; echo $link; ?>"<?php if($current_page) echo ' class="active"'; ?>><?php echo $name; ?></a>r</nav>
    </header>

    <main>

        <h1>Галерея</h1>

        <img src="./images/gun_static1.jpg">
        <img src="./images/gun_static2.jpg">
        <img src="./images/gun_static3.jpg">

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