<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $name = strip_tags(trim($_POST["name"]));
    $phone = strip_tags(trim($_POST["phone"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = strip_tags(trim($_POST["message"]));

    // Проверяем данные
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Пожалуйста, заполните форму корректно.";
        exit;
    }

    // Указываем ваш email
    $recipient = "zxcvbnmria.111.69@gmail.com";
    
    // Формируем тему письма
    $email_subject = "Новое сообщение от $name: $subject";
    
    // Формируем содержимое письма
    $email_content = "Имя: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Телефон: $phone\n\n";
    $email_content .= "Сообщение:\n$message\n";

    // Заголовки письма
    $email_headers = "From: $name <$email>";

    // Отправляем письмо
    if (mail($recipient, $email_subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Спасибо! Ваше сообщение отправлено.";
    } else {
        http_response_code(500);
        echo "Упс! Что-то пошло не так, сообщение не отправлено.";
    }

} else {
    http_response_code(403);
    echo "Ошибка при отправке, попробуйте еще раз.";
}
?>