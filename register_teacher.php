<?php
// Проверяем, что данные были отправлены
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Простая проверка на пустые поля
    if (empty($name) || empty($email) || empty($password)) {
        echo "Все поля должны быть заполнены!";
        exit;
    }

    // Подключение к базе данных
    $servername = "localhost";
    $username = "root";   // Имя пользователя базы данных
    $password_db = "";    // Пароль базы данных
    $dbname = "teachers"; // Имя базы данных

    // Создаем соединение
    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Проверяем соединение
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    // Хешируем пароль для безопасности
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL-запрос для вставки данных в базу
    $sql = "INSERT INTO teachers (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Учитель успешно зарегистрирован!";
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }

    // Закрываем соединение
    $conn->close();
}
?>
