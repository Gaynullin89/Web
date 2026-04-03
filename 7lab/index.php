<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>ЛР7 </title>

    <style>
        body {
            font-family: "Segoe UI", Arial;
            background: #f4f6f9;
            padding: 40px;
        }

        .container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            width: 400px;
            margin: auto;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            margin-bottom: 10px;
        }

        td {
            padding: 5px;
        }

        .index {
            width: 30px;
            text-align: right;
            font-weight: bold;
            color: #555;
        }

        input[type=text] {
            width: 100%;
            padding: 6px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        select {
            width: 100%;
            padding: 6px;
            border-radius: 6px;
            margin-top: 10px;
        }

        button {
            width: 100%;
            margin-top: 10px;
            padding: 8px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .add {
            background: blue;
            color: white;
        }

        .sort {
            background: #2196F3;
            color: white;
        }

        button:hover {
            opacity: 0.9;
        }
    </style>

    <script>
        function setHTML(element, txt) {
            if (element.innerHTML) {
                element.innerHTML = txt;
            } else {
                var range = document.createRange();
                range.selectNodeContents(element);
                range.deleteContents();
                var fragment = range.createContextualFragment(txt);
                element.appendChild(fragment);
            }
        }

        function addElement() {
            let table = document.getElementById("elements");
            let index = table.rows.length;

            let row = table.insertRow(index);

            let cell1 = row.insertCell(0);
            let cell2 = row.insertCell(1);

            cell1.className = "index";
            cell1.innerHTML = index + ":";

            let content = `<input type="text" name="element${index}">`;
            setHTML(cell2, content);

            document.getElementById("arrLength").value = table.rows.length;
        }
    </script>
</head>

<body>

    <div class="container">

        <h2>Ввод массива</h2>

        <form action="sort.php" method="POST" target="_blank">

            <table id="elements">
                <tr>
                    <td class="index">0:</td>
                    <td><input type="text" name="element0"></td>
                </tr>
            </table>

            <input type="hidden" id="arrLength" name="arrLength" value="1">

            <select name="algorithm">
                <option value="0">Сортировка выбором</option>
                <option value="1">Пузырьковая</option>
                <option value="2">Шелла</option>
                <option value="3">Гнома</option>
                <option value="4">Быстрая</option>
                <option value="5">PHP sort()</option>
            </select>

            <button type="button" class="add" onclick="addElement()">Добавить элемент</button>
            <button type="submit" class="sort">Запуск</button>

        </form>

    </div>

</body>

</html>