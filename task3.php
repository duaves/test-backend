<!-- 3.Расширение функции из задачи 2. Данные хранить в кеше, организованном в памяти.
Если, при повторном вызове функции, в кеше есть запись с заголовком статьи и ссылкой,
то их не записывать, если нет, то записать в кеш. -->

<!-- Для кеширования используется ассоциативный массив -->

<?php

require 'vendor/autoload.php'; // Подключаем автозагрузку Composer

use DiDom\Document;

// Простой кеш в памяти
$cache = [];

function parseOpenNetNews() {
    global $cache;

    $url = 'https://www.opennet.ru/';

    // Проверяем, есть ли данные уже в кеше
    if (isset($cache[$url])) {
        return $cache[$url];
    }

    // Создаем объект Document для загрузки и работы с HTML
    $document = new Document($url, true, 'koi8-r');

    // Инициализируем массив для хранения результатов парсинга
    $result = [];

    // Парсим заголовки и ссылки на статьи
    $nodes = $document->find('.tnews a');

    if (empty($nodes)) {
        echo "Не удалось найти элементы на странице.\n";
        return $result;
    }

    foreach ($nodes as $node) {
        $title = $node->text();
        $link = $url . $node->attr('href');

        // Добавляем результаты в массив
        $result[] = [
            'title' => $title,
            'link' => $link,
        ];
    }

    // Обновляем кеш новыми данными
    $cache[$url] = $result;

    return $result;
}

// Пример использования функции
$news = parseOpenNetNews();

// Выводим результаты в CLI
if (empty($news)) {
    echo "Нет результатов для вывода.\n";
} else {
    // Устанавливаем кодировку для корректного отображения русских символов
    foreach ($news as $item) {
        echo "Заголовок: {$item['title']}\n";
        echo "Ссылка: {$item['link']}\n\n";
       
    }
}
var_dump($cache);

