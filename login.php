<?php
session_start();
require_once "functions.php";

// если была нажата ссылка logout, то выйтии вернуться на страницу логина опять
if(isset($_GET["logout"])) logout();

// если просто пришли напрямую на login.php, то не выодить никаких сообщений и вывести форму логина
// если пришли напрямую на login.php, то покажет сообщение о залогиненом пользователе без формы

// если введены почта и пароль, то проверка данных и процедура входа, переброска на основной файл main.php
// если почта или пароль неверные, то вывести  сообщение и снова форму
// если логин  или пароль пустые, то вывести сообщение и снова форму логина
if(isset($_POST["email"]) && isset($_POST["password"]))
{
    if (!empty($_POST["email"]) && !empty($_POST["password"])) {
        $result = check_credentials($_POST["email"], $_POST["password"]);
        if ($result) {
            set_logged(true);
            set_flash_message("logged_in", "Залогинен как ".$result["email"]);
            redirect_to("main");
        }
        else
        {
            set_flash_message("wrong_login_or_pass", "Логин или пароль неверны");
        }
    }
    else
    {
        set_flash_message("empy_login_or_pass", "Пустой логин или пароль");
    }
}

/*
register.php
status  "already_registered" warning желтый Уведомление! Этот эл. адрес уже занят другим пользователем


login.php
status  "register_success" info  голубой Регистрация успешна
status "empy_login_or_pass" danger красный Пустой логин или пароль
status "wrong_login_or_pass" danger  красный Логин или пароль неверны
status "logged_in" success зеленый залогинен
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>
        Войти
    </title>
    <meta name="description" content="Login">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
    <link id="mytheme" rel="stylesheet" media="screen, print" href="#">
    <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="stylesheet" media="screen, print" href="css/page-login-alt.css">
</head>
<body>
    <div class="blankpage-form-field">
        <div class="page-logo m-0 w-100 align-items-center justify-content-center rounded border-bottom-left-radius-0 border-bottom-right-radius-0 px-4">
            <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                <img src="img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                <span class="page-logo-text mr-1">Учебный проект</span>
                <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
            </a>
        </div>
        <div class="card p-4 border-top-left-radius-0 border-top-right-radius-0">
        <?php if(is_logged()) :  ?>
            <?php display_flash_message();?>
          <?php else:  ?>
            <?php display_flash_message();?>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label class="form-label" for="username">Email</label>
                    <input type="email" name="email" id="username" class="form-control" placeholder="Эл. адрес" value="">
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Пароль</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="" >
                </div>
                <div class="form-group text-left">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="rememberme">
                        <label class="custom-control-label" for="rememberme">Запомнить меня</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-default float-right">Войти</button>
            </form>
        </div>
        <?php endif ; ?>


        <div class="blankpage-footer text-center">
            Нет аккаунта? <a href="register.php"><strong>Зарегистрироваться</strong>
        </div>
    </div>
    <video poster="img/backgrounds/clouds.png" id="bgvid" playsinline autoplay muted loop>
        <source src="media/video/cc.webm" type="video/webm">
        <source src="media/video/cc.mp4" type="video/mp4">
    </video>
    <script src="js/vendors.bundle.js"></script>
</body>
</html>
