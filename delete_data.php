<?php
$servername = "localhost"; // Название сервера базы данных
$username = "mysql"; // Логин пользователя базы данных
$password = "mysql"; // Пароль пользователя базы данных
$dbname = "register"; // Название вашей базы данных

// Создание подключения к базе данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из POST-запроса
$cityToDelete = $_POST['city']; // Используйте 'city', если это ваш ключ для передачи названия города

$sql = "DELETE FROM air_quality WHERE city_name = '$cityToDelete'"; // Используйте название поля, в котором хранится название города

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully"; // Вывод сообщения об успешном удалении
} else {
    echo "Error deleting record: " . $conn->error; // Вывод сообщения об ошибке при удалении
}

$conn->close(); // Закрытие соединения с базой данных
?>
