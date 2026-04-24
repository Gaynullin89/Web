<?php
$db = mysqli_connect("localhost","root","","friends");

// удаление
if(isset($_GET['id'])){
mysqli_query($db,"DELETE FROM friends WHERE id=".$_GET['id']);
echo "<p class='ok'>Удалено</p>";
}

$res = mysqli_query($db,"SELECT * FROM friends"); // Получение данных из самой базы данных

echo "<div class='table-box'><table class='table-main'>";

echo "<tr>
<th>Фамилия</th>
<th>Имя</th>
<th>Телефон</th>
<th>Удалить</th>
</tr>";

while($r = mysqli_fetch_assoc($res)){ // Выводим данные

echo "<tr>
<td>{$r['surname']}</td>
<td>{$r['name']}</td>
<td>{$r['phone']}</td>
<td>
<a class='btn-delete' href='?p=delete&id={$r['id']}'> 
Удалить
</a>
</td>
</tr>";
}

echo "</table></div>";
?>