<?php
$db = mysqli_connect("localhost","root","","friends");

$message = "";

if(isset($_POST['btn'])){

    // проверка полей
    foreach($_POST as $key => $value){
        if($key != 'btn' && trim($value) == ''){
            $message = "<div class='error'>Заполните все поля</div>";
            break;
        }
    }

    if($message == ""){
// Формируем sql запрос
        $sql = "INSERT INTO friends 
        (surname,name,patronymic,gender,birthdate,phone,email,address,comment)
        VALUES(
        '".$_POST['surname']."',
        '".$_POST['name']."',
        '".$_POST['patronymic']."',
        '".$_POST['gender']."',
        '".$_POST['birthdate']."',
        '".$_POST['phone']."',
        '".$_POST['email']."',
        '".$_POST['address']."',
        '".$_POST['comment']."'
        )";

        if(mysqli_query($db,$sql)){ // отправит запрос в базу данных 
            $message = "<div class='ok'>Запись успешно добавлена</div>";
        } else {
            $message = "<div class='error'>Ошибка: ".mysqli_error($db)."</div>";
        }
    }
}
?>

<?= $message ?>
 
<form method="post" class="form"> 

<input name="surname" placeholder="Фамилия" value="<?= $_POST['surname'] ?? '' ?>">
<input name="name" placeholder="Имя" value="<?= $_POST['name'] ?? '' ?>">

<input name="patronymic" placeholder="Отчество" value="<?= $_POST['patronymic'] ?? '' ?>">
<input name="gender" placeholder="Пол" value="<?= $_POST['gender'] ?? '' ?>">

<input type="date" name="birthdate" value="<?= $_POST['birthdate'] ?? '' ?>">
<input name="phone" placeholder="Телефон" value="<?= $_POST['phone'] ?? '' ?>">

<input name="email" placeholder="Email" value="<?= $_POST['email'] ?? '' ?>">
<input name="address" placeholder="Адрес" value="<?= $_POST['address'] ?? '' ?>">

<textarea name="comment" placeholder="Комментарий"><?= $_POST['comment'] ?? '' ?></textarea>

<button name="btn">Добавить</button>

</form>