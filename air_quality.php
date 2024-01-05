<?php
$servername = "localhost"; // Назва сервера бази даних
$username = "mysql"; // Логін користувача бази даних
$password = "mysql"; // Пароль користувача бази даних
$dbname = "register"; // Назва вашої бази даних

// Створення з'єднання з базою даних
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка з'єднання
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Отримання даних з POST запиту
$city = $_POST['city'];
$pollutant = $_POST['pollutant'];
$level = $_POST['level'];

// Підготовлений запит на вставку даних
$sql = "INSERT INTO air_quality (city_name, pollutant, pollution_level) VALUES ('$city', '$pollutant', '$level')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
