<!-- 1. Реализовать свою функцию сортировки. Функция принимает массив целых чисел и
булевый параметр направления, возвращает массив.
Принцип работы. Числа во входящем массиве передаются хаотично, например в таком
порядке: 1, 5,6,2,8,10,100,14... В зависимости от второго булевого параметра функция
сортирует входящий массив в порядке убывания или в порядке возрастания и возвращает
его. То есть на выходе получаем массив либо как 1,2,3,4,5..., либо как ...5,4,3,2,1.
Задача должна выполняться в среде php-cli. -->

<?php

function customSort(array $arr, bool $ascending = true): array {
    $direction = $ascending ? true : false;

    usort($arr, function ($a, $b) use ($direction) {
        if ($a == $b) {
            return 0;
        }
        return ($a < $b) ? -$direction : $direction;
    });

    return $arr;
}

// Чтение ввода пользователя
echo "Введите целые числа через запятую: ";
$input = trim(fgets(STDIN));

// Преобразование ввода в массив
$numbers = array_map('intval', explode(',', $input));

// Сортировка в порядке возрастания
$sortedAscending = customSort($numbers);
echo "Отсортированный массив по возрастанию: " . implode(', ', $sortedAscending) . "\n";

// Сортировка в порядке убывания
$sortedDescending = customSort($numbers, false);
echo "Отсортированный массив по убыванию: " . implode(', ', $sortedDescending) . "\n";

?>




