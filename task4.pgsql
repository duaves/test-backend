-- Создание функции сортировки
CREATE OR REPLACE FUNCTION custom_sort(arr INTEGER[], descending BOOLEAN)
RETURNS INTEGER[] AS $$
DECLARE
  temp INTEGER;  -- Временная переменная для обмена значениями
  i INTEGER;     -- Переменная для внешнего цикла
  j INTEGER;     -- Переменная для внутреннего цикла
BEGIN
  -- Внешний цикл для прохода по всем элементам массива
  FOR i IN 1..array_length(arr, 1) - 1 LOOP
    -- Внутренний цикл для сравнения и обмена значений
    FOR j IN 1..array_length(arr, 1) - i LOOP
      -- Проверка направления сортировки (по возрастанию или убыванию)
      IF descending THEN
        -- Сортировка по убыванию
        IF arr[j] < arr[j + 1] THEN
          -- Обмен значениями
          temp := arr[j];
          arr[j] := arr[j + 1];
          arr[j + 1] := temp;
        END IF;
      ELSE
        -- Сортировка по возрастанию
        IF arr[j] > arr[j + 1] THEN
          -- Обмен значениями
          temp := arr[j];
          arr[j] := arr[j + 1];
          arr[j + 1] := temp;
        END IF;
      END IF;
    END LOOP;
  END LOOP;

  -- Возврат отсортированного массива
  RETURN arr;
END;
$$ LANGUAGE plpgsql;

-- Сортировка по возрастанию
SELECT custom_sort(ARRAY[1, 5, 6, 2, 8, 10, 100, 14], FALSE);

-- Сортировка по убыванию
SELECT custom_sort(ARRAY[1, 5, 6, 2, 8, 10, 100, 14], TRUE);