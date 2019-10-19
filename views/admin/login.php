<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Тонировка</title>
    <link href="template/images/favicon.ico" rel="shortcut icon">
    <link rel="stylesheet" href="template/style/resetStyle.css">
    <link rel="stylesheet" href="template/style/LoadFonts.css">
    <link rel="stylesheet" href="template/style/admin.css">
    <meta name="format-detection" content="telephone=no">
</head>
<body>
    <form id="autoriz">
        <header>
            <img src="template/images/logo.png">
            <h1>nokton /admin</h1>
            <p>Панель управления</p>    
            <p class="error">Тут будут ошибки</p>
        </header>
        <input type="text" id="login" placeholder="Логин админа" name="login">
        <input type="text" id="pass" placeholder="Пароль" name="pass">
        <input type="submit" class="button" value="Авторизоваться">
        <a href="/">На главную страницу</a>
    </form>
    <script src="public/js/jquery-3.2.1.min.js"></script>
    <script src="public/js/admin.js"></script>
</body>
</html>