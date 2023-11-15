<!-- 2. Написать функцию-парсер новостей с сайта www.opennet.ru. Функция должна вернуть
ассоциативный массив с заголовками и ссылками на статьи с индексной страницы сайта. -->

<!-- Для парсинга используется библиотека DiDOM -->

<?php

require 'vendor/autoload.php'; // Подключаем автозагрузку Composer

use DiDom\Document;

function parseOpenNetNews() {
    $url = 'https://www.opennet.ru/';

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

    return $result;
}

// Пример использования функции
$news = parseOpenNetNews();

// Выводим результаты в CLI
if (empty($news)) {
    echo "Нет результатов для вывода.\n";
} else {
    // Установим кодировку для корректного отображения русских символов

    foreach ($news as $item) {
        echo "Заголовок: {$item['title']}\n";
        echo "Ссылка: {$item['link']}\n\n";
    }
}
