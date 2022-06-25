<?php

require_once __DIR__ . '/models/Model.php';
$model = new Model();

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Library</title>
</head>
<body>
<form action="">
    <label for="publisher">Издательство:</label>
    <select name="publisher" id="publisher">
        <? foreach ($model->get_publishers() as $publisher) { ?>
            <option value="<?= $publisher ?>"><?= $publisher ?></option>
        <? } ?>
    </select>
    <input type="submit">
</form>
<br>
<form action="">
    <label for="">Диапазон:</label>
    <input type="date" name="date_from">
    <input type="date" name="date_to">
    <input type="submit">
</form>
<br>
<form action="">
    <label for="author">Автор:</label>
    <select name="author" id="author">
        <? foreach ($model->get_authors() as $author) { ?>
            <option value="<?= $author ?>"><?= $author ?></option>
        <? } ?>
    </select>
    <input type="submit">
</form>
<br>

<button id="save">Сохрнаить в localStorage</button>
<button id="show">Показать из localStorage</button>
<br><br>
<?
foreach ($_GET as $key => $value) {
    switch ($key) {
        case 'publisher':
            echo '<table border="2" cellpadding="3"><tr><th>Название</th><th>Год выпуска</th><th>Страниц</th><th>ISBN</th></tr>';
            foreach ($model->get_books_by_publisher($value) as $el) {
                echo '<tr>';
                echo '<td>' . $el['name'] . '</td><td>' . $el['year'] . '</td><td>' . $el['quantity'] . '</td><td>' . $el['isbn'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
            break;
        case 'author':
            echo '<table border="2" cellpadding="3"><tr><th>Название</th><th>Год выпуска</th><th>Страниц</th><th>ISBN</th></tr>';
            foreach ($model->get_books_by_author($value) as $el) {
                echo '<tr>';
                echo '<td>' . $el['name'] . '</td><td>' . $el['year'] . '</td><td>' . $el['quantity'] . '</td><td>' . $el['isbn'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
            break;
        case 'date_from':
            echo '<table border="2" cellpadding="3"><tr><th>Название</th><th>Дата выпуска</th><th>Год выпуска</th><th>Издание</th><th>Страниц</th><th>ISBN</th><th>Номер</th><th>Тип</th><th>Ресурс</th></tr>';
            foreach ($model->get_literature_by_date($value, $_GET['date_to']) as $el) {
                echo '<tr>';
                echo '<td>' . $el['name'] . '</td><td>' . (isset($el['date']) ? date('d.m.Y', strtotime($el['date'])) : '') . '</td><td>' . $el['year'] . '</td><td>' . $el['publisher'] . '</td><td>' . $el['quantity'] . '</td><td>' . $el['isbn'] . '</td><td>' . $el['number'] . '</td><td>' . $el['literate'] . '</td><td>' . $el['resource'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
            break;
    }
}
?>

<script src="script.js" defer></script>
</body>
</html>
