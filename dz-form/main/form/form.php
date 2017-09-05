<?php

/*
 * Скрипт обработки формы обратной связи
 *
 * Получем POST запрос с полями, на выходе отдает одну из переменных $error или $result
 *
 * $error - В случае какой-то ошибки - сообщение об ошибке
 * $result - Если все ок - сообщение об успешном выполнении скрипта
 */

$form = $_POST;
if (isset($form['submit'])) { // Если в запросе есть поле submit(input name=submit) - нажали кнопку отправить => обрабатываем форму
    if (empty(validator($form))) { // Если валидатор не вернул сообщение об ошибке - продолжаем
        if (saveData($form)) $result = 'Ваше обращение отправлено'; // Если сохранение файла успешно - говорим что все ок
        else $error = 'Что-то пошло не так при сохранении обращения'; // Возвращаем ошибку
    } else $error = validator($form); // Возвращаем ошибку
}

/**
 * Формирует строку с данными и сохраняет их в файл
 *
 * @param $data
 * @return bool|int
 */
function saveData($data)
{
    $file = './contacts.txt'; // Путь до файла
    $date = date('Y-m-d H:i:s'); // Получем текущую дату и время (время отправки заявки)
    $row = sprintf('Имя: %s. Телефон: %s. Время: %s', $data['name'], $data['phone'], $date); // Строка, которую вносим в файл

    return file_put_contents($file, $row . PHP_EOL, FILE_APPEND); // Сохраняем строку в файл
}

/**
 * Проверка полей. Возвращает сообщение об ошибке или пустую строку
 *
 * @param $request
 * @return true|string
 */
function validator($request)
{
    // Если внутри try{} что-то сломается, то catch() попробует это поймать, если поймает - скрипт не сломается и продолжит работу
    try {
        validateName($request['name']);
        validatePhone($request['phone']);
    } catch (ErrorException $exception) {
        // Отлавливает исключения типа ErrorException, которые мы выбрасываем в функциях проверки конкретных полей
        return $exception->getMessage();
    }
    return ''; // Если дошли до сюда - возвращаем пустую строку, говоря что ошибок нет
}

/**
 * Проверяет поле Имя
 *
 * @param $name
 * @return string
 * @throws Exception
 */
function validateName($name)
{

    // Выбрасываем исключение если соотвествует условию, затем в функции validator() отливливаем данный тип исключения
    if (empty($name)) throw new ErrorException('Необходимо заполнить поле Имя');

    if (mb_strlen($name) < 3)  throw new ErrorException('Минимальная длина поля Имя 3 символа');
    if (mb_strlen($name) > 100)  throw new ErrorException( 'Максимальная длина поля Имя 100 символов');

    return true;
}

/**
 * Проверяет поле Телефон
 *
 * @param $phone
 * @return string
 * @throws Exception
 */
function validatePhone($phone)
{
    if (empty($phone))  throw new ErrorException( 'Необходимо заполнить поле Телефон');

    // TODO: Тут не стал заморачиваться, просто для примера
    if (strlen($phone) != 11)  throw new ErrorException( 'Некорретный формат телефона');
    return true;
}