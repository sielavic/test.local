<?php
echo "<link rel='stylesheet' href='style.css'>";
if (isset($_FILES['file'])) {
    // Путь для сохранения файла

    $uploadPath = __DIR__ . '/files/' . $_FILES['file']['name'];
    $upload_dir = __DIR__  . '/files/';

    if(!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }


    // Проверяем, удалось ли загрузить файл
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath)) {
        // Читаем содержимое файла
        $contents = file_get_contents($uploadPath);

        // Разбиваем содержимое файла на строки
        $lines = explode("\n", $contents);

        // Определяем символ-разделитель
        $delimiter = ';';

        // Обрабатываем каждую строку файла
        foreach ($lines as $line) {
            // Убираем символы переноса строки и пробелы в начале и конце строки
            $line = trim($line);

            // Ищем цифры в строке с помощью регулярного выражения
            preg_match_all('/\d+/', $line, $matches);

            // Определяем количество цифр в строке
            $digitsCount = count($matches[0]);

            // Выводим результат на экран
            echo "<div>{$line} = {$digitsCount}</div>";
        }

        // Выводим сообщение об успешной загрузке файла
        echo '<div class="circle_green"></div><span>Файл успешно загружен и обработан</span>';

    } else {
        // Выводим сообщение об ошибке загрузки файла
        echo '<div class="circle_red"></div><span>Не удалось загрузить файл</span>';
    }
}
