<?php
function showTable($sort = null, $page = null) // выведем таблицу из базы
{
    $db = mysqli_connect("localhost", "root", "", "friends");

    if (!$db) {
        return "<p>Ошибка БД</p>";
    }

    // берём параметры
    $sort = $sort ?? ($_GET['sort'] ?? 'byid'); // если sort берем его, если нет то из URL
    $page = isset($page) ? (int)$page : (int)($_GET['page'] ?? 0);

    if ($page < 0) $page = 0; // чтобы не было отрицательной страницы 

    // настройки пагинации
    $limit = 5;
    $offset = $page * $limit;

    // сортировки
    switch ($sort) {
        case "fam":
            $order = "surname";
            break;
        case "birth":
            $order = "birthdate";
            break;
        default:
            $order = "id";
            $sort = "byid";
            break;
    }

    //  получение данных
    $res = mysqli_query(
        $db,
        "SELECT * FROM friends ORDER BY $order LIMIT $offset, $limit" 
    );

    //  общее количество
    $countRes = mysqli_query($db, "SELECT COUNT(*) as total FROM friends");
    $total = mysqli_fetch_assoc($countRes)['total'];

    $pages = max(1, ceil($total / $limit));

    $html = "<div class='table-box'>";

    //  сортировка
    $html .= "
    <div style='margin-bottom:10px'>
        <a class='btn' href='?p=viewer&sort=byid&page=0'>По умолчанию</a>
        <a class='btn' href='?p=viewer&sort=fam&page=0'>По фамилии</a>
        <a class='btn' href='?p=viewer&sort=birth&page=0'>По дате рождения</a>
    </div>";

    // 🔹 таблица
    $html .= "<table class='table-main'>
    <tr>
        <th>№</th>
        <th>Фамилия</th>
        <th>Имя</th>
        <th>Отчество</th>
        <th>Пол</th>
        <th>Дата рождения</th>
        <th>Телефон</th>
        <th>Email</th>
        <th>Адрес</th>
        <th>Комментарий</th>
    </tr>";

    $i = $offset + 1;

    while ($r = mysqli_fetch_assoc($res)) {
        $html .= "<tr> 
            <td>$i</td>
            <td>{$r['surname']}</td>
            <td>{$r['name']}</td>
            <td>{$r['patronymic']}</td>
            <td>{$r['gender']}</td>
            <td>{$r['birthdate']}</td>
            <td>{$r['phone']}</td>
            <td>{$r['email']}</td>
            <td>{$r['address']}</td>
            <td>{$r['comment']}</td>
        </tr>";
        $i++;
    }

    $html .= "</table>";

    // пагинация
    $html .= "<div style='margin-top:10px'>";

    if ($page > 0) {
        $html .= "<a class='btn' href='?p=viewer&sort=$sort&page=" . ($page - 1) . "'>←</a> ";
    }

    for ($p = 0; $p < $pages; $p++) {
        $num = $p + 1;

        if ($p == $page) {
            $html .= "<b>$num</b> ";
        } else {
            $html .= "<a class='btn' href='?p=viewer&sort=$sort&page=$p'>$num</a> ";
        }
    }

    if ($page < $pages - 1) {
        $html .= "<a class='btn' href='?p=viewer&sort=$sort&page=" . ($page + 1) . "'>→</a>";
    }

    $html .= "</div></div>";

    return $html;
}
?>