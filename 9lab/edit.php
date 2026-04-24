<?php
$db = mysqli_connect("localhost","root","","friends");

$message = "";

// обновление
if(isset($_POST['btn'])){

    // проверка полей
    foreach($_POST as $key => $value){
        if($key != 'btn' && trim($value) == ''){
            $message = "<div class='error'>Заполните все поля</div>";
            break;
        }
    }

    if($message == ""){

        $sql = "UPDATE friends SET
        surname='".$_POST['surname']."',
        name='".$_POST['name']."',
        patronymic='".$_POST['patronymic']."',
        gender='".$_POST['gender']."',
        birthdate='".$_POST['birthdate']."',
        phone='".$_POST['phone']."',
        email='".$_POST['email']."',
        address='".$_POST['address']."',
        comment='".$_POST['comment']."'
        WHERE id=".$_POST['id'];

        if(mysqli_query($db,$sql)){
            $message = "<div class='ok'>Данные обновлены</div>";
        } else {
            $message = "<div class='error'>Ошибка: ".mysqli_error($db)."</div>";
        }

        $_GET['id'] = $_POST['id'];
    }
}

// получаем список записей сортировка по фамилии
$res = mysqli_query($db,"SELECT * FROM friends ORDER BY surname");

$current = null; // здесь хранится запись

echo "<div class='table-box'><table class='table-main'>";

echo "<tr>
<th>Фамилия</th>
<th>Имя</th>
<th>Телефон</th>
<th>Действие</th>
</tr>";

while($r = mysqli_fetch_assoc($res)){

echo "<tr>
<td>{$r['surname']}</td>
<td>{$r['name']}</td>
<td>{$r['phone']}</td>
<td><a class='btn' href='?p=edit&id={$r['id']}'>Изменить</a></td>
</tr>";

if(isset($_GET['id']) && $_GET['id'] == $r['id']){
$current = $r;
}
}

echo "</table></div>";

echo $message;

// форма
if($current){
?>

<form method="post" class="form">

<input name="surname" value="<?= $current['surname'] ?>">
<input name="name" value="<?= $current['name'] ?>">

<input name="patronymic" value="<?= $current['patronymic'] ?>">
<input name="gender" value="<?= $current['gender'] ?>">

<input type="date" name="birthdate" value="<?= $current['birthdate'] ?>">
<input name="phone" value="<?= $current['phone'] ?>">

<input name="email" value="<?= $current['email'] ?>">
<input name="address" value="<?= $current['address'] ?>">

<textarea name="comment"><?= $current['comment'] ?></textarea>

<input type="hidden" name="id" value="<?= $current['id'] ?>">

<button name="btn">Сохранить</button>

</form>

<?php } ?>